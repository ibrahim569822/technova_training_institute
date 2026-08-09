<?php

require_once "../config/database.php";

$id = $_POST['id'];
$batch_id = $_POST['batch_id'];
$trainee_id = $_POST['trainee_id'];
$attendance_date = $_POST['attendance_date'];
$status = $_POST['status'];

// Update data
$attendance = [];

$attendance['batch_id'] = $batch_id;
$attendance['trainee_id'] = $trainee_id;
$attendance['attendance_date'] = $attendance_date;
$attendance['status'] = $status;

// Update attendance
$result = $crud->common_update(
    "attendance",
    $attendance,
    ['id' => $id]
);

if ($result['status']) {

    $_SESSION['message'] = array(
        'success',
        'Success',
        'Attendance updated successfully.'
    );

} else {

    $_SESSION['message'] = array(
        'danger',
        'Error',
        $result['message']
    );
}

// Redirect
echo "<script>
window.location.href = '" . $base_url . "attendance/index.php';
</script>";

?>