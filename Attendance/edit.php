<?php

require_once "../config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $attendance = [];

  $attendance['batch_id'] = $_POST['batch_id'];
  $attendance['trainee_id'] = $_POST['trainee_id'];
  $attendance['attendance_date'] = $_POST['attendance_date'];
  $attendance['status'] = $_POST['status'];

  $result = $crud->common_create("attendance", $attendance);

  if ($result['status']) {

    $_SESSION['message'] = array(
      'success',
      'Success',
      'Attendance added successfully.'
    );

    echo "<script>
        window.location.href = '" . $base_url . "attendance/list.php';
        </script>";
    exit;

  } else {

    $_SESSION['message'] = array(
      'danger',
      'Error',
      $result['message']
    );
  }
}
?>

      <div class="container">

        <div class="card">

          <div class="card-header">
            <h4>Add Attendance</h4>
          </div>

          <div class="card-body">

            <form method="POST">

              <div class="mb-3">
                <label>Batch</label>

                <select name="batch_id" class="form-control" required>

                  <option value="">Select Batch</option>

                  <?php

                  $batches = $crud->common_get("batches");

                  foreach ($batches as $batch) {
                    ?>

                    <option value="<?= $batch['id']; ?>">
                      <?= htmlspecialchars($batch['batch_name']); ?>
                    </option>

                  <?php } ?>

                </select>

              </div>


              <div class="mb-3">

                <label>Trainee</label>

                <select name="trainee_id" class="form-control" required>

                  <option value="">Select Trainee</option>

                  <?php

                  $trainees = $crud->common_get("trainees");

                  foreach ($trainees as $trainee) {
                    ?>

                    <option value="<?= $trainee['id']; ?>">
                      <?= htmlspecialchars($trainee['trainee_name']); ?>
                    </option>

                  <?php } ?>

                </select>

              </div>


              <div class="mb-3">

                <label>Attendance Date</label>

                <input type="date" name="attendance_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>

              </div>


              <div class="mb-3">

                <label>Status</label>

                <select name="status" class="form-control" required>

                  <option value="Present">Present</option>
                  <option value="Absent">Absent</option>
                  <option value="Late">Late</option>

                </select>

              </div>


              <button type="submit" class="btn btn-primary">
                Save Attendance
              </button>

              <a href="list.php" class="btn btn-secondary">
                Back
              </a>

            </form>

          </div>

        </div>

      </div>

</body>

</html>