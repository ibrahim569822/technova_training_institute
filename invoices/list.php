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
                    <a href="<?= $base_url; ?>invoices/create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                        <i class="fa-solid fa-plus me-3"></i> Add Invoice
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
                                <th>Sl.No</th>
                                <th>Trainee Name</th>
                                <th>Batch</th>
                                <th>Enrollment Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            $sql = "SELECT enrollments.*, trainees.full_name as trainee_name, batches.batch_name 
                                    FROM enrollments 
                                    JOIN trainees ON enrollments.trainee_id = trainees.id 
                                    JOIN batches ON enrollments.batch_id = batches.id 
                                    WHERE enrollments.deleted_at IS NULL";

                            $result = $crud->common_query($sql);
                            if ($result['status']) {
                                $i = 1;
                                foreach ($result['data'] as $enroll) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $enroll->trainee_name ?></td>
                                <td><?= $enroll->batch_name ?></td>
                                <td><?= $enroll->enrollment_date ?></td>
                                <td>
                                    <?php 
                                    if ($enroll->status == 0) { echo '<span class="badge bg-warning text-dark">Enrolled</span>'; }
                                    elseif ($enroll->status == 1) { echo '<span class="badge bg-success">Completed</span>'; }
                                    elseif ($enroll->status == 2) { echo '<span class="badge bg-danger">Dropped</span>'; }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $base_url; ?>enrollments/invoice.php?id=<?= $enroll->id ?>" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-file-invoice"></i></a>
                                    <a href="<?= $base_url; ?>enrollments/edit.php?id=<?= $enroll->id ?>" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="<?= $base_url; ?>enrollments/delete.php?id=<?= $enroll->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No enrollments found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>