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
                            <i class="fa-solid fa-plus me-3"></i> Add Attendance
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
                                <th>Present</th>
                                <th>Absent</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                       
                            $sql = "SELECT `attendance_date`,
                                    sum(if(status=0,1,0)) as present,
                                    sum(if(status=1,1,0)) as absent
                                    FROM `attendance` 
                                    WHERE deleted_at IS NULL group by `attendance_date`";

                            $result = $crud->common_query($sql);
                            if ($result['status']) {
                                foreach ($result['data'] as $att) {
                            ?>

              <tr>
                <td><?= $att->attendance_date ?></td>
                <td><?= $att->present ?></td>
                <td><?= $att->absent ?></td>
                <td>

                  <a href="view.php?attendance_date=<?= $att->attendance_date; ?>" class="btn btn-sm btn-primary">
                    View
                  </a>

                </td>

              </tr>

            <?php } } ?>

          </tbody>

        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../component/footer.php" ?>