<?php
require_once "../component/connection.php";

if(count($_POST['status']) > 0) {
    // delete existing attendance records for the selected batch and date
    $deleted_data['batch_id'] = $_POST['batch_id'];
    $deleted_data['attendance_date'] = $_POST['attendance_date'];
    $result = $crud->common_delete("Attendance", $deleted_data);

    foreach($_POST['status'] as $trainee_id => $att_status) {
        $att_data['batch_id'] = $_POST['batch_id'];
        $att_data['attendance_date'] = $_POST['attendance_date'];
        $att_data['trainee_id'] = $trainee_id;
        $att_data['status'] = $att_status;
        $att_data['created_at'] = date('Y-m-d H:i:s');
        $att_data['created_by'] = $_SESSION['user_id'];
        $result = $crud->common_insert("attendance", $att_data);
    }

}

echo "<script>window.location.href = '" . $base_url . "attendance/list.php';</script>";