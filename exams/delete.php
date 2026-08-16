<?php
require_once "../component/connection.php";

$result = $crud->common_update("exams", ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $_GET['id']]);
if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Exam deleted!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}
echo "<script>window.location.href = '" . $base_url . "exams/list.php';</script>";