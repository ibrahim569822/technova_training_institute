<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$attendance_date = $_GET['attendance_date'];
$sql = "SELECT batches.batch_name, trainees.full_name, attendance.attendance_date, attendance.status
        FROM attendance
        JOIN batches ON attendance.batch_id = batches.id
        JOIN trainees ON attendance.trainee_id = trainees.id
        WHERE attendance.attendance_date = '$attendance_date'
        ";

$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Batch not found.');
    exit;
}

?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Attendance Details</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url; ?>attendance/list.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Batch Name</th>
                            <th>Trainee Name</th>
                            <th>Attendance Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach ($data['data'] as $batch) : ?>
                            <tr>
                                <td><?= $batch->batch_name ?></td>
                                <td><?= $batch->full_name ?></td>
                                <td><?= $batch->attendance_date ?></td>
                                <td><?= $batch->status == 0 ? 'Present' : 'Absent' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>