<?php
require_once "../../component/connection.php";

$id = $_GET['id'];
$row = $crud->common_query("SELECT * FROM trainer_loans WHERE id = $id AND deleted_at IS NULL")['data'][0];
$new_remaining = $row->remaining_amount - $row->installment_amount;
if ($new_remaining <= 0) {
    $new_remaining = 0;
    $crud->common_update("trainer_loans", ['remaining_amount' => $new_remaining, 'status' => 1], ['id' => $id]);
} else {
    $crud->common_update("trainer_loans", ['remaining_amount' => $new_remaining], ['id' => $id]);
}

$_SESSION['message'] = ['success', 'Success', 'Installment paid! Remaining: ' . number_format($new_remaining, 2)];
echo "<script>window.location.href = 'loan_list.php';</script>";