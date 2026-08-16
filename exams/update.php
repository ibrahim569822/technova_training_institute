<?php
require_once "../component/connection.php";

$id = $_POST['id'];
$exam_data = [
    'exam_name' => $_POST['exam_name'],
    'exam_date' => $_POST['exam_date'],
    'total_marks' => $_POST['total_marks'],
    'pass_marks' => $_POST['pass_marks'],
    'batch_id' => $_POST['batch_id'],
    'course_id' => $_POST['course_id'] ?? null,
    'updated_by' => $_SESSION['user_id']
];

$result = $crud->common_update("exams", $exam_data, ['id' => $id]);
if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Exam updated!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}
echo "<script>window.location.href = '" . $base_url . "exams/list.php';</script>";