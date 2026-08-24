<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Salary List</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="generate.php" class="btn btn-success">
                        <i class="fa-solid fa-plus me-2"></i> Generate Salary
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT `month`, sum(`net_payable`) as net_payable FROM `trainer_salary_payments` WHERE `month` LIKE '" . date('Y') . "%' GROUP BY `month`";
                $result = $crud->common_query($sql);
                foreach ($result['data'] as $row) {
                ?>
                <tr>
                    <td><?= $row->month ?></td>
                    <td><?= number_format($row->net_payable, 2) ?></td>
                    <td>
                        <a href="view.php?month=<?= $row->month ?>" class="btn btn-sm btn-info">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "../../component/footer.php"; ?>