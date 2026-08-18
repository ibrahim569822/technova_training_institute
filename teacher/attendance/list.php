<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$teacher_id = $_GET['teacher_id'] ?? 0;
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Attendance List</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                   
                    <a href="create.php<?= $teacher_id ? '?teacher_id=' . $teacher_id : '' ?>" class="btn btn-success">
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
                        <thead class="table-light">
                            <tr>
                                <th>Teacher</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT a.*, u.full_name 
                                    FROM trainer_attendance a 
                                    JOIN trainers t ON a.trainer_id = t.id 
                                    JOIN users u ON t.user_id = u.id 
                                    WHERE a.deleted_at IS NULL";
                            if ($teacher_id) {
                                $sql .= " AND a.trainer_id = $teacher_id";
                            }
                            $sql .= " ORDER BY a.id DESC";
                            $result = $crud->common_query($sql);
                            foreach ($result['data'] as $row) {
                                $status_text = ($row->status == 0) ? 'Present' : (($row->status == 1) ? 'Absent' : 'Leave');
                                $badge = ($row->status == 0) ? 'bg-success' : (($row->status == 1) ? 'bg-danger' : 'bg-warning');
                            ?>
                            <tr>
                                <td><?= $row->full_name ?></td>
                                <td><?= $row->attendance_date ?></td>
                                <td><span class="badge <?= $badge ?>"><?= $status_text ?></span></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $row->id ?>" class="btn btn-sm btn-primary mb-1">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="delete.php?id=<?= $row->id ?>" class="btn btn-sm btn-danger mb-1">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../../component/footer.php"; ?>