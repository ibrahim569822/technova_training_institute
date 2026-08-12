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
                    <a href="<?= $base_url; ?>enrollments/create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                        <i class="fa-solid fa-plus me-3"></i> Add Enrollment
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
                            // SQL Query to fetch enrollments with trainee and batch names
                            $sql = "SELECT enrollments.*, trainees.full_name as trainee_name, batches.batch_name 
                                    FROM enrollments 
                                    JOIN trainees ON enrollments.trainee_id = trainees.id 
                                    JOIN batches ON enrollments.batch_id = batches.id 
                                    WHERE enrollments.deleted_at IS NULL 
                                    ORDER BY enrollments.id DESC";

                            $result = $crud->common_query($sql);
                            if ($result['status'] && !empty($result['data'])) {
                                $i = 1;
                                foreach ($result['data'] as $enroll) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= htmlspecialchars($enroll->trainee_name) ?></td>
                                <td>
                                    <!--  Hover Popup Logic -->
                                    <span class="batch-hover" onmouseenter="loadCourseDetails(<?= $enroll->batch_id ?>, this)">
                                        <?= htmlspecialchars($enroll->batch_name) ?>
                                        <div class="course-popup"></div>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($enroll->enrollment_date) ?></td>
                                <td>
                                    <?php 
                                    if ($enroll->status == 0) { echo '<span class="badge bg-warning text-dark">Enrolled</span>'; }
                                    elseif ($enroll->status == 1) { echo '<span class="badge bg-success">Completed</span>'; }
                                    elseif ($enroll->status == 2) { echo '<span class="badge bg-danger">Dropped</span>'; }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $base_url; ?>invoices/create.php?trainee_id=<?= $enroll->trainee_id ?>" class="btn btn-sm btn-info mb-2" title="Create Invoice">
                                        <i class="fa-solid fa-file-invoice"></i>
                                    </a>
                                    <a href="<?= $base_url; ?>enrollments/edit.php?id=<?= $enroll->id ?>" class="btn btn-sm btn-primary mb-2">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?= $base_url; ?>enrollments/delete.php?id=<?= $enroll->id ?>" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center py-4'>No enrollments found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

             <div class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
                        <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
                            <?php
                  
                                $total_records = $crud->number_of_records("enrollments");
                                $records_per_page = 10;
                                $total_pages = ceil($total_records / $records_per_page);
                                
                               
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                if ($page < 1) $page = 1;
                                if ($page > $total_pages) $page = $total_pages;
                            ?>
                            <ul class="pagination">
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= ($page > 1) ? $base_url . 'enrollments/list.php?page=' . ($page - 1) : '#' ?>" aria-label="Previous">
                                        <i class="fa-solid fa-chevron-left text-size-12"></i>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= $base_url ?>enrollments/list.php?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php } ?>
                                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= ($page < $total_pages) ? $base_url . 'enrollments/list.php?page=' . ($page + 1) : '#' ?>" aria-label="Next">
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


<!--  CSS for Popup -->
<style>
    .table-responsive {
    overflow: visible !important;
    }

    .batch-hover {
        position: relative;
        cursor: pointer;
        color: #123f81;
        font-weight: 500;
        display: inline-block;
    }

    .course-popup {
        display: none;
        position: absolute;
        background: #b48b8b;
        border: 1px solid #942727;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 4px 15px rgba(59, 48, 48, 0.2);
        z-index: 9999;
        min-width: 220px;
        max-width: 300px;
        font-size: 14px;
        line-height: 1.6;

        /* Popup comes straight below batch */
        top: calc(100% + 5px);
        left: 0;

        /* Prevent popup from creating unwanted scroll */
        white-space: normal;
    }

    .batch-hover:hover .course-popup {
        display: block;
    }
</style>

<!--  JavaScript for Popup (AJAX) -->
<script>
function loadCourseDetails(batchId, element) {

    if (element.querySelector('.course-popup').innerHTML.trim() !== '') {
        return;
    }

    
    fetch(`<?= $base_url; ?>enrollments/get_course_details.php?batch_id=${batchId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const course = data.data;
                const popup = element.querySelector('.course-popup');
                popup.innerHTML = `
                    <h6>${course.course_name}</h6>
                    <p><span class="label">Duration:</span> ${course.duration} months</p>
                    <p><span class="label">Fee:</span> ${parseFloat(course.fee).toFixed(2)} BDT</p>
                   <p><span class="label">Status:</span> 
                        <span class="badge ${course.status_class}">
                            ${course.status}
                        </span>
                   </p>
                `;
            } else {
                element.querySelector('.course-popup').innerHTML = '<p class="text-danger">No course details found.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            element.querySelector('.course-popup').innerHTML = '<p class="text-danger">Error loading details.</p>';
        });
}
</script>

<?php require_once "../component/footer.php"; ?>