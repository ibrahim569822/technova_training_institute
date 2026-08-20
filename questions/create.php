<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Add Question</h3>
        </div>
    </div>
    <form action="store.php" method="POST">
        <input type="hidden" name="exam_id" value="<?= $_GET['exam_id'] ?>">
        <div class="mb-3">
            <label>Question</label>
            <textarea name="question" class="form-control" rows="3" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Option A</label>
                <input type="text" name="option_a" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Option B</label>
                <input type="text" name="option_b" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label>Option C</label>
                <input type="text" name="option_c" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Option D</label>
                <input type="text" name="option_d" class="form-control" required>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label>Correct Answer</label>
            <select name="correct_answer" class="form-select" required>
                <option value="1">Option A</option>
                <option value="2">Option B</option>
                <option value="3">Option C</option>
                <option value="4">Option D</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Mark</label>
            <input type="number" name="mark" class="form-control" required>
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-primary">Save Question</button>
        </div>
    </form>
</div>
<?php require_once "../component/footer.php"; ?>