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
                    <h3 class="mb-2 text-size-26 text-color-2">Attendance</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <div class="d-flex align-items-center">
                        <a href="create.php"
                            class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                            <i class="fa-solid fa-plus me-3"></i> Add Batch
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
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Trainee</th>
                                <th>Batch</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT batches.*, courses.course_name, users.full_name as trainer_name 
                                    FROM batches 
                                    JOIN courses ON batches.course_id = courses.id 
                                    JOIN trainers ON batches.trainer_id = trainers.id 
                                    JOIN users ON trainers.user_id = users.id 
                                    WHERE batches.deleted_at IS NULL";

                            $result = $crud->common_query($sql);
                            if ($result['status']) {
                                foreach ($result['data'] as $batch) {
                                    ?>
                                    <tr>
                                        <td><?= $Attendane->sl_name ?></td>
                                        <td><?= $Attendane->Trainee_name ?></td>
                                        <td><?= $Attendane->Batch_name ?></td>
                                        <td><?= $Attendane->Data_date ?></td>
                                        <td><?= $Attendane->Status_date ?></td>
                                        <td><?= $Attendane->Action_data ?></td>
                                        <td>
                                            <?php

                                            if ($row['status'] == 'Present') {

                                                echo '<span class="badge bg-success">Present</span>';

                                            } elseif ($row['status'] == 'Absent') {

                                                echo '<span class="badge bg-danger">Absent</span>';

                                            } else {

                                                echo '<span class="badge bg-warning">Late</span>';

                                            }

                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= $base_url; ?>batches/view.php?id=<?= $batch->id ?>"
                                                class="btn btn-sm btn-info mb-2"><i class="fa-regular fa-eye"></i></a>
                                            <a href="<?= $base_url; ?>batches/edit.php?id=<?= $batch->id ?>"
                                                class="btn btn-sm btn-primary mb-2"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="<?= $base_url; ?>batches/delete.php?id=<?= $batch->id ?>"
                                                class="btn btn-sm btn-danger mb-2"
                                                onclick="return confirm('Are you sure you want to delete this batch?')"><i
                                                    class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No batches found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>