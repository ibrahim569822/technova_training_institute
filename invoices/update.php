<?php
require_once "../component/connection.php";

$id = $_POST['id'];

$crud->conn->begin_transaction();

$invoices['trainee_id'] = $_POST['trainee_id'];
$invoices['invoice_date'] = $_POST['invoice_date'];
$invoices['sub_total'] = $_POST['sub_total'];
$invoices['discount_amount'] = $_POST['discount_amount'] ?? 0;
$invoices['discount_type'] = $_POST['discount_type'] ?? 1;
$invoices['vat'] = $_POST['vat'] ?? 0;
$invoices['payment_status'] = $_POST['payment_status'];
$invoices['updated_by'] = $_SESSION['user_id'];

$result = $crud->common_update("invoices", $invoices, ['id' => $id]);

if ($result['status']) {
    $crud->conn->commit();
    $_SESSION['message'] = array('success', 'Success', 'Invoice updated successfully!');
} else {
    $crud->conn->rollback();
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "invoices/list.php';</script>";