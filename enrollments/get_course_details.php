<?php
require_once "../component/connection.php";

$batch_id = $_GET['batch_id'];


$batch_query = $crud->common_query("SELECT course_id FROM batches WHERE id = $batch_id AND deleted_at IS NULL");
if (!$batch_query['status'] || empty($batch_query['data'])) {
    echo json_encode(['status' => false, 'message' => 'Batch not found']);
    exit;
}

$course_id = $batch_query['data'][0]->course_id;

$course_query = $crud->common_query("SELECT course_name, duration, fee, if(`status`=0,'Running',if(status=1,'Completed','Upcoming')) as status, if(`status`=0,'bg-primary',if(status=1,'bg-success','bg-warning')) as status_class FROM courses WHERE id = $course_id AND deleted_at IS NULL");
if (!$course_query['status'] || empty($course_query['data'])) {
    echo json_encode(['status' => false, 'message' => 'Course not found']);
    exit;
}

$course = $course_query['data'][0];
echo json_encode(['status' => true, 'data' => $course]);
?>