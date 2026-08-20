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
            <h3>Loan List</h3>
            <a href="loan_create.php<?= $teacher_id ? '?teacher_id=' . $teacher_id : '' ?>" class="btn btn-primary">Add Loan</a>
        </div>
    </div>
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
                <td>
                    <a href="loan_edit.php?id=<?= $row->id ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="loan_delete.php?id=<?= $row->id ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once "../../component/footer.php"; ?>