<?php
require_once "../../component/connection.php";

if(isset($_POST['status']) && count($_POST['status']) > 0) {
    // Delete existing attendance records for the selected trainer and date
    //$deleted_data['trainer_id'] = $_POST['batch_id']; // using batch_id as trainer_id
    $deleted_data['attendance_date'] = $_POST['attendance_date'];
    $result = $crud->common_delete("trainer_attendance", $deleted_data);

    foreach($_POST['status'] as $trainer_id => $att_status) {
        //$att_data['trainer_id'] = $_POST['batch_id']; // using batch_id as trainer_id
        $att_data['attendance_date'] = $_POST['attendance_date'];
        $att_data['trainer_id'] = $trainer_id;
        $att_data['status'] = $att_status;
        $att_data['created_at'] = date('Y-m-d H:i:s');
        $att_data['created_by'] = $_SESSION['user_id'];
        $result = $crud->common_insert("trainer_attendance", $att_data);
    }
}

echo "<script>window.location.href = '" . $base_url . "teacher/attendance/list.php';</script>";