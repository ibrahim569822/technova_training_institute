<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$month = $_GET['month'] ?? date('Y-m');

$sql = "SELECT s.*, u.full_name 
        FROM trainer_salary_payments s 
        JOIN trainers t ON s.trainer_id = t.id 
        JOIN users u ON t.user_id = u.id 
        WHERE s.deleted_at IS NULL 
        AND s.month = '$month'";

$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Salary record not found.');
    echo "<script>window.location.href = '" . $base_url . "teacher/salary/list.php';</script>";
    exit;
}

$salary = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Salary Details</h3>
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
                            <th>Month</th>
                            <th>Basic Salary</th>
                            <th>Absent Deduction</th>
                            <th>Loan Deduction</th>
                            <th>Net Payable</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['data'] as $salary) : ?>
                            <tr>
                                <td><?= $salary->full_name ?></td>
                                <td><?= $salary->month ?></td>
                                <td><?= number_format($salary->basic_salary, 2) ?></td>
                                <td><?= number_format($salary->absent_deduction, 2) ?></td>
                                <td><?= number_format($salary->loan_deduction, 2) ?></td>
                                <td><?= number_format($salary->net_payable, 2) ?></td>
                                <td>
                                    <?= $salary->status == 0 ? '<span class="badge bg-success">Paid</span>' : '<span class="badge bg-warning">Pending</span>' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once "../../component/footer.php"; ?>