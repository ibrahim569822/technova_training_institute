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
          <form action="<?= $base_url; ?>courses/store.php" method="POST" enctype="multipart/form-data" class="p-4">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="course_name" class="form-label">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" required>
              </div>
              </div>
             <div class="row">
              <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Category</label>
                <select class="form-select" id="gender" name="gender" required>
                  <option value="">Select Category</option>
                  <option value="1">Technology</option>
                  <option value="2">Programming</option>
                  <option value="3">Hacking</option>
                  <option value="4">Networking</option>
                  <option value="5">Designing</option>
                  <option value="6">Development</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                  <option value="">Select Status</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary">Add Course</button>
              </div>
            </div>
          </form>
        </div> 
      </div> 
    </div>
  </div>

<?php require_once "../component/footer.php" ?>      