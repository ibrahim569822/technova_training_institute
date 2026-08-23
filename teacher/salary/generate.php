<?php
require_once "../../component/connection.php";

$teacher_id = $_GET['teacher_id'] ?? 0;
$month = $_GET['month'] ?? date('Y-m');
$year_month = substr($month, 0, 7);

$check = $crud->common_query("SELECT COUNT(*) as total FROM trainer_salary_payments WHERE month = '$year_month'");
$existing_count = $check['data'][0]->total ?? 0;

if ($existing_count > 0) {
   
    $_SESSION['message'] = ['danger', 'Error', 'Salary already generated for this month!'];
    echo "<script>window.location.href = '" . $base_url . "teacher/salary/list.php';</script>";
    exit;
}


$teachers = $crud->common_query("SELECT trainers.id, users.full_name, trainers.salary FROM trainers JOIN users ON trainers.user_id = users.id WHERE trainers.deleted_at IS NULL");
if ($teacher_id) {
    $teachers['data'] = array_filter($teachers['data'], function($t) use ($teacher_id) {
        return $t->id == $teacher_id;
    });
 }

foreach ($teachers['data'] as $t) {

    $absent = $crud->common_query("SELECT COUNT(*) as total FROM trainer_attendance WHERE trainer_id = {$t->id} AND status = 1 AND attendance_date LIKE '$year_month%'")['data'][0]->total;

    
    $daily_salary = $t->salary / 30;
    $absent_deduction = $daily_salary * $absent;
    $net_salary = $t->salary - $absent_deduction;

  
    $loan = $crud->common_query("SELECT remaining_amount, installment_amount FROM trainer_loans WHERE trainer_id = {$t->id} AND status = 0")['data'][0] ?? null;
    $loan_deduction = 0;
    if ($loan) {
        $loan_deduction = $loan->installment_amount;
        $new_remaining = $loan->remaining_amount - $loan_deduction;
        $crud->common_update("trainer_loans", ['remaining_amount' => $new_remaining], ['trainer_id' => $t->id]);
    }

    $net_payable = $net_salary - $loan_deduction;

   
    $crud->common_insert("trainer_salary_payments", [
        'trainer_id' => $t->id,
        'month' => $year_month,
        'basic_salary' => $t->salary,
        'absent_deduction' => $absent_deduction,
        'loan_deduction' => $loan_deduction,
        'net_payable' => $net_payable,
        'payment_date' => date('Y-m-d')
    ]);
}

$_SESSION['message'] = ['success', 'Success', 'Salary generated!'];
echo "<script>window.location.href = '" . $base_url . "teacher/salary/list.php';</script>";