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
                    <h3 class="mb-2 text-size-26 text-color-2">Invoice</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>invoices/store.php" method="POST" class="p-4">
                   
                
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trainee_id" class="form-label">Trainee</label>
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
                            <label for="batch_id" class="form-label">Date</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
                        </div>
                    </div>
                    
                    <table class="table table-bordered" id="invoice-table">
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Vat</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="invoice-items">
                            <!-- Invoice items will be populated here via JavaScript -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary mb-3 float-end" onclick="addMoreItems()">Add Item</button>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Total</th>
                                        <td><input type="number" class="form-control" name="total" id="total" readonly></td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td><input type="number" class="form-control" name="total_discount" id="total_discount" readonly></td>
                            </tr>
                            <tr>
                                <th>VAT</th>
                                <td><input type="number" class="form-control" name="total_vat" id="total_vat" readonly></td>
                            </tr>
                            <tr>
                                <th>Grand Total</th>
                                <td><input type="number" class="form-control" name="grand_total" id="grand_total" readonly></td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td><input type="number" class="form-control" name="payment_method" id="payment_method" readonly></td>
                            </tr>
                            <tr>
                                <th>Transaction Id:</th>
                                <td><input type="number" class="form-control" name="transaction_id" id="transaction_id" readonly></td>
                            </tr>
                            <tr>
                                <th>Paid Amount</th>
                                <td><input type="number" class="form-control" name="paid_amount" id="paid_amount" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Save Enrollment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>
<!-- vanilla js -->
<script>
    var batches = '';
    function loadBatchOptions(traineeId) {
        batches = '<option value="">Loading...</option>';

        fetch(`<?= $base_url; ?>invoices/get_batches.php?trainee_id=${traineeId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.status) {
                    batches = '<option value="">No batches found</option>';
                    return;
                }else {
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
            });
    }

    function loadInvoiceData(){
        let batchSelect = batches;
        let invoiceItems = document.getElementById('invoice-items');
        invoiceItems.innerHTML = `<tr>
                                <td>
                                    <select onchange="updateInvoiceItem(this)" class="form-select" name="batch_id[]" required>
                                        ${batchSelect}
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" name="price[]" required></td>
                                <td><input type="number" class="form-control" name="discount[]" required></td>
                                <td><input type="number" class="form-control" name="vat[]" required></td>
                                <td><input type="number" class="form-control" name="sub_total[]" readonly></td>
                            </tr>
        `;
    }

    function addMoreItems() {
        let batchSelect = batches;
        let invoiceItems = document.getElementById('invoice-items');
        let newRow = document.createElement('tr');
        newRow.innerHTML = `<td>
                                <select onchange="updateInvoiceItem(this)" class="form-select" name="batch_id[]" required>
                                    ${batchSelect}
                                </select>
                            </td>
                            <td><input type="number" class="form-control" name="price[]" required></td>
                            <td><input type="number" class="form-control" name="discount[]" required></td>
                            <td><input type="number" class="form-control" name="vat[]" required></td>
                            <td><input type="number" class="form-control" name="sub_total[]" readonly></td>`;
        invoiceItems.appendChild(newRow);
    }

    function updateInvoiceItem(selectElement) {
        let selectedOption = selectElement.options[selectElement.selectedIndex];
        let price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        let discount = parseFloat(selectedOption.getAttribute('data-discount')) || 0;
        let discountType = selectedOption.getAttribute('data-discount-type') || 'fixed';
        let vatRate = 0.15; // Assuming a VAT rate of 15%
        
        let row = selectElement.closest('tr');
        let priceInput = row.querySelector('input[name="price[]"]');
        let discountInput = row.querySelector('input[name="discount[]"]');
        let vatInput = row.querySelector('input[name="vat[]"]');
        let subTotalInput = row.querySelector('input[name="sub_total[]"]');

        priceInput.value = price;

        if (discountType === '2') {
            discountInput.value = (price * (discount / 100)).toFixed(2);
        } else {
            discountInput.value = discount.toFixed(2);
        }

        let vatAmount = (price - parseFloat(discountInput.value)) * vatRate;
        vatInput.value = vatAmount.toFixed(2);

        let subTotal = price - parseFloat(discountInput.value) + vatAmount;
        subTotalInput.value = subTotal.toFixed(2);
        calculateTotals();
    }

    function calculateTotals() {
        let total = 0;
        let totalDiscount = 0;
        let totalVat = 0;

        document.querySelectorAll('#invoice-items tr').forEach(row => {
            let price = parseFloat(row.querySelector('input[name="price[]"]').value) || 0;
            let discount = parseFloat(row.querySelector('input[name="discount[]"]').value) || 0;
            let vat = parseFloat(row.querySelector('input[name="vat[]"]').value) || 0;

            total += price;
            totalDiscount += discount;
            totalVat += vat;
        });

        document.getElementById('total').value = total.toFixed(2);
        document.getElementById('total_discount').value = totalDiscount.toFixed(2);
        document.getElementById('total_vat').value = totalVat.toFixed(2);
        document.getElementById('grand_total').value = (total - totalDiscount + totalVat).toFixed(2);
    }

</script>