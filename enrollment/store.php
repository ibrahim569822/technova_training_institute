<?php
require_once "../component/connection.php";

// Validate input
if (empty($_POST['trainee_id']) || empty($_POST['course_id']) || empty($_POST['enrollment_date'])) {
    $_SESSION['message'] = array('danger', 'Error', 'All required fields must be filled.');
    echo "<script>window.location.href = '" . $base_url . "enrollments/create.php';</script>";
    exit;
}

// Check if trainee is already enrolled in this course (status = 0 means Enrolled)
$existing = $crud->common_select(
    "enrollment", 
    "id", 
    [
        'trainee_id' => $_POST['trainee_id'],
        'course_id' => $_POST['course_id'],
        'status' => 0
    ]
);

if ($existing['status'] && !empty($existing['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'This trainee is already enrolled in this course.');
    echo "<script>window.location.href = '" . $base_url . "enrollments/create.php';</script>";
    exit;
}

// Prepare data
$enrollment_data = [
    'trainee_id' => $_POST['trainee_id'],
    'course_id' => $_POST['course_id'],
    'enrollment_date' => $_POST['enrollment_date'],
    'status' => $_POST['status']
];

// Insert enrollment
$result = $crud->common_insert("enrollment", $enrollment_data);

if ($result['status']) {
    $_SESSION['message'] = array('success', 'Success', 'Enrollment added successfully.');
} else {
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";
?>