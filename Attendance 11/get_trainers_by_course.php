<?php
require_once "../component/connection.php";

$course_id = $_GET['course_id'];

if($course_id) {
    
    $sql = "SELECT trainers.id, users.full_name 
            FROM trainers 
            JOIN users ON trainers.user_id = users.id 
            WHERE trainers.deleted_at IS NULL";
    
    $result = $crud->common_query($sql);
    
    if ($result['status'] && !empty($result['data'])) {
        echo '<option value="">Select Trainer</option>';
        foreach ($result['data'] as $trainer) {
            echo "<option value='{$trainer->id}'>{$trainer->full_name}</option>";
        }
    } else {
        echo '<option value="">No Trainers Available</option>';
    }
} else {
    echo '<option value="">Select Course First</option>';
}
?>