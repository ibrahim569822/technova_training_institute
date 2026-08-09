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
                    <h3 class="mb-2 text-size-26 text-color-2">Add New Attendance</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>attendance/store.php" method="POST" class="p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="attendance_date" class="form-label">Attendance Date</label>
                            <input type="date" class="form-control" id="attendance_date" name="attendance_date" onchange="autoSetStatus()" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="batch_id" class="form-label">Batch Name</label>
                            <select class="form-select" id="batch_id" name="batch_id" required>
                                <option value="">Select Batch</option>
                                <?php
                                $batches = $crud->common_query("SELECT batches.id, batches.batch_name, courses.course_name 
                                    FROM batches 
                                    JOIN courses ON batches.course_id = courses.id 
                                    WHERE batches.deleted_at IS NULL");
                                if ($batches['status']) {
                                    foreach ($batches['data'] as $batch) {
                                        echo "<option value='{$batch->id}'>{$batch->batch_name} ({$batch->course_name})</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="button" class="btn btn-primary" onclick="loadBatchStudent()">Get Batch Details</button>
                        </div>
                    </div>
                    <!-- get all student of the batch and show in table with radio button for present and absent -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Trainee Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Save Batch</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

    function loadBatchStudent() {
        const batchId = document.getElementById('batch_id').value;
        const attendanceDate = document.getElementById('attendance_date').value;
        if (!batchId) {
            alert('Please select a batch first.');
            return;
        }
        // get batch data from api name get_trainers_by_course.php and show in table with radio button for present and absent
        fetch(`<?= $base_url ?>attendance/get_student_by_batch.php?batch_id=${batchId}&attendance_date=${attendanceDate}`)
            .then(response => response.text())
            .then(data => {
                if (data) {
                    document.querySelector('tbody').innerHTML = data;
                } else {
                    document.querySelector('tbody').innerHTML = '<tr><td colspan="3">No trainees found for the selected batch.</td></tr>';
                } 
            })
            .catch(error => console.error('Error fetching batch details:', error));
    }

    
</script>

<?php require_once "../component/footer.php" ?>