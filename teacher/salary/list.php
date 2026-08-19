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
                    <h3 class="mb-2 text-size-26 text-color-2">Salary List</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="generate.php<?= $teacher_id ? '?teacher_id=' . $teacher_id : '' ?>" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i> Generate Salary
                    </a>
                </div>
            </div>
        </div>
    </div><br>
       
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Month</th>
                <th>Basic</th>
                <th>Absent</th>
                <th>Loan</th>
                <th>Net Payable</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT s.*, u.full_name 
                    FROM trainer_salary_payments s 
                    JOIN trainers t ON s.trainer_id = t.id 
                    JOIN users u ON t.user_id = u.id 
                    WHERE s.deleted_at IS NULL";
            if ($teacher_id) {
                $sql .= " AND s.trainer_id = $teacher_id";
            }
            $sql .= " ORDER BY s.id DESC";
            $result = $crud->common_query($sql);
            foreach ($result['data'] as $row) {
            ?>
            <tr>
                <td><?= $row->full_name ?></td>
                <td><?= $row->month ?></td>
                <td><?= number_format($row->basic_salary, 2) ?></td>
                <td><?= number_format($row->absent_deduction, 2) ?></td>
                <td><?= number_format($row->loan_deduction, 2) ?></td>
                <td><?= number_format($row->net_payable, 2) ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once "../../component/footer.php"; ?>