<?php
require_once "../component/connection.php";

$id = $_GET['id'];

// Check if enrollment exists
$enrollment = $crud->common_select("enrollments", "id", ['id' => $id]);
if (!$enrollment['status'] || empty($enrollment['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Enrollment not found.');
    echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";
    exit;
}

$result = $crud->common_delete("enrollments", ['id' => $id]);

if ($result['status']) {
    $_SESSION['message'] = array('success', 'Success', 'Enrollment deleted successfully.');
} else {
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";
?>