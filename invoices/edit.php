<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM enrollments WHERE id = $id AND deleted_at IS NULL";
$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Enrollment not found.');
    echo "<script>window.location.href = '" . $base_url . "enrollments/list.php';</script>";
    exit;
}
$enroll = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Edit Enrollment</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>enrollments/update.php" method="POST" class="p-4">
                    <input type="hidden" name="id" value="<?= $enroll->id ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trainee_id" class="form-label">Select Trainee</label>
                            <select class="form-select" id="trainee_id" name="trainee_id" required>
                                <option value="">Select Trainee</option>
                                <?php
                                $trainees = $crud->common_query("SELECT id, full_name FROM trainees WHERE deleted_at IS NULL");
                                if ($trainees['status']) {
                                    foreach ($trainees['data'] as $trainee) {
                                        $selected = ($trainee->id == $enroll->trainee_id) ? 'selected' : '';
                                        echo "<option value='{$trainee->id}' {$selected}>{$trainee->full_name}</option>";
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
                                $batches = $crud->common_query("SELECT id, batch_name FROM batches WHERE deleted_at IS NULL AND status != 2");
                                if ($batches['status']) {
                                    foreach ($batches['data'] as $batch) {
                                        $selected = ($batch->id == $enroll->batch_id) ? 'selected' : '';
                                        echo "<option value='{$batch->id}' {$selected}>{$batch->batch_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label">Course</label>
                            <select class="form-select" id="course_id" name="course_id">
                                <option value="">Select Course</option>
                                <?php
                                $courses = $crud->common_query("SELECT id, course_name FROM courses WHERE deleted_at IS NULL");
                                if ($courses['status']) {
                                    foreach ($courses['data'] as $course) {
                                        $selected = ($course->id == $enroll->course_id) ? 'selected' : '';
                                        echo "<option value='{$course->id}' {$selected}>{$course->course_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="0" <?= $enroll->status == '0' ? 'selected' : '' ?>>Enrolled</option>
                                <option value="1" <?= $enroll->status == '1' ? 'selected' : '' ?>>Completed</option>
                                <option value="2" <?= $enroll->status == '2' ? 'selected' : '' ?>>Dropped</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Update Enrollment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>