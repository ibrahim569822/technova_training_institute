<?php
require_once "../component/connection.php";

$trainee_id = $_GET['trainee_id'];

// Check if enrollment exists
$enrollment = $crud->common_query("SELECT enrollments.`batch_id`, batches.batch_name, batches.Price, batches.Discount, batches.Discount_type, courses.course_name 
                                    FROM `enrollments` 
                                    JOIN batches ON batches.id = enrollments.batch_id
                                    JOIN courses ON courses.id = enrollments.course_id
                                    WHERE `trainee_id` = {$trainee_id} AND `invoice_id` IS NULL");

if (!$enrollment['status'] || empty($enrollment['data'])) {
    $data = array('status' => false, 'message' => 'No enrollments found for the selected trainee.', 'data' => []);
} else {
    $data = array('status' => true, 'message' => 'Batches found.', 'data' => $enrollment['data']);
}

echo json_encode($data);
?>