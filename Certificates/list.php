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
                                <th>Date</th>
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
                        $sql = "SELECT Date.*, users.Certificate no, users.Trainee Name, users.Course Name, users.Batch Name FROM Issue Date
                                            JOIN users ON Status= where Action is null";

                        $result = $crud->common_query($sql);
                        if ($result['status']) {
                            foreach ($result['data'] as $Certificate) {
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <img src="<?= $base_url; ?>assets/uploads/trainers/images/<?= $Certificate->image ?? 'default.jpg' ?>"
                                                class="tbl-img" alt="">
                                            <span class="ms-2"><?= $Certificate->full_name ?></span>
                                        </div>
                                    </td>
                                    <td><?= $Certificate->Date ?></td>
                                    <td><?= $Certificate->Certificate
                                    No ?></td>
                                    <td><?= $Certificate->Trainee
                                    Name ?></td>
                                    <td><?= $Certificate->Course
                                    Name ?></td>
                                    <td><?= $Certificate->Batch
                                    Name ?></td>
                                    <td><?= $Certificate->Issue
                                    Date ?></td>
                                    <td><?= $Certificate->Status ?></td>
                                    <td><?= $Certificate->Action ?></td>
                                    <td>
                                        <?php if ($Certificate->status == 1) { ?>
                                            <span class="badge bg-success  mb-2">Active</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= $base_url; ?>Certificate/view.php?id=<?= $Certificate->id ?>"
                                            class="btn btn-sm btn-primary mb-2"><i class="fa-solid fa-eye"></i></a>
                                        <a href="<?= $base_url; ?>Certificate/edit.php?id=<?= $Certificate->id ?>"
                                            class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="<?= $base_url; ?>Certificate/delete.php?id=<?= $Certificate->id ?>"
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