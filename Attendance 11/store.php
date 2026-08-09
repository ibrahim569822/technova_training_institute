<?php
require_once "../config/database.php";

$date = $_POST['attendance_date'] ?? date('Y-m-d');
$batch_id = isset($_POST['batch_id']) ? (int) $_POST['batch_id'] : 0;
$message = "";

$batches = $mysqli->query("SELECT id, batch_name FROM batches ORDER BY batch_name");

$trainees = [];
if ($batch_id > 0) {
    $stmt = $mysqli->prepare("SELECT id, trainee_name FROM trainees WHERE id IN (SELECT trainee_id FROM attendance WHERE batch_id = ? GROUP BY trainee_id) ORDER BY trainee_name");
    $stmt->bind_param("i", $batch_id);
    $stmt->execute();
    $trainees = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // If no previous attendance exists for the batch, show all trainees.
    if (!$trainees) {
        $res = $mysqli->query("SELECT id, trainee_name FROM trainees ORDER BY trainee_name");
        $trainees = $res->fetch_all(MYSQLI_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_attendance'])) {
    $batch_id = (int) $_POST['batch_id'];
    $date = $_POST['attendance_date'];
    $statuses = $_POST['status'] ?? [];

    $stmt = $mysqli->prepare(
        "INSERT INTO attendance (batch_id, trainee_id, attendance_date, status)
         VALUES (?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE status = VALUES(status)"
    );

    foreach ($statuses as $trainee_id => $status) {
        $trainee_id = (int) $trainee_id;
        if (!in_array($status, ['Present', 'Absent', 'Late'], true))
            continue;
        $stmt->bind_param("iiss", $batch_id, $trainee_id, $date, $status);
        $stmt->execute();
    }
    header("Location: index.php?date=" . urlencode($date) . "&batch_id=" . $batch_id . "&success=1");
    exit;
}
?>