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

<!-- Main Content -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Edit Enrollment</h3>
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
            <div class="card-body p-0">
                <form action="<?= $base_url ?>enrollments/update.php?id=<?= $enrollment->id ?>" method="POST" class="p-4">
                    <div class="row">
                        <!-- Trainee Info (Read-only) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trainee</label>
                            <div class="form-control bg-light" style="height: auto; padding: 10px 12px;">
                                <?= htmlspecialchars($trainee_name) ?>
                            </div>
                            <input type="hidden" name="trainee_id" value="<?= $enrollment->trainee_id ?>">
                        </div>
                        
                        <!-- Course Info (Read-only) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course</label>
                            <div class="form-control bg-light" style="height: auto; padding: 10px 12px;">
                                <?= htmlspecialchars($course_name) ?>
                            </div>
                            <input type="hidden" name="course_id" value="<?= $enrollment->course_id ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Enrollment Date -->
                        <div class="col-md-6 mb-3">
                            <label for="enrollment_date" class="form-label">Enrollment Date *</label>
                            <input type="date" class="form-control" id="enrollment_date" name="enrollment_date" value="<?= $enrollment->enrollment_date ?>" required>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="0" <?= $enrollment->status == '0' ? 'selected' : '' ?>>Enrolled</option>
                                <option value="1" <?= $enrollment->status == '1' ? 'selected' : '' ?>>Completed</option>
                                <option value="2" <?= $enrollment->status == '2' ? 'selected' : '' ?>>Dropped</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Update Enrollment</button>
                            <a href="<?= $base_url ?>enrollments/list.php" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>