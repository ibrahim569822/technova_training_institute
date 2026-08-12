<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT invoices.*, trainees.full_name as trainee_name 
        FROM invoices 
        JOIN trainees ON invoices.trainee_id = trainees.id 
        WHERE invoices.id = $id AND invoices.deleted_at IS NULL";

$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Invoice not found.');
    echo "<script>window.location.href = '" . $base_url . "invoices/list.php';</script>";
    exit;
}
$invoice = $data['data'][0];

//  Due Amount Calculation
$due_amount = $invoice->grand_total - $invoice->paid_amount;
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Edit Invoice</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>invoices/update.php" method="POST" class="p-4">
                    <input type="hidden" name="id" value="<?= $invoice->id ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trainee_id" class="form-label">Select Trainee</label>
                            <select class="form-select" id="trainee_id" name="trainee_id" required>
                                <?php
                                $trainees = $crud->common_query("SELECT id, full_name FROM trainees WHERE deleted_at IS NULL");
                                if ($trainees['status']) {
                                    foreach ($trainees['data'] as $trainee) {
                                        $selected = ($trainee->id == $invoice->trainee_id) ? 'selected' : '';
                                        echo "<option value='{$trainee->id}' {$selected}>{$trainee->full_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invoice_no" class="form-label">Invoice No</label>
                            <input type="text" class="form-control" id="invoice_no" value="<?= $invoice->invoice_no ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="invoice_date" class="form-label">Invoice Date</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="<?= $invoice->invoice_date ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sub_total" class="form-label">Sub Total (Amount)</label>
                            <input type="number" step="0.01" class="form-control" id="sub_total" name="sub_total" value="<?= $invoice->sub_total ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="discount_amount" class="form-label">Discount Amount</label>
                            <input type="number" step="0.01" class="form-control" id="discount_amount" name="discount_amount" value="<?= $invoice->discount_amount ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="discount_type" class="form-label">Discount Type</label>
                            <select class="form-select" id="discount_type" name="discount_type">
                                <option value="1" <?= $invoice->discount_type == 1 ? 'selected' : '' ?>>Fixed (BDT)</option>
                                <option value="2" <?= $invoice->discount_type == 2 ? 'selected' : '' ?>>Percentage (%)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="vat" class="form-label">VAT</label>
                            <input type="number" step="0.01" class="form-control" id="vat" name="vat" value="<?= $invoice->vat ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-select" id="payment_status" name="payment_status" required>
                                <option value="0" <?= $invoice->payment_status == 0 ? 'selected' : '' ?>>Pending</option>
                                <option value="1" <?= $invoice->payment_status == 1 ? 'selected' : '' ?>>Paid</option>
                                <option value="2" <?= $invoice->payment_status == 2 ? 'selected' : '' ?>>Partial</option>
                            </select>
                        </div>
                    </div>

                    <!--  Payment Summary Section -->
                    <div class="row mt-4 border-top pt-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Grand Total</label>
                            <input type="text" class="form-control" value="<?= number_format($invoice->grand_total, 2) ?> BDT" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Already Paid</label>
                            <input type="text" class="form-control" value="<?= number_format($invoice->paid_amount, 2) ?> BDT" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-danger">Due Amount</label>
                            <input type="text" class="form-control text-danger fw-bold" value="<?= number_format($due_amount, 2) ?> BDT" disabled>
                        </div>
                    </div>

                    <!--  Additional Payment Section -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="additional_payment" class="form-label">Additional Payment (Due)</label>
                            <input type="number" step="0.01" class="form-control" id="additional_payment" name="additional_payment" value="0.00" oninput="updatePaymentStatus()">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="new_payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="new_payment_method" name="new_payment_method">
                                <option value="0">Bkash</option>
                                <option value="1">Cash</option>
                                <option value="2">Nagad</option>
                                <option value="3">Card</option>
                                <option value="4">Bank</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Update Invoice</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>

<!--  JavaScript for Auto Payment Status Update -->
<script>
function updatePaymentStatus() {
    const grandTotal = <?= $invoice->grand_total ?>;
    const alreadyPaid = <?= $invoice->paid_amount ?>;
    const additionalPayment = parseFloat(document.getElementById('additional_payment').value) || 0;
    const statusSelect = document.getElementById('payment_status');
    
    const totalPaid = alreadyPaid + additionalPayment;
    
    if (totalPaid >= grandTotal) {
        statusSelect.value = '1'; // Paid
    } else if (totalPaid > 0) {
        statusSelect.value = '2'; // Partial
    } else {
        statusSelect.value = '0'; // Pending
    }
}
</script>