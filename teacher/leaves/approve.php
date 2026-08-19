<?php
require_once "../../component/connection.php";

$id = $_GET['id'];
$action = (int) ($_GET['action'] ?? 0);

if ($action == 1) {
    $crud->common_update("trainer_leaves", ['status' => 1], ['id' => $id]);
    
    $leave = $crud->common_query("SELECT trainer_id, start_date, end_date FROM trainer_leaves WHERE id = $id")['data'][0];
    $start = new DateTime($leave->start_date);
    $end = new DateTime($leave->end_date);
    while ($start <= $end) {
        $date = $start->format('Y-m-d');
        $check = $crud->common_query("SELECT id FROM trainer_attendance WHERE trainer_id = {$leave->trainer_id} AND attendance_date = '$date'");
        if ($check['status'] && !empty($check['data'])) {
            $crud->common_update("trainer_attendance", ['status' => 2], ['id' => $check['data'][0]->id]);
        } else {
            $crud->common_insert("trainer_attendance", [
                'trainer_id' => $leave->trainer_id,
                'attendance_date' => $date,
                'status' => 2,
                'created_by' => $_SESSION['user_id']
            ]);
        }
        $start->modify('+1 day');
    }
} elseif ($action == 2) {
    $crud->common_update("trainer_leaves", ['status' => 2], ['id' => $id]);
}

$_SESSION['message'] = ['success', 'Success', 'Leave updated!'];
echo "<script>window.location.href = 'list.php';</script>";