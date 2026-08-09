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
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>enrollments/store.php" method="POST" class="p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trainee_id" class="form-label">Select Trainee</label>
                            <select class="form-select" id="trainee_id" name="trainee_id" required>
                                <option value="">Select Trainee</option>
                                <?php
                                $trainees = $crud->common_query("SELECT id, full_name FROM trainees WHERE deleted_at IS NULL");
                                if ($trainees['status']) {
                                    foreach ($trainees['data'] as $trainee) {
                                        echo "<option value='{$trainee->id}'>{$trainee->full_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="batch_id" class="form-label">Select Batch</label>
                            <select class="form-select" id="batch_id" name="batch_id" required>
                                <option value="">Select Batch</option>
                                <?php
                                $batches = $crud->common_query("SELECT id, batch_name FROM batches WHERE deleted_at IS NULL AND status != 2"); // শুধু Upcoming/Running ব্যাচ দেখাবে
                                if ($batches['status']) {
                                    foreach ($batches['data'] as $batch) {
                                        echo "<option value='{$batch->id}'>{$batch->batch_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label">Course (Optional)</label>
                            <select class="form-select" id="course_id" name="course_id">
                                <option value="">Select Course</option>
                                <?php
                                $courses = $crud->common_query("SELECT id, course_name FROM courses WHERE deleted_at IS NULL");
                                if ($courses['status']) {
                                    foreach ($courses['data'] as $course) {
                                        echo "<option value='{$course->id}'>{$course->course_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="0">Enrolled</option>
                                <option value="1">Completed</option>
                                <option value="2">Dropped</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Save Enrollment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>