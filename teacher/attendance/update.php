<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'] ?? 0;

// 🔥 ডাটাবেস থেকে রেকর্ড বের করা
$sql = "SELECT * FROM trainer_attendance WHERE id = $id";
$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Record not found.');
    echo "<script>window.location.href = '" . $base_url . "teacher/attendance/list.php';</script>";
    exit;
}

$att = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Update Attendance</h3>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="update_process.php" method="POST" class="p-4">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="attendance_date" value="<?= $att->attendance_date ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Attendance Date</label>
                            <input type="date" class="form-control" value="<?= $att->attendance_date ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="0" <?= $att->status == 0 ? 'selected' : '' ?>>Present</option>
                                <option value="1" <?= $att->status == 1 ? 'selected' : '' ?>>Absent</option>
                                <option value="2" <?= $att->status == 2 ? 'selected' : '' ?>>Leave</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-success">Update Status</button>
                            <a href="view.php?attendance_date=<?= $att->attendance_date ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once "../../component/footer.php" ?>