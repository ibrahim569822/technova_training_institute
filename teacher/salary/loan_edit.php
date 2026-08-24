<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$row = $crud->common_query("SELECT * FROM trainer_loans WHERE id = $id AND deleted_at IS NULL")['data'][0];

$remaining_amount = $row->remaining_amount;
$installment_amount = $row->installment_amount;
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Edit Loan</h3>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="loan_update.php" method="POST" class="p-4">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Teacher</label>
                            <select name="teacher_id" class="form-select" required>
                                <option value="">Select Teacher</option>
                                <?php
                                $teachers = $crud->common_query("SELECT trainers.id, users.full_name FROM trainers JOIN users ON trainers.user_id = users.id WHERE trainers.deleted_at IS NULL");
                                foreach ($teachers['data'] as $t) {
                                    $selected = ($t->id == $row->trainer_id) ? 'selected' : '';
                                    echo "<option value='{$t->id}' {$selected}>{$t->full_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Loan Amount</label>
                            <input type="number" step="0.01" name="loan_amount" value="<?= $row->loan_amount ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Remaining Balance</label>
                            <input type="number" step="0.01" name="remaining_amount" value="<?= $row->remaining_amount ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Installments</label>
                            <input type="number" name="installment_count" value="<?= $row->installment_count ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Installment Amount</label>
                            <input type="number" step="0.01" name="installment_amount" value="<?= $row->installment_amount ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" value="<?= $row->start_date ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="0" <?= $row->status == 0 ? 'selected' : '' ?>>Active</option>
                                <option value="1" <?= $row->status == 1 ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Update Loan</button>
                            <a href="loan_list.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>

                <div class="border-top pt-3 mt-3 p-4">
                    <h5 class="text-muted">Pay Installment</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Remaining Balance</label>
                            <input type="number" step="0.01" value="<?= $remaining_amount ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Installment Amount</label>
                            <input type="number" step="0.01" value="<?= $installment_amount ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-success w-100" onclick="payInstallment()">
                                <i class="fa-solid fa-money-bill-wave"></i> Pay Installment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../../component/footer.php"; ?>

<script>
    function payInstallment() {
        const remaining = parseFloat(document.querySelector('input[name="remaining_amount"]')?.value || 0);
        const installment = parseFloat(document.querySelector('input[name="installment_amount"]')?.value || 0);
        
        if (remaining > 0 && installment > 0) {
            fetch('<?= $base_url; ?>teacher/salary/loan_pay_process.php?loan_id=<?= $id ?>&installment=<?= $installment_amount ?>')
                .then(response => response.text())
                .then(data => {
                    if (data.includes('success')) {
                        
                        window.location.href = '<?= $base_url; ?>teacher/salary/loan_list.php';
                    } else {
                        alert('Error: ' + data);
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            alert('Remaining balance or installment amount is not available.');
        }
    }
</script>