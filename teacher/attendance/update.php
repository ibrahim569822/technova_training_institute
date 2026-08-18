<?php
require_once "../../component/connection.php";

$id = $_POST['id'];
$data = [
    'attendance_date' => $_POST['attendance_date'],
    'status' => $_POST['status'],
    'updated_by' => $_SESSION['user_id']
];
$crud->common_update("trainer_attendance", $data, ['id' => $id]);
$_SESSION['message'] = ['success', 'Success', 'Updated!'];
echo "<script>window.location.href = 'list.php';</script>";