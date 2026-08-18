<?php
require_once "../../component/connection.php";


$data = [
    'trainer_id' => $_POST['teacher_id'],  // ✅ এখানে trainer_id
    'leave_type' => $_POST['leave_type'],
    'start_date' => $_POST['start_date'],
    'end_date' => $_POST['end_date'],
    'reason' => $_POST['reason'],
    'created_by' => $_SESSION['user_id']
];

$result = $crud->common_insert("trainer_leaves", $data);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Leave applied!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}
echo "<script>window.location.href = 'list.php';</script>";