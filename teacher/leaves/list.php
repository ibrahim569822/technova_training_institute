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
                    <h3 class="mb-2 text-size-26 text-color-2">Leave List</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                   
                    <a href="apply.php<?= $teacher_id ? '?teacher_id=' . $teacher_id : '' ?>" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i>Apply Leave
                    </a>
                </div>
            </div>
        </div>
    </div><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Type</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT l.*, u.full_name 
                    FROM trainer_leaves l 
                    JOIN trainers t ON l.trainer_id = t.id 
                    JOIN users u ON t.user_id = u.id 
                    WHERE l.deleted_at IS NULL";
            if ($teacher_id) {
                $sql .= " AND l.trainer_id = $teacher_id";
            }
            $sql .= " ORDER BY l.id DESC";
            $result = $crud->common_query($sql);
            foreach ($result['data'] as $row) {
                $type_text = ($row->leave_type == 0) ? 'Casual' : (($row->leave_type == 1) ? 'Sick' : 'Annual');
                $status_text = ($row->status == 0) ? '<span class="badge bg-danger">Pending</span>' : (($row->status == 1) ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-secondary">Rejected</span>');
            ?>
            <tr>
                <td><?= $row->full_name ?></td>
                <td><?= $type_text ?></td>
                <td><?= $row->start_date ?></td>
                <td><?= $row->end_date ?></td>
                <td><?= $status_text ?></td>
                <td>
                    <?php if ($row->status == 0) { ?>
                    <a href="approve.php?id=<?= $row->id ?>&action=1" class="btn btn-sm btn-success">Approve</a>
                    <a href="approve.php?id=<?= $row->id ?>&action=2" class="btn btn-sm btn-danger">Reject</a>
                    <?php } ?>
                    <a href="delete.php?id=<?= $row->id ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once "../../component/footer.php"; ?>