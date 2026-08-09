<?php
require_once "../config/database.php";

$result = $crud->common_update("Attendance", ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $_GET['id']]);

if ($result['status']) {
    $_SESSION['message'] = array('success', 'Success', $result['message']);
} else {
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "Attendance/database.php';</script>";