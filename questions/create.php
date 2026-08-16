<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

  <!-- Main Content -->
  <div class="main-content">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-lg-center  flex-column flex-md-row flex-lg-row mt-3">
          <div class="flex-grow-1">
            <h3 class="mb-2 text-size-26 text-color-2">Add Questions</h3>
          </div>
        </div><!-- end card header -->
      </div>
      <!--end col-->
    </div>
    <div class="mt-4">
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <form action="<?= $base_url; ?>questions/store.php" method="POST" class="p-4">
            <div class="row">
              <div class="col-md-12 mb-12">
                <label for="question_name" class="form-label">Question Name</label>
                <input type="text" class="form-control" id="question_name" name="question_name" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="option_a" class="form-label">Option A</label> 
                <input type="text" class="form-control" id="option_a" name="option_a" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="option_b" class="form-label">Option B</label>
                <input type="text" class="form-control" id="option_b" name="option_b" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="option_c" class="form-label">Option C</label>
                <input type="text" class="form-control" id="option_c" name="option_c" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="option_d" class="form-label">Option D</label>
                <input type="text" class="form-control" id="option_d" name="option_d" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="correct_option" class="form-label">Correct Option</label>
                <select class="form-select" id="correct_option" name="correct_option" required>
                  <option value="">Select Correct Option</option>
                  <option value="1">Option A</option>
                  <option value="2">Option B</option>
                  <option value="3">Option C</option>
                  <option value="4">Option D</option>
                </select>
              </div>
                </select>
              </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary">Add Question</button>
              </div>
            </div>
          </form>
        </div> 
      </div> 
    </div>
  </div>

<?php require_once "../component/footer.php" ?>      