<?php
require_once "../../component/connection.php";

$id = $_GET['id'];
$crud->common_update("trainer_loans", ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $id]);
$_SESSION['message'] = ['success', 'Success', 'Loan deleted!'];
echo "<script>window.location.href = 'loan_list.php';</script>";