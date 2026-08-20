<?php
require_once "../../component/connection.php";

$id = $_POST['id'];
$attendance_date = $_POST['attendance_date'];

$data = [
    'status' => $_POST['status'],
    'updated_by' => $_SESSION['user_id']
];

$result = $crud->common_update("trainer_attendance", $data, ['id' => $id]);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Attendance updated successfully!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}

echo "<script>window.location.href = '" . $base_url . "teacher/attendance/view.php?attendance_date=" . $attendance_date . "';</script>";