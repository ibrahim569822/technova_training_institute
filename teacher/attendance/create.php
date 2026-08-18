<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Add Attendance</h3>
        </div>
    </div>
    <form action="store.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label>Teacher</label>
                <select name="teacher_id" class="form-select" required>
                    <option value="">Select Teacher</option>
                    <?php
                    $teachers = $crud->common_query("SELECT trainers.id, users.full_name FROM trainers JOIN users ON trainers.user_id = users.id WHERE trainers.deleted_at IS NULL");
                    foreach ($teachers['data'] as $t) {
                        echo "<option value='{$t->id}'>{$t->full_name}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>Date</label>
                
                <input type="date" name="attendance_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
        
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option value="0">Present</option>
                    <option value="1">Absent</option>
                    <option value="2">Leave</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
<?php require_once "../../component/footer.php"; ?>