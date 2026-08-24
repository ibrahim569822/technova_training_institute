<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php

$income_query = $crud->common_query("
    SELECT SUM(pvd.credit_amount) as total 
    FROM payment_voucher_details pvd
    JOIN payment_vouchers pv ON pv.id = pvd.payment_voucher_id
    WHERE pvd.account_head_id IN (
        SELECT id FROM account_heads WHERE account_type = 3 AND deleted_at IS NULL
    )
    AND pvd.deleted_at IS NULL
    AND pv.deleted_at IS NULL
");
$total_income = $income_query['data'][0]->total ?? 0;


$expense_query = $crud->common_query("
    SELECT SUM(pvd.debit_amount) as total 
    FROM payment_voucher_details pvd
    JOIN payment_vouchers pv ON pv.id = pvd.payment_voucher_id
    WHERE pvd.account_head_id IN (
        SELECT id FROM account_heads WHERE account_type = 4 AND deleted_at IS NULL
    )
    AND pvd.deleted_at IS NULL
    AND pv.deleted_at IS NULL
");
$total_expense = $expense_query['data'][0]->total ?? 0;


$profit_loss = $total_income - $total_expense;
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3">Profit & Loss Statement</h3>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="text-success">Total Income</h5>
                            <h3 class="fw-bold"><?= number_format($total_income, 2) ?> BDT</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="text-danger">Total Expense</h5>
                            <h3 class="fw-bold"><?= number_format($total_expense, 2) ?> BDT</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <div class="card <?= ($profit_loss >= 0) ? 'border-success' : 'border-danger' ?>">
                        <div class="card-body">
                            <h4 class="fw-bold <?= ($profit_loss >= 0) ? 'text-success' : 'text-danger' ?>">
                                <?= ($profit_loss >= 0) ? 'Net Profit' : 'Net Loss' ?>
                            </h4>
                            <h2 class="fw-bold <?= ($profit_loss >= 0) ? 'text-success' : 'text-danger' ?>">
                                <?= number_format(abs($profit_loss), 2) ?> BDT
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php"; ?>