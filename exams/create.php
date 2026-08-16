<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Add New Exam</h3>
        </div>
    </div>
    <form action="<?= $base_url; ?>exams/store.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label>Exam Name</label>
                <input type="text" name="exam_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Exam Date</label>
                <input type="date" name="exam_date" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Total Marks</label>
                <input type="number" name="total_marks" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Pass Marks</label>
                <input type="number" name="pass_marks" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Batch (Required)</label>
                <select name="batch_id" class="form-select" required>
                    <option value="">Select Batch</option>
                    <?php
                    $batches = $crud->common_query("SELECT id, batch_name FROM batches WHERE deleted_at IS NULL");
                    foreach ($batches['data'] as $batch) {
                        echo "<option value='{$batch->id}'>{$batch->batch_name}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>Course (Optional)</label>
                <select name="course_id" class="form-select">
                    <option value="">Select Course</option>
                    <?php
                    $courses = $crud->common_query("SELECT id, course_name FROM courses WHERE deleted_at IS NULL");
                    foreach ($courses['data'] as $course) {
                        echo "<option value='{$course->id}'>{$course->course_name}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save Exam</button>
    </form>
</div>
<?php require_once "../component/footer.php"; ?>