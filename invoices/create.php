<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<!-- Main Content -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Create Invoice</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>invoices/store.php" method="POST" class="p-4" id="invoiceForm">
                   
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trainee_id" class="form-label">Select Trainee</label>
                            <select onchange="loadBatchOptions(this.value)" class="form-select" id="trainee_id" name="trainee_id" required>
                                <option value="">Select Trainee</option>
                                <?php
                                $trainees = $crud->common_query("SELECT id, full_name FROM trainees WHERE deleted_at IS NULL");
                                if ($trainees['status']) {
                                    foreach ($trainees['data'] as $trainee) {
                                        echo "<option value='{$trainee->id}'>{$trainee->full_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="invoice_date" class="form-label">Invoice Date</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="invoice-table">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 30%;">Batch</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>VAT</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="invoice-items">
                                <!-- Invoice items will be populated here via JavaScript -->
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Select a trainee first to load batches.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <button type="button" class="btn btn-secondary mb-3 float-end" onclick="addMoreItems()">
                        <i class="fa-solid fa-plus"></i> Add Item
                    </button>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Any additional notes..."></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th>Total</th>
                                                        <td><input type="number" step="0.01" class="form-control" name="total" id="total" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount</th>
                                                        <td><input type="number" step="0.01" class="form-control" name="total_discount" id="total_discount" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th>VAT</th>
                                                        <td><input type="number" step="0.01" class="form-control" name="total_vat" id="total_vat" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Grand Total</th>
                                                        <td><input type="number" step="0.01" class="form-control" name="grand_total" id="grand_total" readonly></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-select" id="payment_status" name="payment_status" required>
                                <option value="0">Pending</option>
                                <option value="1">Paid</option>
                                <option value="2">Partial</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method">
                                <option value="0">Bkash</option>
                                <option value="1">Cash</option>
                                <option value="2">Nagad</option>
                                <option value="3">Card</option>
                                <option value="4">Bank</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" step="0.01" class="form-control" name="paid_amount" id="paid_amount" value="0.00" oninput="generateTransactionId()">
                        </div>
                    </div>
                    
                    <!--  hidden transaction id field -->
                    <input type="hidden" name="transaction_id" id="transaction_id">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save"></i> Save Invoice
                            </button>
                            <a href="<?= $base_url; ?>invoices/list.php" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php" ?>

<!-- JavaScript Logic (Auto Transaction ID + Batch Loading) -->
<script>
    var batches = '';

    // Transaction ID Auto Generator
    function generateTransactionId() {
        var paidAmount = parseFloat(document.getElementById('paid_amount').value);
        if (paidAmount > 0) {
            var now = new Date();
            var dateStr = now.getFullYear() + 
                         String(now.getMonth() + 1).padStart(2, '0') + 
                         String(now.getDate()).padStart(2, '0');
            var randomNum = Math.floor(1000 + Math.random() * 9000);
            document.getElementById('transaction_id').value = 'TXN-' + dateStr + '-' + randomNum;
        } else {
            document.getElementById('transaction_id').value = '';
        }
    }

    function loadBatchOptions(traineeId) {
        if (!traineeId) {
            document.getElementById('invoice-items').innerHTML = '<tr><td colspan="5" class="text-center text-muted">Select a trainee first to load batches.</td></tr>';
            return;
        }
        
        batches = '<option value="">Loading...</option>';

        fetch(`<?= $base_url; ?>invoices/get_batches.php?trainee_id=${traineeId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.status) {
                    batches = '<option value="">No batches found</option>';
                    document.getElementById('invoice-items').innerHTML = `<tr><td colspan="5" class="text-center text-warning">${data.message}</td></tr>`;
                    return;
                } else {
                    batches = '<option value="">Select Batch</option>';
                }
                
                data.data.forEach(batch => {
                    batches += '<option data-price="' + batch.Price + '" data-discount="' + batch.Discount + '" data-discount-type="' + batch.Discount_type + '" value="' + batch.batch_id + '">' + batch.batch_name + ' - ' + batch.course_name + '</option>';
                });
                
                loadInvoiceData();
            })
            .catch(error => {
                console.error('Error fetching batches:', error);
                batches = '<option value="">Error loading batches</option>';
                document.getElementById('invoice-items').innerHTML = '<tr><td colspan="5" class="text-center text-danger">Error loading batches</td></tr>';
            });
    }

    function loadInvoiceData() {
        let batchSelect = batches;
        let invoiceItems = document.getElementById('invoice-items');
        invoiceItems.innerHTML = `
            <tr>
                <td>
                    <select onchange="updateInvoiceItem(this)" class="form-select" name="batch_id[]" required>
                        ${batchSelect}
                    </select>
                </td>
                <td><input type="number" step="0.01" class="form-control" name="price[]" required readonly></td>
                <td><input type="number" step="0.01" class="form-control" name="discount[]" required readonly></td>
                <td><input type="number" step="0.01" class="form-control" name="vat[]" required readonly></td>
                <td><input type="number" step="0.01" class="form-control" name="sub_total[]" readonly></td>
            </tr>
        `;
    }

    function addMoreItems() {
        if (batches === '' || batches.includes('No batches')) {
            alert('Please select a trainee with valid batches first.');
            return;
        }
        
        let batchSelect = batches;
        let invoiceItems = document.getElementById('invoice-items');
        let newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select onchange="updateInvoiceItem(this)" class="form-select" name="batch_id[]" required>
                    ${batchSelect}
                </select>
            </td>
            <td><input type="number" step="0.01" class="form-control" name="price[]" required readonly></td>
            <td><input type="number" step="0.01" class="form-control" name="discount[]" required readonly></td>
            <td><input type="number" step="0.01" class="form-control" name="vat[]" required readonly></td>
            <td><input type="number" step="0.01" class="form-control" name="sub_total[]" readonly></td>
        `;
        invoiceItems.appendChild(newRow);
    }

    function updateInvoiceItem(selectElement) {
        let selectedOption = selectElement.options[selectElement.selectedIndex];
        let price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        let discount = parseFloat(selectedOption.getAttribute('data-discount')) || 0;
        let discountType = selectedOption.getAttribute('data-discount-type') || '1';
        let vatRate = 0.15; // Assuming a VAT rate of 15%
        
        let row = selectElement.closest('tr');
        let priceInput = row.querySelector('input[name="price[]"]');
        let discountInput = row.querySelector('input[name="discount[]"]');
        let vatInput = row.querySelector('input[name="vat[]"]');
        let subTotalInput = row.querySelector('input[name="sub_total[]"]');

        priceInput.value = price.toFixed(2);

        // Calculate Discount based on type
        let calculatedDiscount = 0;
        if (discountType === '2') {
            calculatedDiscount = price * (discount / 100);
        } else {
            calculatedDiscount = discount;
        }
        discountInput.value = calculatedDiscount.toFixed(2);

        // Calculate VAT on (Price - Discount)
        let taxableAmount = price - calculatedDiscount;
        let vatAmount = taxableAmount * vatRate;
        vatInput.value = vatAmount.toFixed(2);

        // Calculate Sub Total
        let subTotal = price - calculatedDiscount + vatAmount;
        subTotalInput.value = subTotal.toFixed(2);

        calculateTotals();
    }

    function calculateTotals() {
        let total = 0;
        let totalDiscount = 0;
        let totalVat = 0;
        let grandTotal = 0;

        document.querySelectorAll('#invoice-items tr').forEach(row => {
            let price = parseFloat(row.querySelector('input[name="price[]"]').value) || 0;
            let discount = parseFloat(row.querySelector('input[name="discount[]"]').value) || 0;
            let vat = parseFloat(row.querySelector('input[name="vat[]"]').value) || 0;

            total += price;
            totalDiscount += discount;
            totalVat += vat;
        });

        grandTotal = total - totalDiscount + totalVat;

        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('total_discount').value = totalDiscount.toFixed(2);
        document.getElementById('total_vat').value = totalVat.toFixed(2);
        document.getElementById('grand_total').value = grandTotal.toFixed(2);
    }

</script>