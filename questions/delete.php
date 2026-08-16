<?php
require_once "../component/connection.php";

$id = $_GET['id'];


$exam_query = $crud->common_query("SELECT exam_id FROM questions WHERE id = $id");
$exam_id = $exam_query['data'][0]->exam_id ?? 0;

$result = $crud->common_update("questions", ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $id]);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Question deleted successfully!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}


echo "<script>window.location.href = '" . $base_url . "questions/list.php?exam_id=" . $exam_id . "';</script>";