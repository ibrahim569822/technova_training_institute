<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Take Loan</h3>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="loan_store.php" method="POST" class="p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Teacher</label>
                            <select name="teacher_id" class="form-select" required>
                                <option value="">Select Trainer</option>
                                <?php
                                $teachers = $crud->common_query("SELECT trainers.id, users.full_name FROM trainers JOIN users ON trainers.user_id = users.id WHERE trainers.deleted_at IS NULL");
                                foreach ($teachers['data'] as $t) {
                                    echo "<option value='{$t->id}'>{$t->full_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Loan Amount</label>
                            <input type="number" step="0.01" name="loan_amount" id="loanAmount" class="form-control" oninput="calculateLoan()" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Installments (Months)</label>
                            <input type="number" name="installment_count" id="installmentCount" class="form-control" oninput="calculateLoan()" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" id="startDate" class="form-control" onchange="calculateLoan()" required>
                        </div>
                    </div>

                   
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5 class="text-muted mb-3">Loan Repayment Schedule</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Month</th>
                                        <th>Payment Date</th>
                                        <th>Installment Amount</th>
                                        <th>Remaining Balance</th>
                                    </tr>
                                </thead>
                                <tbody id="loanPreviewBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success">Save Loan</button>
                            <a href="loan_list.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "../../component/footer.php"; ?>

<script>
    function calculateLoan() {
        const loanAmount = parseFloat(document.getElementById('loanAmount').value) || 0;
        const installmentCount = parseInt(document.getElementById('installmentCount').value) || 0;
        const startDate = document.getElementById('startDate').value;

        if (loanAmount > 0 && installmentCount > 0 && startDate) {
            const installmentAmount = loanAmount / installmentCount;
            let remainingBalance = loanAmount;
            let currentDate = new Date(startDate);
            const tableBody = document.getElementById('loanPreviewBody');
            tableBody.innerHTML = '';

            for (let i = 1; i <= installmentCount; i++) {
                
                currentDate.setMonth(currentDate.getMonth() + 1);
                const paymentDate = currentDate.toISOString().split('T')[0];
                remainingBalance = remainingBalance - installmentAmount;
                if (remainingBalance < 0) remainingBalance = 0;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${i}</td>
                    <td>${paymentDate}</td>
                    <td>${installmentAmount.toFixed(2)}</td>
                    <td>${remainingBalance.toFixed(2)}</td>
                `;
                tableBody.appendChild(row);
            }
        } else {
            document.getElementById('loanPreviewBody').innerHTML = '<tr><td colspan="4" class="text-center text-muted">Fill up Loan Amount, Installments and Start Date to see the schedule.</td></tr>';
        }
    }
</script>