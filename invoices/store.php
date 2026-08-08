<?php
require_once "../component/connection.php";

$crud->conn->begin_transaction();

$enroll['trainee_id'] = $_POST['trainee_id'];
$enroll['batch_id'] = $_POST['batch_id'];
$enroll['course_id'] = $_POST['course_id'] ?? null; 
$enroll['enrollment_date'] = date('Y-m-d');
$enroll['status'] = $_POST['status'];
$enroll['created_by'] = $_SESSION['user_id'];

$result = $crud->common_insert("enrollments", $enroll);

if ($result['status']) {
    $crud->conn->commit();
    $_SESSION['message'] = array('success', 'Success', 'Enrollment added successfully!');
} else {
    $crud->conn->rollback();
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";