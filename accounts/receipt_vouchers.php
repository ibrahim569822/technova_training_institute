<?php require_once "../component/header.php"; ?>
<?php require_once "../component/sidebar.php"; ?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Receipt Vouchers</h3>
                </div>
                <div>
                    <a href="voucher_create.php" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> New Receipt Voucher
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success mt-3">Voucher saved successfully.</div>
    <?php endif; ?>

    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Voucher No</th>
                                <th>Date</th>
                                <th>Narration</th>
                                <th class="text-end">Total Amount</th>
                                <th>Created By</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "
                                SELECT
                                    pv.id, pv.voucher_no, pv.voucher_date, pv.narration,
                                    u.full_name AS created_by_name,
                                    SUM(pvd.credit_amount) AS total_amount
                                FROM payment_vouchers pv
                                JOIN users u ON u.id = pv.created_by
                                JOIN payment_voucher_details pvd ON pvd.payment_voucher_id = pv.id
                                WHERE pv.voucher_type = 2
                                    AND pv.deleted_at IS NULL
                                    AND pvd.deleted_at IS NULL
                                GROUP BY pv.id, pv.voucher_no, pv.voucher_date, pv.narration, u.full_name
                                ORDER BY pv.voucher_date DESC, pv.id DESC
                            ";
                            $result = $crud->common_query($sql);
                            ?>

                            <?php if (!$result['status']): ?>
                                <tr><td colspan="6" class="text-center text-muted py-4">No receipt vouchers found.</td></tr>
                            <?php else: foreach ($result['data'] as $v): ?>
                                <tr>
                                    <td><?= htmlspecialchars($v->voucher_no) ?></td>
                                    <td><?= htmlspecialchars($v->voucher_date) ?></td>
                                    <td><?= htmlspecialchars($v->narration) ?></td>
                                    <td class="text-end"><?= number_format($v->total_amount, 2) ?></td>
                                    <td><?= htmlspecialchars($v->created_by_name) ?></td>
                                    <td class="text-center">
                                        <a href="voucher_view.php?id=<?= $v->id ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>