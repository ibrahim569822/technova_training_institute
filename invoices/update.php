<?php
require_once "../component/connection.php";

$id = $_POST['id'];

$crud->conn->begin_transaction();

try {
    
    $invoices['trainee_id'] = $_POST['trainee_id'];
    $invoices['invoice_date'] = $_POST['invoice_date'];
    $invoices['sub_total'] = $_POST['sub_total'];
    $invoices['discount_amount'] = $_POST['discount_amount'] ?? 0;
    $invoices['discount_type'] = $_POST['discount_type'] ?? 1;
    $invoices['vat'] = $_POST['vat'] ?? 0;
    $invoices['updated_by'] = $_SESSION['user_id'];

    //  2. Get existing invoice data to calculate due
    $existing = $crud->common_query("SELECT grand_total, paid_amount FROM invoices WHERE id = $id");
    $existing_data = $existing['data'][0];
    $grand_total = $existing_data->grand_total;
    $current_paid = $existing_data->paid_amount;

    // 3. Additional Payment
    $additional_payment = $_POST['additional_payment'] ?? 0;
    $new_paid_amount = $current_paid + $additional_payment;

    //  4. If additional payment is made, save it to payments table
    if ($additional_payment > 0) {
        $payment_data = [
            'invoice_id' => $id,
            'amount' => $additional_payment,
            'payment_date' => date('Y-m-d'),
            'payment_method' => $_POST['new_payment_method'] ?? 0,
            'payment_status' => ($new_paid_amount >= $grand_total) ? 1 : 2, 
            'created_by' => $_SESSION['user_id']
        ];
        $payment_result = $crud->common_insert("payments", $payment_data);
        if (!$payment_result['status']) {
            throw new Exception("Failed to save payment: " . $payment_result['message']);
        }
    }

    
    $invoices['paid_amount'] = $new_paid_amount;
    $invoices['payment_status'] = ($new_paid_amount >= $grand_total) ? 1 : (($new_paid_amount > 0) ? 2 : 0); 

    $update_result = $crud->common_update("invoices", $invoices, ['id' => $id]);

    if (!$update_result['status']) {
        throw new Exception("Failed to update invoice: " . $update_result['message']);
    }

    $crud->conn->commit();
    $_SESSION['message'] = array('success', 'Success', 'Invoice updated successfully!');

} catch (Exception $e) {
    $crud->conn->rollback();
    $_SESSION['message'] = array('danger', 'Error', $e->getMessage());
}

echo "<script>window.location.href = '" . $base_url . "invoices/list.php';</script>";