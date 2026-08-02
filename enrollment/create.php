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
                    <h3 class="mb-2 text-size-26 text-color-2">Add New Enrollment</h3>
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
                <form action="<?= $base_url ?>enrollments/store.php" method="POST" class="p-4">
                    <div class="row">
                        <!-- Trainee Selection -->
                        <div class="col-md-6 mb-3">
                            <label for="trainee_id" class="form-label">Trainee *</label>
                            <select class="form-select" id="trainee_id" name="trainee_id" required>
                                <option value="">Select Trainee</option>
                                <?php
                                $trainees = $crud->common_select("trainees", "*", ['status' => 1]);
                                if($trainees['status'] && !empty($trainees['data'])) {
                                    foreach($trainees['data'] as $trainee) { ?>
                                        <option value="<?= $trainee->id ?>"><?= $trainee->full_name ?> (<?= $trainee->email ?>)</option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                        
                        <!-- Course Selection -->
                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label">Course *</label>
                            <select class="form-select" id="course_id" name="course_id" required>
                                <option value="">Select Course</option>
                                <?php
                                $courses = $crud->common_select("courses", "*", ['status' => 0]); // 0 = Running
                                if($courses['status'] && !empty($courses['data'])) {
                                    foreach($courses['data'] as $course) { ?>
                                        <option value="<?= $course->id ?>"><?= $course->course_name ?> ($<?= number_format($course->fee, 2) ?>)</option>
                                    <?php }
                                } else {
                                    // If no running courses, show all
                                    $courses = $crud->common_select("courses", "*");
                                    if($courses['status'] && !empty($courses['data'])) {
                                        foreach($courses['data'] as $course) { ?>
                                            <option value="<?= $course->id ?>"><?= $course->course_name ?> ($<?= number_format($course->fee, 2) ?>)</option>
                                        <?php }
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Enrollment Date -->
                        <div class="col-md-6 mb-3">
                            <label for="enrollment_date" class="form-label">Enrollment Date *</label>
                            <input type="date" class="form-control" id="enrollment_date" name="enrollment_date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        
                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="0">Enrolled</option>
                                <option value="1">Completed</option>
                                <option value="2">Dropped</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Add Enrollment</button>
                            <a href="<?= $base_url ?>enrollments/list.php" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>