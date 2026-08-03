<?php
require_once "../component/connection.php";

$crud->conn->begin_transaction();

$id = $_POST['id'];

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

$result = $crud->common_update("batch", $batch, ['id' => $id]);

if ($result['status']) {
    $crud->conn->commit();
    $_SESSION['message'] = array('success', 'Success', 'Batch updated successfully!');
} else {
    $crud->conn->rollback();
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "batch/list.php';</script>";