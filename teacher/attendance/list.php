<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-success">Teacher Attendance</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="create.php" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i> Add Attendance
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive table-rounded-top">
                    <table class="table align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Date</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // 
                            $sql = "SELECT 
                                    trainer_attendance.attendance_date,
                                    users.full_name as teacher_name,
                                    trainer_attendance.status
                                    FROM `trainer_attendance` 
                                    JOIN trainers ON trainer_attendance.trainer_id = trainers.id
                                    JOIN users ON trainers.user_id = users.id
                                    WHERE trainer_attendance.deleted_at IS NULL
                                    GROUP BY trainer_attendance.attendance_date 
                                    ORDER BY trainer_attendance.attendance_date DESC, users.full_name";
                            $result = $crud->common_query($sql);
                            if ($result['status']) {
                                foreach ($result['data'] as $att) {
                                    $status_text = ($att->status == 0) ? 'Present' : (($att->status == 1) ? 'Absent' : 'Leave');
                                    $badge_class = ($att->status == 0) ? 'bg-success' : (($att->status == 1) ? 'bg-danger' : 'bg-warning');
                            ?>
                            <tr>
                                <td><?= $att->attendance_date ?></td>
                                
                                <td>
                                    <a href="view.php?attendance_date=<?= $att->attendance_date; ?>" class="btn btn-sm btn-warning">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../../component/footer.php" ?>