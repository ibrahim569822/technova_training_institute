<?php
require_once "../../component/connection.php";


$data = [
    'trainer_id' => $_POST['teacher_id'],  // ✅ এখানে trainer_id
    'attendance_date' => $_POST['attendance_date'],
    'status' => $_POST['status'],
    'created_by' => $_SESSION['user_id']
];

$result = $crud->common_insert("trainer_attendance", $data);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Attendance added!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}
echo "<script>window.location.href = 'list.php';</script>";