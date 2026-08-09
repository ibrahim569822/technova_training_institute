<?php
require_once "../component/connection.php";

$crud->conn->begin_transaction();

$id = $_POST['id'];

$enroll['trainee_id'] = $_POST['trainee_id'];
$enroll['batch_id'] = $_POST['batch_id'];
$enroll['course_id'] = $_POST['course_id'] ?? null;
$enroll['status'] = $_POST['status'];
$enroll['updated_by'] = $_SESSION['user_id'];

$result = $crud->common_update("enrollments", $enroll, ['id' => $id]);

if ($result['status']) {
    $crud->conn->commit();
    $_SESSION['message'] = array('success', 'Success', 'Enrollment updated successfully!');
} else {
    $crud->conn->rollback();
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";