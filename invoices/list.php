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
                    <h3 class="mb-2 text-size-26 text-color-2">Invoices</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url; ?>invoices/create.php" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i> Add Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive table-rounded-top">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Trainee Name</th>
                                <th>Amount</th>
                                <th>Paid Amount</th>  
                                <th>Invoice Date</th>
                                <th>Payment Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT invoices.*, trainees.full_name as trainee_name 
                                        FROM invoices 
                                        JOIN trainees ON invoices.trainee_id = trainees.id 
                                        WHERE invoices.deleted_at IS NULL 
                                        ORDER BY invoices.id DESC";

                                $result = $crud->common_query($sql);

                            if ($result['status'] && !empty($result['data'])) {
                                foreach ($result['data'] as $invoice) {
                            ?>
                            <tr>
                                <td>
                                    <a href="<?= $base_url; ?>invoices/view.php?id=<?= $invoice->id ?>" class="text-primary fw-bold">
                                        <?= htmlspecialchars($invoice->invoice_no) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($invoice->trainee_name) ?></td>
                                <td><?= number_format($invoice->grand_total, 2) ?> BDT</td>
                                <td><?= number_format($invoice->paid_amount, 2) ?> BDT</td>  
                                <td><?= date('d-m-Y', strtotime($invoice->invoice_date)) ?></td>
                                <td>
                                    <?php 
                                    if ($invoice->payment_status == 0) { 
                                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                                    } elseif ($invoice->payment_status == 1) { 
                                        echo '<span class="badge bg-success">Paid</span>';
                                    } elseif ($invoice->payment_status == 2) { 
                                        echo '<span class="badge bg-info">Partial</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $base_url; ?>invoices/view.php?id=<?= $invoice->id ?>" class="btn btn-sm btn-info mb-1" title="View">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="<?= $base_url; ?>invoices/edit.php?id=<?= $invoice->id ?>" class="btn btn-sm btn-primary mb-1" title="Edit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    
                                    <a href="<?= $base_url; ?>invoices/generate.php?id=<?= $invoice->id ?>" class="btn btn-sm btn-success mb-1" title="Print/PDF" target="_blank">
                                        <i class="fa-solid fa-print"></i>
                                    </a>
                                    <a href="<?= $base_url; ?>invoices/delete.php?id=<?= $invoice->id ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center py-4'>No invoices found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
                    <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
                        <?php
                           
                            $total_records = $crud->number_of_records("invoices");
                            $records_per_page = 10;
                            $total_pages = ceil($total_records / $records_per_page);
                            
                            
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            if ($page < 1) $page = 1;
                            if ($page > $total_pages) $page = $total_pages;
                        ?>
                        <ul class="pagination">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= ($page > 1) ? $base_url . 'invoices/list.php?page=' . ($page - 1) : '#' ?>" aria-label="Previous">
                                    <i class="fa-solid fa-chevron-left text-size-12"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $base_url ?>invoices/list.php?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= ($page < $total_pages) ? $base_url . 'invoices/list.php?page=' . ($page + 1) : '#' ?>" aria-label="Next">
                                    <i class="fa-solid fa-chevron-right text-size-12"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>