<?php
require_once "../component/connection.php";

$id = $_POST['id'];
$course_id = $_POST['course_id'];

$check_course = $crud->common_query("SELECT id FROM courses WHERE id = $course_id AND deleted_at IS NULL");
if (!$check_course['status'] || empty($check_course['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Selected Course does not exist!');
    echo "<script>window.location.href = '" . $base_url . "batches/edit.php?id=$id';</script>";
    exit;
}

$crud->conn->begin_transaction();

$batches['batch_name'] = $_POST['batch_name'];
$batches['course_id'] = $_POST['course_id'];
$batches['trainer_id'] = $_POST['trainer_id'];
$batches['Start_date'] = $_POST['Start_date'];
$batches['End_date'] = $_POST['End_date'];
$batches['total_seats'] = $_POST['total_seats'];
$batches['Price'] = $_POST['Price'];
$batches['Discount'] = $_POST['Discount'];
$batches['Discount_type'] = $_POST['Discount_type'];
$batches['status'] = $_POST['status'];
$batches['start_time'] = $_POST['start_time'];
$batches['end_time'] = $_POST['end_time'];
$batches['room'] = $_POST['room'];
$batches['updated_by'] = $_SESSION['user_id'];

$result = $crud->common_update("batches", $batches, ['id' => $id]);

if ($result['status']) {
    $crud->conn->commit();
    $_SESSION['message'] = array('success', 'Success', 'Batch updated successfully!');
} else {
    $crud->conn->rollback();
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "batches/list.php';</script>";