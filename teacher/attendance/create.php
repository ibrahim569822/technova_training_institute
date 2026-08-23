<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-success">Add Attendance</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="store.php" method="POST" class="p-4">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="attendance_date" class="form-label">Attendance Date</label>
                           
                            <input type="date" class="form-control" id="attendance_date" name="attendance_date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="button" class="btn btn-success" onclick="loadTeachers()">Load Teachers</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Teacher Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="teacherTableBody">
                                    <!-- Teachers will be loaded here via JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-success">Save Attendance</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function loadTeachers() {
        const attendanceDate = document.getElementById('attendance_date').value;
        if (!attendanceDate) {
            alert('Please select a date first.');
            return;
        }

      
        fetch(`<?= $base_url ?>teacher/attendance/get_all_teachers.php?attendance_date=${attendanceDate}`)
            .then(response => response.text())
            .then(data => {
                if (data) {
                    document.getElementById('teacherTableBody').innerHTML = data;
                } else {
                    document.getElementById('teacherTableBody').innerHTML = '<tr><td colspan="3">No teachers found.</td></tr>';
                }
            })
            .catch(error => console.error('Error fetching teachers:', error));
    }
</script>

<?php require_once "../../component/footer.php" ?>