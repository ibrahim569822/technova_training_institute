<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT trainers.*, users.full_name, users.email, users.phone, users.status 
        FROM trainers
        JOIN users ON trainers.user_id = users.id 
        WHERE trainers.id = $id AND trainers.deleted_at IS NULL";

$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array('danger', 'Error', 'Teacher not found.');
    echo "<script>window.location.href = '" . $base_url . "teacher/list.php';</script>";
    exit;
}
$teacher = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Teacher Details</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url; ?>teacher/list.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Profile Image:</h5>
                        <p class="fw-bold">
                            <img src="<?= $base_url; ?>assets/uploads/trainers/images/<?= $teacher->image ?? 'default.jpg' ?>" alt="Profile" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Full Name:</h5>
                        <p class="fw-bold"><?= $teacher->full_name ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Email:</h5>
                        <p class="fw-bold"><?= $teacher->email ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Phone:</h5>
                        <p class="fw-bold"><?= $teacher->phone ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Gender:</h5>
                        <p class="fw-bold">
                            <?php 
                            if ($teacher->gender == 1) { echo 'Male'; }
                            elseif ($teacher->gender == 2) { echo 'Female'; }
                            else { echo 'Other'; }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Date of Birth:</h5>
                        <p class="fw-bold"><?= $teacher->dob ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Joining Date:</h5>
                        <p class="fw-bold"><?= $teacher->joining_date ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Qualification:</h5>
                        <p class="fw-bold"><?= $teacher->qualification ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Specialization:</h5>
                        <p class="fw-bold"><?= $teacher->specialization ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Experience:</h5>
                        <p class="fw-bold"><?= $teacher->experience ?> Years</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Salary:</h5>
                        <p class="fw-bold"><?= number_format($teacher->salary, 2) ?> BDT</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5 class="text-success">Address:</h5>
                        <p class="fw-bold"><?= $teacher->address ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-success">Status:</h5>
                        <p class="fw-bold">
                            <?php 
                            if ($teacher->status == 1) { echo '<span class="badge bg-success">Active</span>'; }
                            else { echo '<span class="badge bg-danger">Inactive</span>'; }
                            ?>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>