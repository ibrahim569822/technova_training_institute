<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM batches WHERE id = $id AND deleted_at IS NULL";
$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Batch not found.');
    echo "<script>window.location.href = '" . $base_url . "batches/list.php';</script>";
    exit;
}
$batch = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Edit Batch</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>batches/update.php" method="POST" class="p-4">
                    <input type="hidden" name="id" value="<?= $batch->id ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="batch_name" class="form-label">Batch Name</label>
                            <input type="text" class="form-control" id="batch_name" name="batch_name" value="<?= $batch->batch_name ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label">Course</label>
                            <select class="form-select" id="course_id" name="course_id" required>
                                <?php
                                
                                $courses = $crud->common_query("SELECT id, course_name FROM courses WHERE deleted_at IS NULL");
                                if ($courses['status']) {
                                    foreach ($courses['data'] as $course) {
                                        $selected = ($course->id == $batch->course_id) ? 'selected' : '';
                                        echo "<option value='{$course->id}' {$selected}>{$course->course_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trainer_id" class="form-label">Trainer</label>
                            <select class="form-select" id="trainer_id" name="trainer_id" required>
                                <?php
                               
                                $trainers = $crud->common_query("SELECT trainers.id, users.full_name FROM trainers JOIN users ON trainers.user_id = users.id WHERE trainers.deleted_at IS NULL");
                                if ($trainers['status']) {
                                    foreach ($trainers['data'] as $trainer) {
                                        $selected = ($trainer->id == $batch->trainer_id) ? 'selected' : '';
                                        echo "<option value='{$trainer->id}' {$selected}>{$trainer->full_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                       
                        <div class="col-md-6 mb-3">
                            <label for="total_seats" class="form-label">Total Seats</label>
                            <input type="number" class="form-control" id="total_seats" name="total_seats" value="<?= $batch->total_seats ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="Start_date" name="Start_date" value="<?= $batch->Start_date ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="End_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="End_date" name="End_date" value="<?= $batch->End_date ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="Price" name="Price" value="<?= $batch->Price ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Discount" class="form-label">Discount</label>
                            <input type="number" step="0.01" class="form-control" id="Discount" name="Discount" value="<?= $batch->Discount ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Discount_type" class="form-label">Discount Type</label>
                            <select class="form-select" id="Discount_type" name="Discount_type" required>
                                <option value="1" <?= $batch->Discount_type == '1' ? 'selected' : '' ?>>Fixed (BDT)</option>
                                <option value="2" <?= $batch->Discount_type == '2' ? 'selected' : '' ?>>Percentage (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="0" <?= $batch->status == '0' ? 'selected' : '' ?>>Upcoming</option>
                                <option value="1" <?= $batch->status == '1' ? 'selected' : '' ?>>Running</option>
                                <option value="2" <?= $batch->status == '2' ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="start_time" class="form-label">Class Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="<?= $batch->start_time ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="end_time" class="form-label">Class End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="<?= $batch->end_time ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="room" class="form-label">Room</label>
                            <input type="text" class="form-control" id="room" name="room" value="<?= $batch->room ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Update Batch</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>