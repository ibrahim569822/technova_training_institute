<?php
require_once "../../component/connection.php";

$id = $_POST['id'];
$data = [
    'trainer_id' => $_POST['teacher_id'],
    'loan_amount' => $_POST['loan_amount'],
    'remaining_amount' => $_POST['remaining_amount'],
    'installment_count' => $_POST['installment_count'],
    'installment_amount' => $_POST['installment_amount'],
    'start_date' => $_POST['start_date'],
    'status' => 0,
    'updated_by' => $_SESSION['user_id']
];
if ($_POST['remaining_amount'] <= 0) {
    $data['status'] = 1;}
$result = $crud->common_update("trainer_loans", $data, ['id' => $id]);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Loan updated!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}
echo "<script>window.location.href = 'loan_list.php';</script>";