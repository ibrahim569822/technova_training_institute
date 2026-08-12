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
                        <a href="create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
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
                                    JOIN courses ON batches.course_id = courses.id 
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
                                    else { echo '<span class="badge bg-warning text-dark mb-2">Upcoming</span>'; }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $base_url; ?>batches/view.php?id=<?= $batch->id ?>" class="btn btn-sm btn-info mb-2"><i class="fa-regular fa-eye"></i></a>
                                    <a href="<?= $base_url; ?>batches/edit.php?id=<?= $batch->id ?>" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="<?= $base_url; ?>batches/delete.php?id=<?= $batch->id ?>" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Are you sure you want to delete this batch?')"><i class="fa-solid fa-trash-can"></i></a>
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
                        <?php
                            // 🔥 enrollments টেবিলের মোট রেকর্ড সংখ্যা বের করা
                            $total_records = $crud->number_of_records("batches");
                            $records_per_page = 10;
                            $total_pages = ceil($total_records / $records_per_page);
                            
                            // বর্তমান পৃষ্ঠা (page) বের করা
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            if ($page < 1) $page = 1;
                            if ($page > $total_pages) $page = $total_pages;
                        ?>
                        <ul class="pagination">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= ($page > 1) ? $base_url . 'batches/list.php?page=' . ($page - 1) : '#' ?>" aria-label="Previous">
                                    <i class="fa-solid fa-chevron-left text-size-12"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $base_url ?>batches/list.php?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= ($page < $total_pages) ? $base_url . 'batches/list.php?page=' . ($page + 1) : '#' ?>" aria-label="Next">
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
<?php require_once "../component/footer.php" ?>