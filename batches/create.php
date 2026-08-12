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
                    <h3 class="mb-2 text-size-26 text-color-2">Add New Batch</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <form action="<?= $base_url; ?>batches/store.php" method="POST" class="p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="batch_name" class="form-label">Batch Name</label>
                            <input type="text" class="form-control" id="batch_name" name="batch_name" placeholder="e.g. Web Dev - Summer 2026" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="course_id" class="form-label">Course</label>
                            <select class="form-select" id="course_id" name="course_id" onchange="loadCourseData()" required>
                                <option value="">Select Course</option>
                                <?php
                                $courses = $crud->common_query("SELECT id, course_name, fee,duration FROM courses WHERE deleted_at IS NULL");
                                if ($courses['status']) {
                                    foreach ($courses['data'] as $course) {
                                        echo "<option value='{$course->id}' data-price='{$course->fee}' data-duration='{$course->duration}'>{$course->course_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trainer_id" class="form-label">Trainer</label>
                            <select class="form-select" id="trainer_id" name="trainer_id" required>
                                <option value="">Select Course First</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="Price" name="Price" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="total_seats" class="form-label">Total Seats</label>
                            <input type="number" class="form-control" id="total_seats" name="total_seats" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="Start_date" name="Start_date" onchange="autoSetEndDate()" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="End_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="End_date" name="End_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Discount" class="form-label">Discount</label>
                            <input type="number" step="0.01" class="form-control" id="Discount" name="Discount" value="0.00" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Discount_type" class="form-label">Discount Type</label>
                            <select class="form-select" id="Discount_type" name="Discount_type" required>
                                <option value="1">Fixed (BDT)</option>
                                <option value="2">Percentage (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="0">Upcoming</option>
                                <option value="1">Running</option>
                                <option value="2">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="start_time" class="form-label">Class Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="end_time" class="form-label">Class End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="room" class="form-label">Room</label>
                            <input type="text" class="form-control" id="room" name="room">
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

function loadCourseData() {
    var courseId = document.getElementById('course_id').value;
    var batchNameInput = document.getElementById('batch_name'); 
    var priceInput = document.getElementById('Price');
    var seatsInput = document.getElementById('total_seats'); 
    var trainerSelect = document.getElementById('trainer_id');
    
    var selectedOption = document.getElementById('course_id').options[document.getElementById('course_id').selectedIndex];
    var courseName = selectedOption.text; 
    var price = selectedOption.getAttribute('data-price');
    var duration = parseInt(selectedOption.getAttribute('data-duration'));
    
    
    if(courseId) {
        var now = new Date();
        var monthNames = ["Jan", "Feb", "Mar", "Ap", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        var currentMonth = monthNames[now.getMonth()];
        var currentYear = now.getFullYear();
        batchNameInput.value = courseName + " - " + currentMonth + " " + currentYear;
    } else {
        batchNameInput.value = '';
    }

    
    if(price) {
        priceInput.value = price;
    } else {
        priceInput.value = '';
    }

    
    seatsInput.value = ''; 

    
    if(courseId) {
        fetch('<?= $base_url; ?>batches/get_trainers_by_course.php?course_id=' + courseId)
            .then(response => response.text())
            .then(data => {
                trainerSelect.innerHTML = data;
            });
    } else {
        trainerSelect.innerHTML = '<option value="">Select Course First</option>';
    }
}


function autoSetEndDate() {
    var startDate = document.getElementById('Start_date').value;
    var endDateInput = document.getElementById('End_date');
    var statusSelect = document.getElementById('status');
    
    var selectedOption = document.getElementById('course_id').options[document.getElementById('course_id').selectedIndex];
    var duration = parseInt(selectedOption.getAttribute('data-duration'));
    
    if(startDate) {
        var start = new Date(startDate);
        var today = new Date();
        
        
        if(duration && !isNaN(duration)) {
            start.setMonth(start.getMonth() + duration);
            var year = start.getFullYear();
            var month = String(start.getMonth() + 1).padStart(2, '0');
            var day = String(start.getDate()).padStart(2, '0');
            endDateInput.value = year + '-' + month + '-' + day;
        } else {
            endDateInput.value = '';
        }

        
        today.setHours(0,0,0,0);
        start = new Date(startDate);
        start.setHours(0,0,0,0);
        
        if(start.getTime() === today.getTime()) {
            statusSelect.value = '1'; // Running
        } else if(start < today) {
            statusSelect.value = '2'; // Completed
        } else {
            statusSelect.value = '0'; // Upcoming
        }
    }
}
</script>

<?php require_once "../component/footer.php" ?>