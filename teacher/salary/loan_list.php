<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$teacher_id = $_GET['teacher_id'] ?? 0;
?>

<div class="main-content">
    <div class="row">
        <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Loan List</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                   
                    <a href="loan_create.php<?= $teacher_id ? '?teacher_id=' . $teacher_id : '' ?>" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i>Add Loan
                    </a>
                </div>
            
        </div>
    </div><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Amount</th>
                <th>Installments</th>
                <th>Remaining</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT l.*, u.full_name 
                    FROM trainer_loans l 
                    JOIN trainers t ON l.trainer_id = t.id 
                    JOIN users u ON t.user_id = u.id 
                    WHERE l.deleted_at IS NULL";
            if ($teacher_id) {
                $sql .= " AND l.trainer_id = $teacher_id";
            }
            $sql .= " ORDER BY l.id DESC";
            $result = $crud->common_query($sql);
            foreach ($result['data'] as $row) {
            ?>
            <tr>
                <td><?= $row->full_name ?></td>
                <td><?= number_format($row->loan_amount, 2) ?></td>
                <td><?= $row->installment_count ?></td>
                <td><?= number_format($row->remaining_amount, 2) ?></td>
                <td><?= $row->status == 0 ? 'Active' : 'Completed' ?></td>
                <td><a href="loan_view.php?id=<?= $row->id ?>" class="btn btn-sm btn-info">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                   
                    <a href="loan_edit.php?id=<?= $row->id ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="loan_delete.php?id=<?= $row->id ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once "../../component/footer.php"; ?>