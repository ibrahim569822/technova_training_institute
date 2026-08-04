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
                    <h3 class="mb-2 text-size-26 text-color-2">Batches</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <div class="d-flex align-items-center">
                        <!-- Filter Button -->
                        <div class="cursor-pointer bg-white d-flex align-items-center text-color-1 px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter me-3"></i> Filter by
                            <i class="fa-solid fa-chevron-right ms-3 text-size-sm"></i>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Upcoming</a></li>
                                <li><a class="dropdown-item" href="#">Running</a></li>
                                <li><a class="dropdown-item" href="#">Completed</a></li>
                            </ul>
                        </div>
                        <!-- Add Button -->
                        <a href="<?= $base_url; ?>batches/create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                            <i class="fa-solid fa-plus me-3"></i> Add Batch
                        </a>
                    </div>
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
                                <th>Batch Name</th>
                                <th>Course</th>
                                <th>Trainer</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                       
                            $sql = "SELECT batches.*, courses.course_name, users.full_name as trainer_name 
                                    FROM batches 
                                    JOIN courses ON batches.course_id = courses.course_id 
                                    JOIN trainers ON batches.trainer_id = trainers.id 
                                    JOIN users ON trainers.user_id = users.id 
                                    WHERE batches.deleted_at IS NULL";

                            $result = $crud->common_query($sql);
                            if ($result['status']) {
                                foreach ($result['data'] as $batch) {
                            ?>
                            <tr>
                                <td><?= $batch->batch_name ?></td>
                                <td><?= $batch->course_name ?></td>
                                <td><?= $batch->trainer_name ?></td>
                                <td><?= $batch->Start_date ?></td>
                                <td><?= $batch->End_date ?></td>
                                <td><?= number_format($batch->Price, 2) ?></td>
                                <td>
                                    <?php 
                                    if ($batch->status == 1) { echo '<span class="badge bg-success">Running</span>'; }
                                    elseif ($batch->status == 2) { echo '<span class="badge bg-secondary">Completed</span>'; }
                                    else { echo '<span class="badge bg-warning text-dark">Upcoming</span>'; }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $base_url; ?>batches/view.php?id=<?= $batch->id ?>" class="btn btn-sm btn-info mb-2"><i class="fa-regular fa-eye"></i></a>
                                    <a href="<?= $base_url; ?>batches/edit.php?id=<?= $batch->id ?>" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="<?= $base_url; ?>batches/delete.php?id=<?= $batch->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this batch?')"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No batches found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
              
                <div class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
                    <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-chevron-left text-size-12"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-ellipsis-h"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><i class="fa-solid fa-chevron-right text-size-12"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>