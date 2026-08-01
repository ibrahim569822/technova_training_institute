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
                    <h3 class="mb-2 text-size-26 text-color-2">Payments</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <div class="d-flex align-items-center">
                        <!-- Filter Button -->
                        <div class="cursor-pointer bg-white d-flex align-items-center text-color-1 px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter me-3"></i>
                            Filter by
                            <i class="fa-solid fa-chevron-right ms-3 text-size-sm"></i>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= $base_url ?>payments/list.php?status=Paid">Paid</a></li>
                                <li><a class="dropdown-item" href="<?= $base_url ?>payments/list.php?status=Pending">Pending</a></li>
                                <li><a class="dropdown-item" href="<?= $base_url ?>payments/list.php?status=Failed">Failed</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= $base_url ?>payments/list.php">All</a></li>
                            </ul>
                        </div>
                        <!-- Add Payment Button -->
                        <a href="<?= $base_url ?>payments/create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                            <i class="fa-solid fa-plus me-3"></i>
                            Add Payment
                        </a>
                    </div>
                </div>
            </div><!-- end card header -->
        </div>
        <!--end col-->
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive table-rounded-top">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all" class="custom-checkbox"></th>
                                <th>Invoice</th>
                                <th>Student Name</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Get current page number
                            if(isset($_GET['page']) && is_numeric($_GET['page'])){
                                $page = (int)$_GET['page'];
                            } else {
                                $page = 1;
                            }
                            
                            $records_per_page = 10;
                            $offset = ($page - 1) * $records_per_page;
                            
                            // Build filter condition
                            $conditions = [];
                            if(isset($_GET['status']) && !empty($_GET['status'])) {
                                $conditions['payment_status'] = $_GET['status'];
                            }
                            
                            // Fetch payments from database
                            $payments = $crud->common_select(
                                "payments", 
                                "*", 
                                $conditions, 
                                'AND', 
                                'id', 
                                'DESC', 
                                $records_per_page, 
                                $offset
                            );
                            
                            if($payments['status'] && !empty($payments['data'])){
                                foreach ($payments['data'] as $payment) {
                                    // Get student name from invoice
                                    $student_name = 'N/A';
                                    $invoice = $crud->common_select("invoice", "*", ['id' => $payment->invoice_id]);
                                    if($invoice['status'] && !empty($invoice['data'])) {
                                        $invoice_data = $invoice['data'][0];
                                        // Check if student_id exists in invoice
                                        if(isset($invoice_data->student_id)) {
                                            $trainee = $crud->common_select("trainees", "full_name", ['id' => $invoice_data->student_id]);
                                            if($trainee['status'] && !empty($trainee['data'])) {
                                                $student_name = $trainee['data'][0]->full_name;
                                            }
                                        }
                                    }
                            ?>
                            <tr>
                                <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                <td>
                                    <a href="<?= $base_url ?>invoices/view.php?id=<?= $payment->invoice_id ?>" class="text-primary fw-bold">
                                        INV-<?= str_pad($payment->invoice_id, 6, '0', STR_PAD_LEFT) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($student_name) ?></td>
                                <td>$<?= number_format($payment->amount, 2) ?></td>
                                <td><?= date('d-m-Y', strtotime($payment->payment_date)) ?></td>
                                <td>
                                    <?php 
                                    $method_icons = [
                                        'Cash' => 'fa-money-bill-wave',
                                        'Bkash' => 'fa-mobile-screen',
                                        'Nagad' => 'fa-mobile-screen',
                                        'Card' => 'fa-credit-card',
                                        'Bank' => 'fa-building-columns'
                                    ];
                                    $icon = $method_icons[$payment->payment_method] ?? 'fa-money-bill';
                                    ?>
                                    <span class="badge bg-info">
                                        <i class="fa-solid <?= $icon ?> me-1"></i>
                                        <?= $payment->payment_method ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($payment->payment_status == 'Paid') { ?>
                                        <span class="badge bg-success">Paid</span>
                                    <?php } elseif ($payment->payment_status == 'Pending') { ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php } elseif ($payment->payment_status == 'Failed') { ?>
                                        <span class="badge bg-danger">Failed</span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary">N/A</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $base_url ?>payments/view.php?id=<?= $payment->id ?>" class="btn btn-sm btn-info mb-2 mb-lg-0 me-0 me-lg-2">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <a href="<?= $base_url ?>payments/edit.php?id=<?= $payment->id ?>" class="btn btn-sm btn-primary mb-2 mb-lg-0 me-0 me-lg-2">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?= $base_url ?>payments/delete.php?id=<?= $payment->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this payment?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else { 
                            ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fa-regular fa-circle-xmark fa-2x mb-2 d-block"></i>
                                        No payments found
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
                    <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
                        <?php
                        // Get total records with filter
                        $total_conditions = [];
                        if(isset($_GET['status']) && !empty($_GET['status'])) {
                            $total_conditions['payment_status'] = $_GET['status'];
                        }
                        $total_records = $crud->number_of_records("payments", $total_conditions);
                        $total_pages = ceil($total_records / $records_per_page);
                        ?>
                        <ul class="pagination">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $base_url ?>payments/list.php?page=<?= $page-1 ?><?= isset($_GET['status']) ? '&status='.$_GET['status'] : '' ?>" aria-label="Previous">
                                    <i class="fa-solid fa-chevron-left text-size-12"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $base_url ?>payments/list.php?page=<?= $i ?><?= isset($_GET['status']) ? '&status='.$_GET['status'] : '' ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $base_url ?>payments/list.php?page=<?= $page+1 ?><?= isset($_GET['status']) ? '&status='.$_GET['status'] : '' ?>" aria-label="Next">
                                    <i class="fa-solid fa-chevron-right text-size-12"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- <div class="d-flex justify-content-end">
                        <div class="page-selector">
                            <span>PAGE</span>
                            <select class="form-select" aria-label="Select page">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <span>OF 102</span>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>