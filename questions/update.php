<?php
require_once "../component/connection.php";

$id = $_POST['id'];
$q_data = [
    'exam_id' => $_POST['exam_id'],
    'question' => $_POST['question'],
    'option_a' => $_POST['option_a'],
    'option_b' => $_POST['option_b'],
    'option_c' => $_POST['option_c'],
    'option_d' => $_POST['option_d'],
    'correct_answer' => $_POST['correct_answer'],
    'updated_by' => $_SESSION['user_id']
];

$result = $crud->common_update("questions", $q_data, ['id' => $id]);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Question updated successfully!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}

echo "<script>window.location.href = '" . $base_url . "questions/list.php?exam_id=" . $q_data['exam_id'] . "';</script>";