<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Take Loan</h3>
        </div>
    </div>
    <form action="loan_store.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label>Teacher</label>
                <select name="teacher_id" class="form-select" required>
                    <option value="">Select Teacher</option>
                    <?php
                    $teachers = $crud->common_query("SELECT trainers.id, users.full_name FROM trainers JOIN users ON trainers.user_id = users.id WHERE trainers.deleted_at IS NULL");
                    foreach ($teachers['data'] as $t) {
                        echo "<option value='{$t->id}'>{$t->full_name}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>Loan Amount</label>
                <input type="number" step="0.01" name="loan_amount" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Installments</label>
                <input type="number" name="installment_count" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save Loan</button>
    </form>
</div>
<?php require_once "../../component/footer.php"; ?>