<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->
<?php

$certificate_id = $_GET['id'] ?? 0;
$sql = "SELECT 
            certificates.certificate_no,
            trainees.full_name,
            courses.course_name,
            batches.batch_name,
            certificates.issue_date,
            certificates.status
        FROM certificates
        JOIN trainees 
            ON certificates.trainee_id = trainees.id
        JOIN courses 
            ON certificates.course_id = courses.id
        JOIN batches 
            ON certificates.batch_id = batches.id
        WHERE certificates.id = '$certificate_id'
        AND certificates.deleted_at IS NULL";

$data = $crud->common_query($sql);
if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = array(
        'danger',
        'Error',
        'Certificate not found.'
    );
    header("Location: " . $base_url . "Certificates/index.php");
    exit;
}
?>
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">
                        Certificate Details
                    </h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="<?= $base_url; ?>Certificates/index.php" class="btn btn-secondary">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Certificate No</th>
                            <th>Trainee Name</th>
                            <th>Course Name</th>
                            <th>Batch Name</th>
                            <th>Issue Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['data'] as $certificate): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($certificate->certificate_no); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($certificate->full_name); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($certificate->course_name); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($certificate->batch_name); ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($certificate->issue_date); ?>
                                </td>
                                <td>
                                    <?php if ($certificate->status == 1): ?>
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>