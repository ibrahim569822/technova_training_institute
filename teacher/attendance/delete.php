<?php
require_once "../../component/connection.php";

$crud->common_update("trainer_attendance", ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $_GET['id']]);
$_SESSION['message'] = ['success', 'Success', 'Deleted!'];
echo "<script>window.location.href = 'list.php';</script>";