<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Apply for Leave</h3>
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
                <label>Leave Type</label>
                <select name="leave_type" class="form-select" required>
                    <option value="0">Casual</option>
                    <option value="1">Sick</option>
                    <option value="2">Annual</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>Reason</label>
                <textarea name="reason" class="form-control" rows="3" required></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
<?php require_once "../../component/footer.php"; ?>