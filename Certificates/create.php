<?php require_once "../component/header.php"; ?>
<?php require_once "../component/sidebar.php"; ?>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
        <h3>Add New Certificate</h3>
        <a href="index.php" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="store.php" method="POST">
                <div class="row">
                    <!-- Trainee -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Trainee <span class="text-danger">*</span>
                        </label>
                        <select name="trainee_id" class="form-control" required>
                            <option value="">Select Trainee</option>
                            <?php
                            $trainee_query = "
                                SELECT id, full_name
                                FROM trainees
                                ORDER BY full_name ASC
                            ";
                            $trainees = $crud->common_query($trainee_query);
                            if ($trainees['status'] && !empty($trainees['data'])) {
                                foreach ($trainees['data'] as $trainee) {
                                    ?>
                                    <option value="<?= $trainee->id; ?>">
                                        <?= htmlspecialchars($trainee->full_name); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <!-- Course -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Course <span class="text-danger">*</span>
                        </label>
                        <select name="course_id" class="form-control" required>
                            <option value="">Select Course</option>
                            <?php
                            $course_query = "
                                SELECT id, course_name
                                FROM courses
                                ORDER BY course_name ASC
                            ";
                            $courses = $crud->common_query($course_query);
                            if ($courses['status'] && !empty($courses['data'])) {
                                foreach ($courses['data'] as $course) {
                                    ?>
                                    <option value="<?= $course->id; ?>">
                                        <?= htmlspecialchars($course->course_name); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Batch -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Batch <span class="text-danger">*</span>
                        </label>
                        <select name="batch_id" class="form-control" required>
                            <option value="">Select Batch</option>
                            <?php
                            $batch_query = "
                                SELECT id, batch_name
                                FROM batches
                                ORDER BY batch_name ASC
                            ";
                            $batches = $crud->common_query($batch_query);
                            if ($batches['status'] && !empty($batches['data'])) {
                                foreach ($batches['data'] as $batch) {
                                    ?>
                                    <option value="<?= $batch->id; ?>">
                                        <?= htmlspecialchars($batch->batch_name); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Certificate Number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Certificate No <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="certificate_no" class="form-control"
                            placeholder="Enter Certificate Number" required>
                    </div>
                    <!-- Issue Date -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Issue Date <span class="text-danger">*</span>
                        </label>
                        <input type="date" name="issue_date" class="form-control" value="<?= date('Y-m-d'); ?>"
                            required>
                    </div>
                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Status
                        </label>
                        <select name="status" class="form-control">
                            <option value="1">
                                Active
                            </option>
                            <option value="0">
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Save Certificate
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>