```php
<?php

require_once "../config/database.php";

$id = $_GET['id'] ?? 0;

if (!$id) {
    header("Location: list.php");
    exit;
}

$sql = "SELECT
            a.*,
            b.batch_name,
            t.trainee_name
        FROM attendance a
        INNER JOIN batches b
            ON a.batch_id = b.id
        INNER JOIN trainees t
            ON a.trainee_id = t.id
        WHERE a.id = $id";

$result = $crud->conn->query($sql);

$attendance = $result->fetch_assoc();

if (!$attendance) {
    die("Attendance not found.");
}

?>


<div class="container">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4>Attendance Details</h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">ID</th>
                    <td><?= $attendance['id']; ?></td>
                </tr>

                <tr>
                    <th>Trainee</th>
                    <td>
                        <?= htmlspecialchars($attendance['trainee_name']); ?>
                    </td>
                </tr>

                <tr>
                    <th>Batch</th>
                    <td>
                        <?= htmlspecialchars($attendance['batch_name']); ?>
                    </td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td>
                        <?= $attendance['attendance_date']; ?>
                    </td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>

                        <?php if ($attendance['status'] == 'Present') { ?>

                            <span class="badge bg-success">
                                Present
                            </span>

                        <?php } elseif ($attendance['status'] == 'Absent') { ?>

                            <span class="badge bg-danger">
                                Absent
                            </span>

                        <?php } else { ?>

                            <span class="badge bg-warning">
                                Late
                            </span>

                        <?php } ?>

                    </td>
                </tr>

            </table>

            <a href="list.php" class="btn btn-secondary">
                Back
            </a>

            <a href="edit.php?id=<?= $attendance['id']; ?>" class="btn btn-success">
                Edit
            </a>

        </div>

    </div>

</div>

</body>

</html>
```