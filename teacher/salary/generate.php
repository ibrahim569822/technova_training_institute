<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-column flex-md-row flex-lg-row mt-3">
                <div class="flex-grow-1">
                    <h3 class="mb-2 text-size-26 text-color-2">Salary Generate</h3>
                </div>
                <div class="mt-3 mt-lg-0">
                    <a href="list.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="generate_process.php" method="POST">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="year" class="form-label">Year</label>
                            <select name="year" id="year" class="form-select" required>
                                <?php
                                $current_year = date('Y');
                                for ($y = $current_year; $y >= 2020; $y--) {
                                    echo "<option value='$y' " . ($y == $current_year ? 'selected' : '') . ">$y</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="month" class="form-label">Month</label>
                            <select name="month" id="month" class="form-select" required>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success w-100">Generate Salary</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once "../../component/footer.php"; ?>