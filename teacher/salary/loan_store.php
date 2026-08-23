<?php
require_once "../../component/connection.php";

$data = [
    'trainer_id' => $_POST['teacher_id'], 
    'loan_amount' => $_POST['loan_amount'],
    'remaining_amount' => $_POST['loan_amount'],
    'installment_count' => $_POST['installment_count'],
    'installment_amount' => $_POST['loan_amount'] / $_POST['installment_count'],
    'start_date' => $_POST['start_date'],
    'created_by' => $_SESSION['user_id']
];

$result = $crud->common_insert("trainer_loans", $data);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Loan added!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}
echo "<script>window.location.href = 'loan_list.php';</script>";