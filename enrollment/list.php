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
                    <h3 class="mb-2 text-size-26 text-color-2">Enrollments</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <div class="d-flex align-items-center">
                        <!-- Filter Button -->
                        <div class="cursor-pointer bg-white d-flex align-items-center text-color-1 px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter me-3"></i>
                            Filter by Status
                            <i class="fa-solid fa-chevron-right ms-3 text-size-sm"></i>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= $base_url ?>enrollments/list.php?status=0">Enrolled</a></li>
                                <li><a class="dropdown-item" href="<?= $base_url ?>enrollments/list.php?status=1">Completed</a></li>
                                <li><a class="dropdown-item" href="<?= $base_url ?>enrollments/list.php?status=2">Dropped</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= $base_url ?>enrollments/list.php">All</a></li>
                            </ul>
                        </div>
                        <!-- Add Enrollment Button -->
                        <a href="<?= $base_url ?>enrollments/create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                            <i class="fa-solid fa-plus me-3"></i>
                            Add Enrollment
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
                                <th><input type="checkbox" id="select-all" class="custom-checkbox"></th>
                                <th>#</th>
                                <th>Trainee</th>
                                <th>Course</th>
                                <th>Enrollment Date</th>
                                <th>Status</th>
                                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Pagination
                            if(isset($_GET['page']) && is_numeric($_GET['page'])){
                                $page = (int)$_GET['page'];
                            } else {
                                $page = 1;
                            }
                            
                            $records_per_page = 10;
                            $offset = ($page - 1) * $records_per_page;
                            
                            // Filter condition
                            $conditions = [];
                            if(isset($_GET['status']) && $_GET['status'] !== '') {
                                $conditions['status'] = $_GET['status'];
                            }
                            
                            // Fetch enrollments
                            $enrollments = $crud->common_select(
                                "enrollment", 
                                "*", 
                                $conditions, 
                                'AND', 
                                'id', 
                                'DESC', 
                                $records_per_page, 
                                $offset
                            );
                            
                            if($enrollments['status'] && !empty($enrollments['data'])){
                                $sl = $offset + 1;
                                foreach ($enrollments['data'] as $enrollment) {
                                    // Get trainee name
                                    $trainee_name = 'N/A';
                                    $trainee = $crud->common_select("trainees", "full_name", ['id' => $enrollment->trainee_id]);
                                    if($trainee['status'] && !empty($trainee['data'])) {
                                        $trainee_name = $trainee['data'][0]->full_name;
                                    }
                                    
                                    // Get course name
                                    $course_name = 'N/A';
                                    $course = $crud->common_select("courses", "course_name", ['id' => $enrollment->course_id]);
                                    if($course['status'] && !empty($course['data'])) {
                                        $course_name = $course['data'][0]->course_name;
                                    }
                            ?>
                            <tr>
                                <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                <td><?= $sl++ ?></td>
                                <td><?= htmlspecialchars($trainee_name) ?></td>
                                <td><?= htmlspecialchars($course_name) ?></td>
                                <td><?= date('d-m-Y', strtotime($enrollment->enrollment_date)) ?></td>
                                <td>
                                    <?php if ($enrollment->status == '0') { ?>
                                        <span class="badge bg-primary">Enrolled</span>
                                    <?php } elseif ($enrollment->status == '1') { ?>
                                        <span class="badge bg-success">Completed</span>
                                    <?php } elseif ($enrollment->status == '2') { ?>
                                        <span class="badge bg-danger">Dropped</span>
                                    <?php } else { ?>
                                        <span class="badge bg-secondary">N/A</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <!-- View Button -->
                                    <a href="<?= $base_url ?>enrollments/view.php?id=<?= $enrollment->id ?>" class="btn btn-sm btn-info mb-2 mb-lg-0 me-0 me-lg-2">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <!-- Edit Button -->
                                    <a href="<?= $base_url ?>enrollments/edit.php?id=<?= $enrollment->id ?>" class="btn btn-sm btn-primary mb-2 mb-lg-0 me-0 me-lg-2">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <!-- Delete Button -->
                                    <a href="<?= $base_url ?>enrollments/delete.php?id=<?= $enrollment->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else { 
                            ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fa-regular fa-circle-xmark fa-2x mb-2 d-block"></i>
                                        No enrollments found
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
                        $total_conditions = [];
                        if(isset($_GET['status']) && $_GET['status'] !== '') {
                            $total_conditions['status'] = $_GET['status'];
                        }
                        $total_records = $crud->number_of_records("enrollment", $total_conditions);
                        $total_pages = ceil($total_records / $records_per_page);
                        ?>
                        <ul class="pagination">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $base_url ?>enrollments/list.php?page=<?= $page-1 ?><?= isset($_GET['status']) ? '&status='.$_GET['status'] : '' ?>" aria-label="Previous">
                                    <i class="fa-solid fa-chevron-left text-size-12"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $base_url ?>enrollments/list.php?page=<?= $i ?><?= isset($_GET['status']) ? '&status='.$_GET['status'] : '' ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $base_url ?>enrollments/list.php?page=<?= $page+1 ?><?= isset($_GET['status']) ? '&status='.$_GET['status'] : '' ?>" aria-label="Next">
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