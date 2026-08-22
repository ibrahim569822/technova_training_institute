<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$attendance_date = $_GET['attendance_date'];
$sql = "SELECT trainer_attendance.id, users.full_name, trainer_attendance.attendance_date, trainer_attendance.status
        FROM trainer_attendance
        JOIN trainers ON trainer_attendance.trainer_id = trainers.id
        JOIN users ON trainers.user_id = users.id
        WHERE trainer_attendance.attendance_date = '$attendance_date'
        ";

$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'No records found.');
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
                    <a href="list.php" class="btn btn-secondary">Back to List</a>
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
                            <th>Teacher Name</th>
                            <th>Attendance Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['data'] as $row) : ?>
                            <tr>
                                <td><?= $row->full_name ?></td>
                                <td><?= $row->attendance_date ?></td>
                                <td>
                                    <?= $row->status == 0 ? 'Present' : ($row->status == 1 ? 'Absent' : 'Leave') ?>
                                </td>
                                <td>
                                    <a href="update.php?id=<?= $row->id ?>" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-rotate"></i> Update
                                    </a>
                                
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once "../../component/footer.php" ?>