<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM questions WHERE id = $id AND deleted_at IS NULL";
$data = $crud->common_query($sql);

if (!$data['status'] || empty($data['data'])) {
    $_SESSION['message'] = ['danger', 'Error', 'Question not found.'];
    echo "<script>window.location.href = '" . $base_url . "questions/list.php?exam_id=" . $data['data'][0]->exam_id . "';</script>";
    exit;
}
$q = $data['data'][0];
?>

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Edit Question</h3>
        </div>
    </div>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $q->id ?>">
        <input type="hidden" name="exam_id" value="<?= $q->exam_id ?>">
        <div class="mb-3">
            <label>Question</label>
            <textarea name="question" class="form-control" rows="3" required><?= htmlspecialchars($q->question) ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Option A</label>
                <input type="text" name="option_a" class="form-control" value="<?= htmlspecialchars($q->option_a) ?>" required>
            </div>
            <div class="col-md-6">
                <label>Option B</label>
                <input type="text" name="option_b" class="form-control" value="<?= htmlspecialchars($q->option_b) ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Option C</label>
                <input type="text" name="option_c" class="form-control" value="<?= htmlspecialchars($q->option_c) ?>" required>
            </div>
            <div class="col-md-6">
                <label>Option D</label>
                <input type="text" name="option_d" class="form-control" value="<?= htmlspecialchars($q->option_d) ?>" required>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label>Correct Answer</label>
            <select name="correct_answer" class="form-select" required>
                <option value="1" <?= ($q->correct_answer == 1) ? 'selected' : '' ?>>Option A</option>
                <option value="2" <?= ($q->correct_answer == 2) ? 'selected' : '' ?>>Option B</option>
                <option value="3" <?= ($q->correct_answer == 3) ? 'selected' : '' ?>>Option C</option>
                <option value="4" <?= ($q->correct_answer == 4) ? 'selected' : '' ?>>Option D</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>
<?php require_once "../component/footer.php"; ?>