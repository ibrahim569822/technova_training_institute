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
            <h3 class="mb-2 text-size-26 text-color-2">Add New Course</h3>
          </div>
        </div><!-- end card header -->
      </div>
      <!--end col-->
    </div>
    <div class="mt-4">
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <form action="<?= $base_url; ?>courses/store.php" method="POST" class="p-4">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" required>
              </div>
              </div>
             <div class="row">
              <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php
                              
                                $categories = $crud->common_query("SELECT id, category_name FROM categories WHERE deleted_at IS NULL");
                                if ($categories['status']) {
                                    foreach ($categories['data'] as $category) {
                                        echo "<option value='{$category->id}'>{$category->category_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
              <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="fee" class="form-label">Fee</label>
                <input type="number" class="form-control" id="fee" name="fee" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="trainer_id" class="form-label">Trainer Id</label>
                <input type="text" class="form-control" id="trainer_id" name="trainer_id" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="">Select Status</option>
                  <option value="1">Running</option>
                  <option value="0">Upcoming</option>
                  <option value="2">Completed</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 co-mb-12">
                <button type="submit" class="btn btn-primary">Add Course</button>
              </div>
            </div>
          </form>
        </div> 
      </div> 
    </div>
  </div>

<?php require_once "../component/footer.php" ?>      