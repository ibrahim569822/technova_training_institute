<?php require_once "../component/header.php"; ?>
<?php require_once "../component/sidebar.php"; ?>

<div class="main-content">
    <?php
    $voucher_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($voucher_id <= 0) {
        echo '<div class="alert alert-danger mt-3">Invalid voucher ID.</div>';
        require_once "../component/footer.php";
        exit;
    }

    // ---- Header ----
    $header_sql = "
        SELECT pv.*, u.full_name AS created_by_name
        FROM payment_vouchers pv
        JOIN users u ON u.id = pv.created_by
        WHERE pv.id = " . (int) $voucher_id . "
            AND pv.deleted_at IS NULL
    ";
    $header_result = $crud->common_query($header_sql);

    if (!$header_result['status']) {
        echo '<div class="alert alert-warning mt-3">Voucher not found.</div>';
        require_once "../component/footer.php";
        exit;
    }

    $voucher = $header_result['data'][0];

    $type_labels = [1 => 'Payment Voucher', 2 => 'Receive Voucher', 3 => 'Journal Voucher'];
    $type_label = $type_labels[$voucher->voucher_type] ?? 'Unknown';

    // ---- Detail lines ----
    $lines_sql = "
        SELECT pvd.*, ah.account_code, ah.account_name
        FROM payment_voucher_details pvd
        JOIN account_heads ah ON ah.id = pvd.account_head_id
        WHERE pvd.payment_voucher_id = " . (int) $voucher_id . "
            AND pvd.deleted_at IS NULL
        ORDER BY pvd.id ASC
    ";
    $lines_result = $crud->common_query($lines_sql);
    $lines = $lines_result['status'] ? $lines_result['data'] : [];

    $total_dr = 0;
    $total_cr = 0;
    foreach ($lines as $l) {
        $total_dr += $l->debit_amount;
        $total_cr += $l->credit_amount;
    }
    ?>

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2"><?= htmlspecialchars($type_label) ?></h3>
                </div>
                <div>
                    <a href="payment_vouchers.php" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Back to List
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-primary">
                        <i class="fa-solid fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="row mb-4">
                    <div class="col-md-4">
                        <strong>Voucher No:</strong><br>
                        <?= htmlspecialchars($voucher->voucher_no) ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Date:</strong><br>
                        <?= htmlspecialchars($voucher->voucher_date) ?>
                    </div>
                    <div class="col-md-4">
                        <strong>Created By:</strong><br>
                        <?= htmlspecialchars($voucher->created_by_name) ?>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <strong>Narration:</strong><br>
                        <?= htmlspecialchars($voucher->narration) ?>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Account Code</th>
                                <th>Account Name</th>
                                <th class="text-end">Debit (Dr)</th>
                                <th class="text-end">Credit (Cr)</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($lines)): ?>
                                <tr><td colspan="5" class="text-center text-muted">No lines found for this voucher.</td></tr>
                            <?php else: foreach ($lines as $l): ?>
                                <tr>
                                    <td><?= htmlspecialchars($l->account_code) ?></td>
                                    <td><?= htmlspecialchars($l->account_name) ?></td>
                                    <td class="text-end"><?= $l->debit_amount > 0 ? number_format($l->debit_amount, 2) : '-' ?></td>
                                    <td class="text-end"><?= $l->credit_amount > 0 ? number_format($l->credit_amount, 2) : '-' ?></td>
                                    <td><?= htmlspecialchars($l->remarks ?? '') ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                        <tfoot class="table-light fw-bold">
                            <tr>
                                <td colspan="2" class="text-end">Total</td>
                                <td class="text-end"><?= number_format($total_dr, 2) ?></td>
                                <td class="text-end"><?= number_format($total_cr, 2) ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <?php if (round($total_dr, 2) !== round($total_cr, 2)): ?>
                    <div class="alert alert-danger mt-3">
                        Warning: Debit and Credit totals do not match. This voucher may be corrupted.
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>