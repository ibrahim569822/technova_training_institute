<?php
require_once "../component/connection.php";

$id = $_GET['id'];

// Validate input
if (empty($_POST['enrollment_date']) || $_POST['status'] === '') {
    $_SESSION['message'] = array('danger', 'Error', 'All required fields must be filled.');
    echo "<script>window.location.href = '" . $base_url . "enrollments/edit.php?id=" . $id . "';</script>";
    exit;
}

// Prepare data
$enrollment_data = [
    'enrollment_date' => $_POST['enrollment_date'],
    'status' => $_POST['status']
];

$result = $crud->common_update("enrollment", $enrollment_data, ['id' => $id]);

if ($result['status']) {
    $_SESSION['message'] = array('success', 'Success', 'Enrollment updated successfully.');
} else {
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";
?>