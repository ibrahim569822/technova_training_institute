<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$row = $crud->common_query("SELECT * FROM trainer_attendance WHERE id = $id")['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Edit Attendance</h3>
        </div>
    </div>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="row">
            <div class="col-md-6">
                <label>Date</label>
                <input type="date" name="attendance_date" class="form-control" value="<?= $row->attendance_date ?>" required>
            </div>
            <div class="col-md-6">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option value="0" <?= $row->status == 0 ? 'selected' : '' ?>>Present</option>
                    <option value="1" <?= $row->status == 1 ? 'selected' : '' ?>>Absent</option>
                    <option value="2" <?= $row->status == 2 ? 'selected' : '' ?>>Leave</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
<?php require_once "../../component/footer.php"; ?>