<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->
<?php
$id = $_GET['id'];
$enrollment = $crud->common_select("enrollment", "*", ['id' => $id]);

if (!$enrollment['status'] || empty($enrollment['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Enrollment not found.');
    echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";
    exit;
}

$enrollment = $enrollment['data'][0];

// Get trainee details
$trainee = $crud->common_select("trainees", "*", ['id' => $enrollment->trainee_id]);
$trainee_data = ($trainee['status'] && !empty($trainee['data'])) ? $trainee['data'][0] : null;

// Get course details
$course = $crud->common_select("courses", "*", ['id' => $enrollment->course_id]);
$course_data = ($course['status'] && !empty($course['data'])) ? $course['data'][0] : null;

// Get trainer name (if course has trainer_id)
$trainer_name = 'N/A';
if ($course_data && !empty($course_data->trainer_id)) {
    $trainer = $crud->common_select("users", "full_name", ['id' => $course_data->trainer_id]);
    if ($trainer['status'] && !empty($trainer['data'])) {
        $trainer_name = $trainer['data'][0]->full_name;
    }
}
?>

<!-- Main Content -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Enrollment Details</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url ?>enrollments/list.php" class="cursor-pointer bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                        <i class="fa-solid fa-arrow-left me-3"></i>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <!-- Status Badge at Top -->
                <div class="row mb-4">
                    <div class="col-12">
                        <?php if ($enrollment->status == '0') { ?>
                            <span class="badge bg-primary fs-6 px-4 py-2">Enrolled</span>
                        <?php } elseif ($enrollment->status == '1') { ?>
                            <span class="badge bg-success fs-6 px-4 py-2">Completed</span>
                        <?php } elseif ($enrollment->status == '2') { ?>
                            <span class="badge bg-danger fs-6 px-4 py-2">Dropped</span>
                        <?php } else { ?>
                            <span class="badge bg-secondary fs-6 px-4 py-2">N/A</span>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <h5 class="mb-3 text-color-2">Trainee Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="35%">Trainee Name</th>
                                <td>
                                    <strong><?= $trainee_data ? htmlspecialchars($trainee_data->full_name) : 'N/A' ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $trainee_data ? $trainee_data->email : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?= $trainee_data ? $trainee_data->phone : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>Education</th>
                                <td><?= $trainee_data ? $trainee_data->education : 'N/A' ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <h5 class="mb-3 text-color-2">Course Information</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="35%">Course Name</th>
                                <td>
                                    <strong><?= $course_data ? htmlspecialchars($course_data->course_name) : 'N/A' ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td><?= $course_data ? $course_data->category : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>Duration</th>
                                <td><?= $course_data ? $course_data->duration : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>Fee</th>
                                <td>$<?= $course_data ? number_format($course_data->fee, 2) : '0.00' ?></td>
                            </tr>
                            <tr>
                                <th>Trainer</th>
                                <td><?= htmlspecialchars($trainer_name) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <!-- Enrollment Details -->
                    <div class="col-md-6">
                        <h5 class="mb-3 text-color-2">Enrollment Details</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="35%">Enrollment ID</th>
                                <td>#<?= $enrollment->id ?></td>
                            </tr>
                            <tr>
                                <th>Enrollment Date</th>
                                <td><?= date('d F Y', strtotime($enrollment->enrollment_date)) ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
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
                            </tr>
                        </table>
                    </div>
                    
                    <!-- Course Duration -->
                    <div class="col-md-6">
                        <h5 class="mb-3 text-color-2">Course Timeline</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="35%">Start Date</th>
                                <td><?= $course_data ? date('d F Y', strtotime($course_data->start_date)) : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td><?= $course_data ? date('d F Y', strtotime($course_data->end_date)) : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <?php if ($course_data) {
                                        if ($course_data->status == '0') { ?>
                                            <span class="badge bg-success">Running</span>
                                        <?php } elseif ($course_data->status == '1') { ?>
                                            <span class="badge bg-secondary">Completed</span>
                                        <?php } elseif ($course_data->status == '2') { ?>
                                            <span class="badge bg-warning">Upcoming</span>
                                        <?php } else { ?>
                                            <span class="badge bg-secondary">N/A</span>
                                        <?php }
                                    } else { ?>
                                        <span class="badge bg-secondary">N/A</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <hr>
                        <div class="d-flex gap-2">
                            <a href="<?= $base_url ?>enrollments/edit.php?id=<?= $enrollment->id ?>" class="btn btn-primary">
                                <i class="fa-regular fa-pen-to-square me-1"></i> Edit Enrollment
                            </a>
                            <a href="<?= $base_url ?>enrollments/delete.php?id=<?= $enrollment->id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                <i class="fa-solid fa-trash-can me-1"></i> Delete
                            </a>
                            <a href="<?= $base_url ?>enrollments/list.php" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>
