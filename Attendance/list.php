```php
<?php

require_once "../config/database.php";

$sql = "SELECT
            a.id,
            a.attendance_date,
            a.status,
            b.batch_name,
            t.trainee_name

        FROM attendance a

        INNER JOIN batches b
            ON a.batch_id = b.id

        INNER JOIN trainees t
            ON a.trainee_id = t.id

        ORDER BY a.attendance_date DESC, a.id DESC";

$result = $crud->conn->query($sql);

?>


<div class="container">

  <div class="d-flex justify-content-between align-items-center mb-4">

    <h3>Attendance Management</h3>

    <a href="add.php" class="btn btn-primary">
      + Add Attendance
    </a>

  </div>


  <div class="card shadow">

    <div class="card-body">

      <div class="table-responsive">

        <table class="table table-bordered table-hover">

          <thead class="table-dark">

            <tr>

              <th>SL</th>
              <th>Trainee</th>
              <th>Batch</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $sl = 1;

            while ($row = $result->fetch_assoc()) {

              ?>

              <tr>

                <td><?= $sl++; ?></td>

                <td>
                  <?= htmlspecialchars($row['trainee_name']); ?>
                </td>

                <td>
                  <?= htmlspecialchars($row['batch_name']); ?>
                </td>

                <td>
                  <?= $row['attendance_date']; ?>
                </td>

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

                <td>

                  <a href="view.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">
                    View
                  </a>

                  <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success">
                    Edit
                  </a>

                  <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this attendance?');">
                    Delete
                  </a>

                </td>

              </tr>

            <?php } ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

</body>

</html>
```