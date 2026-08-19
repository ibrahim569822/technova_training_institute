<?php
require_once "../../component/connection.php";

$attendance_date = $_GET['attendance_date'] ?? date('Y-m-d');


$sql = "SELECT trainers.id as teacher_id, users.full_name 
        FROM trainers 
        JOIN users ON trainers.user_id = users.id 
        WHERE trainers.deleted_at IS NULL";

$teachers = $crud->common_query($sql);

if (!$teachers['status'] || empty($teachers['data'])) {
    echo '<tr><td colspan="3">No teachers found.</td></tr>';
    exit;
}

$i = 1;
foreach ($teachers['data'] as $t) {
   
    $check = $crud->common_query("SELECT status FROM trainer_attendance WHERE trainer_id = {$t->teacher_id} AND attendance_date = '$attendance_date'");
    $status = 0; 
    if ($check['status'] && !empty($check['data'])) {
        $status = $check['data'][0]->status;
    }
?>
    <tr>
        <td><?= $i++ ?></td>
        <td><?= $t->full_name ?></td>
        <td>
            <div class="d-flex gap-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status[<?= $t->teacher_id ?>]" value="0" <?= $status == 0 ? 'checked' : '' ?>>
                    <label class="form-check-label text-success">Present</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status[<?= $t->teacher_id ?>]" value="1" <?= $status == 1 ? 'checked' : '' ?>>
                    <label class="form-check-label text-danger">Absent</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status[<?= $t->teacher_id ?>]" value="2" <?= $status == 2 ? 'checked' : '' ?>>
                    <label class="form-check-label text-warning">Leave</label>
                </div>
            </div>
        </td>
    </tr>
<?php } ?>