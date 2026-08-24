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
    }

    $crud->conn->commit();
    $_SESSION['message'] = ['success', 'Success', 'Invoice created successfully! Invoice No: ' . $invoice_no];

} catch (Exception $e) {
    $crud->conn->rollback();
    $_SESSION['message'] = ['danger', 'Error', 'Invoice creation failed: ' . $e->getMessage()];
}

$trainee_email = $crud->common_query("SELECT id, full_name, email FROM trainees WHERE id = $trainee_id");
if ($trainee_email['status'] && !empty($trainee_email['data'])) {
    $trainee = $trainee_email['data'][0];
    $to = $trainee->email;
    $subject = 'Invoice Created - ' . $invoice_no;

    $invoice = (object) [
        'invoice_no' => $invoice_no,
        'invoice_date' => $invoice_date,
        'sub_total' => $_POST['total'] ?? 0,
        'discount_amount' => $_POST['total_discount'] ?? 0,
        'vat' => $_POST['total_vat'] ?? 0,
        'grand_total' => $grand_total,
        'notes' => $notes,
        'payment_status' => $payment_status,
        'paid_amount' => $paid_amount,
        'transaction_id' => $_POST['transaction_id'] ?? null,
        'payment_method' => $_POST['payment_method'] ?? 0,
        'trainee_name' => $trainee->full_name
    ];

    $details_query = $crud->common_query("SELECT invoice_details.*, batches.batch_name FROM invoice_details JOIN batches ON invoice_details.batch_id = batches.id WHERE invoice_details.invoice_id = $invoice_id ORDER BY invoice_details.id ASC");
    $details = $details_query['status'] ? $details_query['data'] : [];

    ob_start();
    include __DIR__ . '/email_template.php';
    $html_message = ob_get_clean();

    $headers = "From: info@blognest.tech\r\n" .
               "Reply-To: info@blognest.tech\r\n" .
               "MIME-Version: 1.0\r\n" .
               "Content-Type: text/html; charset=UTF-8\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $html_message, $headers)) {
        echo "Email successfully sent!";
    } else {
        echo "Email delivery failed.";
    }
}


$trainee_email = $crud->common_query("SELECT id, full_name, email FROM trainees WHERE id = $trainee_id");
if ($trainee_email['status'] && !empty($trainee_email['data'])) {
    $trainee = $trainee_email['data'][0];
    $to = $trainee->email;
    $subject = 'Invoice Created - ' . $invoice_no;

    $invoice = (object) [
        'invoice_no' => $invoice_no,
        'invoice_date' => $invoice_date,
        'sub_total' => $_POST['total'] ?? 0,
        'discount_amount' => $_POST['total_discount'] ?? 0,
        'vat' => $_POST['total_vat'] ?? 0,
        'grand_total' => $grand_total,
        'notes' => $notes,
        'payment_status' => $payment_status,
        'paid_amount' => $paid_amount,
        'transaction_id' => $_POST['transaction_id'] ?? null,
        'payment_method' => $_POST['payment_method'] ?? 0,
        'trainee_name' => $trainee->full_name
    ];

    $details_query = $crud->common_query("SELECT invoice_details.*, batches.batch_name FROM invoice_details JOIN batches ON invoice_details.batch_id = batches.id WHERE invoice_details.invoice_id = $invoice_id ORDER BY invoice_details.id ASC");
    $details = $details_query['status'] ? $details_query['data'] : [];

    ob_start();
    include __DIR__ . '/email_template.php';
    $html_message = ob_get_clean();

    $headers = "From: info@blognest.tech\r\n" .
               "Reply-To: info@blognest.tech\r\n" .
               "MIME-Version: 1.0\r\n" .
               "Content-Type: text/html; charset=UTF-8\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $html_message, $headers)) {
        echo "Email successfully sent!";
    } else {
        echo "Email delivery failed.";
    }
}

echo "<script>window.location.href = '" . $base_url . "invoices/list.php';</script>";