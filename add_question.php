<?php require_once "component/header.php"; ?>

<!-- Sidebar Start -->
<?php require_once "component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$trainer_id = $_SESSION['user_id'] ?? null;
// Fetch only batches assigned to this trainer
$sql = "SELECT id, batch_name FROM batches WHERE trainer_id = $trainer_id AND deleted_at IS NULL";
echo "<br>";
echo $sql;

$my_batches = $crud->common_select($sql);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $batch_id       = $_POST['batch_id'];
    $question_text  = trim($_POST['question_text']);
    $option_a       = trim($_POST['option_a']);
    $option_b       = trim($_POST['option_b']);
    $option_c       = trim($_POST['option_c']);
    $option_d       = trim($_POST['option_d']);
    $correct_option = $_POST['correct_option'];
    $marks          = $_POST['marks'];

    // Security check: does this batch actually belong to this trainer?
    $check_sql = "SELECT id FROM batches WHERE id = ? AND trainer_id = ?";
    $owned = $crud->common_select($check_sql, "ii", [$batch_id, $trainer_id]);

    if (empty($owned)) {
        $message = "Error: You are not assigned to this batch.";
    } elseif ($question_text === '' || $option_a === '' || $option_b === '' || $option_c === '' || $option_d === '') {
        $message = "Error: All fields are required.";
    } else {
        $insert_sql = "INSERT INTO questions 
            (batch_id, question_text, option_a, option_b, option_c, option_d, correct_option, marks) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [$batch_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option, $marks];
        $types  = "isssssssi"; // note: 8 params below, fix type string to match count

        $result = $crud->common_insert($insert_sql, "issssssi", $params);

        $message = $result ? "Question added successfully." : "Error: Could not add question.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Exam Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h3>Add Exam Question</h3>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Batch</label>
            <select name="batch_id" class="form-select" required>
                <option value="">-- Select Batch --</option>
                <?php foreach ($my_batches as $batch): ?>
                    <option value="<?= $batch['id'] ?>">
                        <?= htmlspecialchars($batch['batch_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Question</label>
            <textarea name="question_text" class="form-control" rows="2" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Option A</label>
            <input type="text" name="option_a" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option B</label>
            <input type="text" name="option_b" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option C</label>
            <input type="text" name="option_c" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Option D</label>
            <input type="text" name="option_d" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correct Option</label>
            <select name="correct_option" class="form-select" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Marks</label>
            <input type="number" name="marks" class="form-control" value="1" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Question</button>
    </form>

</body>
</html>