<?php
require_once "../component/connection.php";

$batch_id = $_GET['batch_id'];
$attendance_date = $_GET['attendance_date'] ?? date('Y-m-d'); // default to today if not provided
$data='';
if($batch_id) {
 
    $sql = "SELECT trainees.id, trainees.full_name 
                FROM trainees 
                JOIN enrollments ON trainees.id = enrollments.trainee_id 
                WHERE enrollments.batch_id = $batch_id AND trainees.deleted_at IS NULL";

    $result = $crud->common_query($sql);
    
    if ($result['status'] && !empty($result['data'])) {
        
        foreach ($result['data'] as $trainee) {
            // check if attendance record exists for this trainee and batch
            $check_att=$crud->common_query("SELECT * FROM attendance WHERE batch_id = $batch_id AND trainee_id = {$trainee->id} and attendance_date = '$attendance_date'");
            if($check_att['status'] && !empty($check_att['data'])){
                $att_status=$check_att['data'][0]->status;
            }else{
                $att_status=0; // default to present if no record exists
            }

            $data .= "<tr>";
            $data .= "<td>{$trainee->id}</td>";
            $data .= "<td>{$trainee->full_name}</td>";
            $data .= "<td>
                        <label><input type='radio' name='status[{$trainee->id}]' value='0' " . ($att_status == 0 ? "checked" : "") . "> Present</label>
                        <label><input type='radio' name='status[{$trainee->id}]' value='1' " . ($att_status == 1 ? "checked" : "") . "> Absent</label>
                    </td>";
            $data .= "</tr>";
        }
    }
}
echo $data;
?>