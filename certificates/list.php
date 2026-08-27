<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->
<!-- Main Content -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Certificate</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <div class="d-flex align-items-center">
                        <a href="create.php"
                            class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                            <i class="fa-solid fa-plus me-3"></i> Add Certificate
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive table-rounded-top">

                    <table class="table align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Certificate No</th>
                                <th>Trainee Name</th>
                                <th>Course Name</th>
                                <th>Batch Name</th>
                                <th>Issue Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <?php
                        $sql = "SELECT certificates.*, trainees.full_name,trainees.phone, courses.course_name, batches.batch_name FROM `certificates` join trainees on trainees.id=certificates.trainee_id JOIN courses on courses.id=certificates.course_id JOIN batches on batches.id=certificates.batch_id WHERE certificates.deleted_at is null";

                        $result = $crud->common_query($sql);
                        if ($result['status']) {
                            foreach ($result['data'] as $Certificate) {
                                ?>
                                <tr>
                                    <td><?= $Certificate->certificate_no ?></td>
                                    <td><?= $Certificate->full_name ?> - <?= $Certificate->phone ?></td>
                                    <td><?= $Certificate->course_name ?></td>
                                    <td><?= $Certificate->batch_name ?></td>
                                    <td><?= $Certificate->issue_date ?></td>
                                    <td><?= $Certificate->status ?></td>
                                    <td class="text-center">
                                        <a href="<?= $base_url; ?>certificates/certificate.php?id=<?= $Certificate->certificate_id ?>"
                                            class="btn btn-sm btn-primary mb-2"><i class="fa-solid fa-eye"></i></a>
                                        <a href="<?= $base_url; ?>certificates/certificate.php?id=<?= $Certificate->certificate_id ?>"
                                            class="btn btn-sm btn-primary mb-2"><i class="fa-solid fa-print"></i></a>
                                        <a href="<?= $base_url; ?>certificates/edit.php?id=<?= $Certificate->certificate_id ?>"
                                            class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="<?= $base_url; ?>certificates/delete.php?id=<?= $Certificate->certificate_id ?>"
                                            class="btn btn-sm btn-danger mb-2"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='10'>No records found</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>