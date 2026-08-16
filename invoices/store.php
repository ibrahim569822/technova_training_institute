<?php
require_once "../component/connection.php";


$trainee_id = $_POST['trainee_id'];
$invoice_date = $_POST['invoice_date'];
$notes = $_POST['notes'] ?? '';
$payment_status = $_POST['payment_status'];
$paid_amount = $_POST['paid_amount'] ?? 0;

$batch_ids = $_POST['batch_id']; // array
$prices = $_POST['price'];       // array
$discounts = $_POST['discount']; // array
$vats = $_POST['vat'];           // array
$sub_totals = $_POST['sub_total']; // array

$grand_total = 0;
foreach ($sub_totals as $sub) {
    $grand_total += (float) $sub;
}


$last_invoice = $crud->common_query("SELECT max(id) as id FROM invoices");
if ($last_invoice['status'] && !empty($last_invoice['data'])) {
    $last_no = (int) $last_invoice['data'][0]->id;
    $new_no = $last_no + 1;
} else {
    $new_no = 1;
}
$invoice_no = 'INV-' . date('Y') . '-' . str_pad($new_no, 4, '0', STR_PAD_LEFT);


$crud->conn->begin_transaction();

try {
    
    $invoices_data = [
        'trainee_id' => $trainee_id,
        'invoice_no' => $invoice_no,
        'invoice_date' => $invoice_date,
        'sub_total' => $_POST['total'] ?? 0,
        'discount_amount' => $_POST['total_discount'] ?? 0,
        'discount_type' => 1,
        'vat' => $_POST['total_vat'] ?? 0,
        'grand_total' => $grand_total,
        'notes' => $notes,
        'payment_status' => $payment_status,
        'paid_amount' => $paid_amount,
        'created_by' => $_SESSION['user_id']
    ];

    $invoice_result = $crud->common_insert("invoices", $invoices_data);
    if (!$invoice_result['status']) {
        throw new Exception("Failed to create invoice: " . $invoice_result['message']);
    }
    $invoice_id = $invoice_result['data'];

    
    for ($i = 0; $i < count($batch_ids); $i++) {
        if (empty($batch_ids[$i])) continue;

        $batch_id = $batch_ids[$i];
        $course_query = $crud->common_query("SELECT course_id FROM enrollments WHERE batch_id = $batch_id AND trainee_id = $trainee_id AND deleted_at IS NULL LIMIT 1");
        $course_id = null;
        if ($course_query['status'] && !empty($course_query['data'])) {
            $course_id = $course_query['data'][0]->course_id;
        }

        $details_data = [
            'invoice_id' => $invoice_id,
            'batch_id' => $batch_id,
            'course_id' => $course_id,
            'price' => $prices[$i] ?? 0,
            'discount_amount' => $discounts[$i] ?? 0,
            'discount_type' => 1,
            'vat' => $vats[$i] ?? 0,
            'sub_total' => $sub_totals[$i] ?? 0,
            'created_by' => $_SESSION['user_id']
        ];

        $detail_result = $crud->common_insert("invoice_details", $details_data);
        if (!$detail_result['status']) {
            throw new Exception("Failed to save invoice details: " . $detail_result['message']);
        }
    }

    
    if ($paid_amount > 0) {
        $payment_data = [
            'invoice_id' => $invoice_id,
            'amount' => $paid_amount,
            'payment_date' => date('Y-m-d'),
            'payment_method' => $_POST['payment_method'] ?? 0,
            'payment_status' => ($paid_amount >= $grand_total) ? 1 : 2,
            'transaction_id' => $_POST['transaction_id'] ?? null,
            'created_by' => $_SESSION['user_id']
        ];

        $payment_result = $crud->common_insert("payments", $payment_data);
        if (!$payment_result['status']) {
            throw new Exception("Failed to save payment: " . $payment_result['message']);
        }

        // 🔥 ACCOUNTING: Auto Receive Voucher + Ledger
        // Cash এবং Income একাউন্টের আইডি বের করা
        $cash_account = $crud->common_query("SELECT id FROM account_heads WHERE account_name LIKE '%Cash%' LIMIT 1");
        $income_account = $crud->common_query("SELECT id FROM account_heads WHERE account_type = 'Income' LIMIT 1");

        if ($cash_account['status'] && $income_account['status']) {
            $cash_id = $cash_account['data'][0]->id;
            $income_id = $income_account['data'][0]->id;

            // Voucher No জেনারেট
            $last_voucher = $crud->common_query("SELECT max(id) as id FROM receive_vouchers");
            $voucher_no = 'RV-' . date('Y') . '-' . str_pad(($last_voucher['data'][0]->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);

            // Receive Voucher তৈরি
            $voucher_data = [
                'voucher_no' => $voucher_no,
                'voucher_date' => date('Y-m-d'),
                'received_from' => 'Trainee ID: ' . $trainee_id,
                'narration' => 'Payment received for Invoice: ' . $invoice_no,
                'Invoice_id' => $invoice_id,
                'dr' => 0,
                'cr' => $paid_amount,
                'created_by' => $_SESSION['user_id']
            ];
            $voucher_result = $crud->common_insert("receive_vouchers", $voucher_data);
            if (!$voucher_result['status']) {
                throw new Exception("Voucher creation failed: " . $voucher_result['message']);
            }
            $voucher_id = $voucher_result['data'];

            // Voucher Details (Debit: Cash, Credit: Income)
            $details_data = [
                'receive_voucher_id' => $voucher_id,
                'account_head_id' => $cash_id,
                'dr' => $paid_amount,
                'cr' => 0,
                'remarks' => 'Cash received'
            ];
            $crud->common_insert("receive_voucher_details", $details_data);

            $details_data = [
                'receive_voucher_id' => $voucher_id,
                'account_head_id' => $income_id,
                'dr' => 0,
                'cr' => $paid_amount,
                'remarks' => 'Income from Invoice: ' . $invoice_no
            ];
            $crud->common_insert("receive_voucher_details", $details_data);

            // Ledger Update
            $ledger_data = [
                'receive_voucher_id' => $voucher_id,
                'account_head_id' => $cash_id,
                'dr' => $paid_amount,
                'cr' => 0,
                'remarks' => 'Cash received for Invoice: ' . $invoice_no
            ];
            $crud->common_insert("ledger", $ledger_data);

            $ledger_data = [
                'receive_voucher_id' => $voucher_id,
                'account_head_id' => $income_id,
                'dr' => 0,
                'cr' => $paid_amount,
                'remarks' => 'Income from Invoice: ' . $invoice_no
            ];
            $crud->common_insert("ledger", $ledger_data);
        }
    }

    $crud->conn->commit();
    $_SESSION['message'] = ['success', 'Success', 'Invoice created successfully! Invoice No: ' . $invoice_no];

} catch (Exception $e) {
    $crud->conn->rollback();
    $_SESSION['message'] = ['danger', 'Error', 'Invoice creation failed: ' . $e->getMessage()];
}


echo "<script>window.location.href = '" . $base_url . "invoices/list.php';</script>";