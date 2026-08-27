<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT batches.*, courses.course_name, users.full_name as trainer_name 
        FROM batches
        JOIN courses ON batches.course_id = courses.id 
        JOIN trainers ON batches.trainer_id = trainers.id 
        JOIN users ON trainers.user_id = users.id 
        WHERE batches.id = $id AND batches.deleted_at IS NULL";

$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Batch not found.');
   exit;
}
print_r($_SESSION['message']);
$batch = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Batch Details</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url; ?>batches/list.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Batch Name</h5>
                        <p class="fw-bold"><?= $batch->batch_name ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Course</h5>
                        <p class="fw-bold"><?= $batch->course_name ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Trainer</h5>
                        <p class="fw-bold"><?= $batch->trainer_name ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Total Seats</h5>
                        <p class="fw-bold"><?= $batch->total_seats ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Duration</h5>
                        <p class="fw-bold"><?= $batch->Start_date ?> to <?= $batch->End_date ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Class Time</h5>
                        <p class="fw-bold"><?= $batch->start_time ?> - <?= $batch->end_time ?> (Room: <?= $batch->room ?>)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Price & Discount</h5>
                        <p class="fw-bold">Price: <?= number_format($batch->Price, 2) ?> | Discount: <?= $batch->Discount ?> (<?= $batch->Discount_type == 1 ? 'Fixed' : '%' ?>)</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-muted">Status</h5>
                        <p class="fw-bold">
                            <?php 
                            if ($batch->status == 1) { echo '<span class="badge bg-success">Running</span>'; }
                            elseif ($batch->status == 2) { echo '<span class="badge bg-secondary">Completed</span>'; }
                            else { echo '<span class="badge bg-warning text-dark">Upcoming</span>'; }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>