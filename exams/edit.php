<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM exams WHERE id = $id AND deleted_at IS NULL";
$data = $crud->common_query($sql);
$exam = $data['data'][0];
?>

<div class="main-content">
    <h3>Edit Exam</h3>
    <form action="<?= $base_url; ?>exams/update.php" method="POST">
        <input type="hidden" name="id" value="<?= $exam->id ?>">
        <div class="row">
            <div class="col-md-6">
                <label>Exam Name</label>
                <input type="text" name="exam_name" value="<?= $exam->exam_name ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Exam Date</label>
                <input type="date" name="exam_date" value="<?= $exam->exam_date ?>" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Total Marks</label>
                <input type="number" name="total_marks" value="<?= $exam->total_marks ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Pass Marks</label>
                <input type="number" name="pass_marks" value="<?= $exam->pass_marks ?>" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Batch</label>
                <select name="batch_id" class="form-select" required>
                    <?php
                    $batches = $crud->common_query("SELECT id, batch_name FROM batches WHERE deleted_at IS NULL");
                    foreach ($batches['data'] as $batch) {
                        $selected = ($batch->id == $exam->batch_id) ? 'selected' : '';
                        echo "<option value='{$batch->id}' {$selected}>{$batch->batch_name}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>Course</label>
                <select name="course_id" class="form-select">
                    <?php
                    $courses = $crud->common_query("SELECT id, course_name FROM courses WHERE deleted_at IS NULL");
                    foreach ($courses['data'] as $course) {
                        $selected = ($course->id == $exam->course_id) ? 'selected' : '';
                        echo "<option value='{$course->id}' {$selected}>{$course->course_name}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Exam</button>
    </form>
</div>
<?php require_once "../component/footer.php"; ?>