<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT trainees.*, users.full_name, users.email, users.phone, users.status 
        FROM trainees
        JOIN users ON trainees.user_id = users.id 
        WHERE trainees.id = $id AND trainees.deleted_at IS NULL";

$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Trainee not found.');
    echo "<script>window.location.href = '" . $base_url . "trainees/list.php';</script>";
    exit;
}
$trainee = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Trainee Details</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url; ?>trainees/list.php" class="btn btn-secondary">Back to List</a>
                    <a href="<?= $base_url; ?>trainees/edit.php?id=<?= $trainee->id ?>" class="btn btn-primary ms-2">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row">
                    <!-- Profile Image -->
                    <div class="col-md-3 text-center mb-4 mb-md-0">
                        <img src="<?= $base_url; ?>assets/uploads/trainees/images/<?= $trainee->image ?? 'default.jpg' ?>" alt="Profile" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #f0f0f0;">
                        <h5 class="mt-3 text-color-2"><?= $trainee->full_name ?></h5>
                        <span class="badge <?= ($trainee->status == 1) ? 'bg-success' : 'bg-danger' ?>">
                            <?= ($trainee->status == 1) ? 'Active' : 'Inactive' ?>
                        </span>
                    </div>
                    
                    <!-- Personal Information -->
                    <div class="col-md-9">
                        <h5 class="text-primary mb-3"><i class="fa-solid fa-user me-2"></i>Personal Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Full Name</label>
                                <p class="fw-bold text-color-2"><?= $trainee->full_name ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Email</label>
                                <p class="fw-bold text-color-2"><?= $trainee->email ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Phone</label>
                                <p class="fw-bold text-color-2"><?= $trainee->phone ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Gender</label>
                                <p class="fw-bold text-color-2">
                                    <?php 
                                    if ($trainee->gender == 1) { echo '<i class="fa-solid fa-mars me-1"></i> Male'; }
                                    elseif ($trainee->gender == 2) { echo '<i class="fa-solid fa-venus me-1"></i> Female'; }
                                    else { echo '<i class="fa-solid fa-genderless me-1"></i> Other'; }
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Date of Birth</label>
                                <p class="fw-bold text-color-2"><?= date('d M, Y', strtotime($trainee->dob)) ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted mb-1">Enrollment Date</label>
                                <p class="fw-bold text-color-2"><?= date('d M, Y', strtotime($trainee->enrollment_date)) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Academic & Course Information -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary mb-3"><i class="fa-solid fa-graduation-cap me-2"></i>Academic & Course Information</h5>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Education</label>
                        <p class="fw-bold text-color-2"><?= $trainee->education ?? 'N/A' ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Course Enrolled</label>
                        <p class="fw-bold text-color-2"><?= $trainee->course_enrolled ?? 'N/A' ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Batch</label>
                        <p class="fw-bold text-color-2"><?= $trainee->batch ?? 'N/A' ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Duration</label>
                        <p class="fw-bold text-color-2"><?= $trainee->duration ?? 'N/A' ?> Months</p>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Financial Information -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary mb-3"><i class="fa-solid fa-money-bill-wave me-2"></i>Financial Information</h5>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Course Fee</label>
                        <p class="fw-bold text-color-2"><?= isset($trainee->fee) ? '৳ ' . number_format($trainee->fee, 2) : 'N/A' ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Payment Status</label>
                        <p class="fw-bold">
                            <?php 
                            if (isset($trainee->payment_status)) {
                                if ($trainee->payment_status == 1) { 
                                    echo '<span class="badge bg-success">Paid</span>'; 
                                } elseif ($trainee->payment_status == 2) {
                                    echo '<span class="badge bg-warning">Partial</span>';
                                } else { 
                                    echo '<span class="badge bg-danger">Unpaid</span>'; 
                                }
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </p>
                    </div>
                    <?php if (isset($trainee->paid_amount) && $trainee->paid_amount > 0): ?>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Paid Amount</label>
                        <p class="fw-bold text-color-2">৳ <?= number_format($trainee->paid_amount, 2) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1">Due Amount</label>
                        <p class="fw-bold text-danger">৳ <?= number_format(($trainee->fee - $trainee->paid_amount), 2) ?></p>
                    </div>
                    <?php endif; ?>
                </div>

                <hr class="my-4">

                <!-- Address -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary mb-3"><i class="fa-solid fa-location-dot me-2"></i>Address</h5>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="fw-bold text-color-2"><?= $trainee->address ?? 'N/A' ?></p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <a href="<?= $base_url; ?>trainees/edit.php?id=<?= $trainee->id ?>" class="btn btn-primary">
                                <i class="fa-regular fa-pen-to-square me-1"></i> Edit
                            </a>
                            <a href="<?= $base_url; ?>trainees/delete.php?id=<?= $trainee->id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this trainee?')">
                                <i class="fa-solid fa-trash-can me-1"></i> Delete
                            </a>
                            <a href="<?= $base_url; ?>trainees/list.php" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php" ?>