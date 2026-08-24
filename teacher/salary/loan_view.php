<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$loan = $crud->common_query("SELECT * FROM trainer_loans WHERE id = $id AND deleted_at IS NULL")['data'][0];
$teacher = $crud->common_query("SELECT trainers.id, users.full_name FROM trainers JOIN users ON trainers.user_id = users.id WHERE trainers.id = {$loan->trainer_id}")['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Loan Details</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="loan_list.php" class="btn btn-secondary">Back to List</a>
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
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Teacher Name</strong></td>
                            <td><?= $teacher->full_name ?></td>
                        </tr>
                        <tr>
                            <td><strong>Loan Amount</strong></td>
                            <td><?= number_format($loan->loan_amount, 2) ?> BDT</td>
                        </tr>
                        <tr>
                            <td><strong>Remaining Balance</strong></td>
                            <td><?= number_format($loan->remaining_amount, 2) ?> BDT</td>
                        </tr>
                        <tr>
                            <td><strong>Installment Amount</strong></td>
                            <td><?= number_format($loan->installment_amount, 2) ?> BDT</td>
                        </tr>
                        <tr>
                            <td><strong>Installment Count</strong></td>
                            <td><?= $loan->installment_count ?></td>
                        </tr>
                        <tr>
                            <td><strong>Start Date</strong></td>
                            <td><?= $loan->start_date ?></td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                                <?= $loan->status == 0 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Completed</span>' ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-4 border-top pt-3">
                    <div class="col-12">
                        <h5 class="text-muted mb-3">Repayment Schedule</h5>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Month</th>
                                    <th>Payment Date</th>
                                    <th>Installment Amount</th>
                                    <th>Remaining Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $startDate = new DateTime($loan->start_date);
                                $remaining = $loan->remaining_amount;
                                $installment = $loan->installment_amount;

                                for ($i = 1; $i <= $loan->installment_count; $i++) {
                                    $startDate->modify('+1 month');
                                    $paymentDate = $startDate->format('Y-m-d');

                                    $remaining = $remaining - $installment;
                                    if ($remaining < 0) $remaining = 0;

                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $paymentDate ?></td>
                                        <td><?= number_format($installment, 2) ?></td>
                                        <td><?= number_format($remaining, 2) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../../component/footer.php"; ?>