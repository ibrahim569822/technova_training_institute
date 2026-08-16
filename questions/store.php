<?php
require_once "../component/connection.php";

$q_data = [
    'exam_id' => $_POST['exam_id'],
    'question' => $_POST['question'],
    'option_a' => $_POST['option_a'],
    'option_b' => $_POST['option_b'],
    'option_c' => $_POST['option_c'],
    'option_d' => $_POST['option_d'],
    'correct_answer' => $_POST['correct_answer'],
    'created_by' => $_SESSION['user_id']
];

$result = $crud->common_insert("questions", $q_data);

if ($result['status']) {
    $_SESSION['message'] = ['success', 'Success', 'Question added successfully!'];
} else {
    $_SESSION['message'] = ['danger', 'Error', $result['message']];
}

// 🔥 সঠিক রিডাইরেক্ট: list.php-তে ফিরে যাওয়া (exam_id সহ)
echo "<script>window.location.href = '" . $base_url . "questions/list.php?exam_id=" . $_POST['exam_id'] . "';</script>";