<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Create Voucher</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="voucher_store.php" method="POST" class="p-4">
                    <input type="hidden" name="type" value="<?= $_GET['type'] ?? 'payment' ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="voucher_type" class="form-label">Voucher Type</label>
                            <select name="voucher_type" id="voucher_type" class="form-select" onchange="window.location.href='?type='+this.value">
                                <option value="payment" <?= ($_GET['type'] ?? 'payment') == 'payment' ? 'selected' : '' ?>>Payment Voucher</option>
                                <option value="receive" <?= ($_GET['type'] ?? 'payment') == 'receive' ? 'selected' : '' ?>>Receive Voucher</option>
                                <option value="journal" <?= ($_GET['type'] ?? 'payment') == 'journal' ? 'selected' : '' ?>>Journal Voucher</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="voucher_date" class="form-label">Voucher Date</label>
                            <input type="date" name="voucher_date" id="voucher_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="narration" class="form-label">Narration</label>
                            <input type="text" name="narration" id="narration" class="form-control" placeholder="e.g. Payment to Supplier / Received from Customer" required>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="voucherTable">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 30%;">Account Head</th>
                                    <th style="width: 20%;">Debit (Dr)</th>
                                    <th style="width: 20%;">Credit (Cr)</th>
                                    <th style="width: 25%;">Remarks</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="voucherItems">
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Select an account head below to add a row.</td>
                                </tr>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="1" class="text-end">Total Debit:</th>
                                    <td><input type="text" name="total_dr" id="totalDr" class="form-control" readonly></td>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <th colspan="1" class="text-end">Total Credit:</th>
                                    <td><input type="text" name="total_cr" id="totalCr" class="form-control" readonly></td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Account Head to Add</label>
                                <select id="accountHeadSelector" class="form-select">
                                    <option value="">Select Account</option>
                                    <?php
                                    $accounts = $crud->common_query("SELECT id, account_name FROM account_heads WHERE deleted_at IS NULL");
                                    foreach ($accounts['data'] as $a) {
                                        echo "<option value='{$a->id}' data-name='{$a->account_name}'>{$a->account_name}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-4">
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Save Voucher</button>
                            <a href="<?= $base_url; ?>accounts/payment_vouchers.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const accountSelector = document.getElementById('accountHeadSelector');
    const voucherItemsBody = document.getElementById('voucherItems');
    const totalDrInput = document.getElementById('totalDr');
    const totalCrInput = document.getElementById('totalCr');

    let voucherRows = [];


    accountSelector.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const accountId = selected.value;
        const accountName = selected.dataset.name;

        if (accountId && !voucherRows.some(row => row.account_id === accountId)) {
            voucherRows.push({
                account_id: accountId,
                account_name: accountName,
                dr: 0,
                cr: 0,
                remarks: ''
            });
            renderTable();
            calculateTotals();
        }
        this.value = ''; 
    });

    function renderTable() {
        voucherItemsBody.innerHTML = '';
        if (voucherRows.length === 0) {
            voucherItemsBody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No rows added. Select an account head above.</td></tr>';
            return;
        }

        voucherRows.forEach((row, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    ${row.account_name}
                    <input type="hidden" name="account_id[]" value="${row.account_id}">
                </td>
                <td>
                    <input type="number" step="0.01" name="dr[]" class="form-control dr-input" data-index="${index}" value="${row.dr}" placeholder="0.00">
                </td>
                <td>
                    <input type="number" step="0.01" name="cr[]" class="form-control cr-input" data-index="${index}" value="${row.cr}" placeholder="0.00">
                </td>
                <td>
                    <input type="text" name="remarks[]" class="form-control remarks-input" data-index="${index}" value="${row.remarks}" placeholder="Remarks">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger remove-row" data-index="${index}">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
            voucherItemsBody.appendChild(tr);
        });

        
        document.querySelectorAll('.dr-input').forEach(input => {
            input.addEventListener('input', function() {
                const idx = this.dataset.index;
                voucherRows[idx].dr = parseFloat(this.value) || 0;
                calculateTotals();
            });
        });

        document.querySelectorAll('.cr-input').forEach(input => {
            input.addEventListener('input', function() {
                const idx = this.dataset.index;
                voucherRows[idx].cr = parseFloat(this.value) || 0;
                calculateTotals();
            });
        });

        
        document.querySelectorAll('.remove-row').forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = this.dataset.index;
                voucherRows.splice(idx, 1);
                renderTable();
                calculateTotals();
            });
        });
    }

    function calculateTotals() {
        const totalDr = voucherRows.reduce((sum, row) => sum + row.dr, 0);
        const totalCr = voucherRows.reduce((sum, row) => sum + row.cr, 0);
        totalDrInput.value = totalDr.toFixed(2);
        totalCrInput.value = totalCr.toFixed(2);
    }
});
</script>