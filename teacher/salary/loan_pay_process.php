<?php
require_once "../../component/connection.php";

$loan_id = $_GET['loan_id'] ?? 0;
$installment = $_GET['installment'] ?? 0;
$loan = $crud->common_query("SELECT * FROM trainer_loans WHERE id = $loan_id AND deleted_at IS NULL")['data'][0];
if (!$loan) {
    echo "error";
    exit;
}
$new_remaining = $loan->remaining_amount - $installment;
if ($new_remaining <= 0) {
    $new_remaining = 0;
 
    $crud->common_update("trainer_loans", ['remaining_amount' => $new_remaining, 'status' => 1, 'updated_by' => $_SESSION['user_id']], ['id' => $loan_id]);
} else {
    $crud->common_update("trainer_loans", ['remaining_amount' => $new_remaining, 'updated_by' => $_SESSION['user_id']], ['id' => $loan_id]);
}

echo "success";
?>