<?php
require_once "../component/connection.php";

$exam_data = [
    'exam_name' => $_POST['exam_name'],
    'exam_date' => $_POST['exam_date'],
    'total_marks' => $_POST['total_marks'],
    'pass_marks' => $_POST['pass_marks'],
    'batch_id' => $_POST['batch_id'],
    'course_id' => $_POST['course_id'] ?? null,
    'created_by' => $_SESSION['user_id']
];

$result = $crud->common_insert("exams", $exam_data);
if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Exam created!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}
echo "<script>window.location.href = '" . $base_url . "exams/list.php';</script>";