<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT enrollments.*, trainees.full_name as trainee_name, batches.batch_name, courses.course_name 
        FROM enrollments 
        JOIN trainees ON enrollments.trainee_id = trainees.id 
        JOIN batches ON enrollments.batch_id = batches.id 
        LEFT JOIN courses ON enrollments.course_id = courses.id 
        WHERE enrollments.id = $id AND enrollments.deleted_at IS NULL";

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
                    <h3 class="mb-2 text-size-26 text-color-2">Enrollment Details</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url; ?>enrollments/list.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-primary">Trainee Name</h5>
                        <p class="fw-bold"><?= $enroll->trainee_name ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-primary">Batch</h5>
                        <p class="fw-bold"><?= $enroll->batch_name ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-primary">Course</h5>
                        <p class="fw-bold"><?= $enroll->course_name ?? 'N/A' ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-primary">Enrollment Date</h5>
                        <p class="fw-bold"><?= $enroll->enrollment_date ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5 class="text-primary">Status</h5>
                        <p class="fw-bold">
                            <?php 
                            if ($enroll->status == 0) { echo '<span class="badge bg-warning text-dark">Enrolled</span>'; }
                            elseif ($enroll->status == 1) { echo '<span class="badge bg-success">Completed</span>'; }
                            elseif ($enroll->status == 2) { echo '<span class="badge bg-danger">Dropped</span>'; }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>