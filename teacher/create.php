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
          <h3 class="mb-2 text-size-26 text-color-2">Add New Trainee</h3>
        </div>
      </div><!-- end card header -->
    </div>
    <!--end col-->
  </div>
  <div class="mt-4">
    <div class="card shadow-sm border-0">
      <div class="card-body p-0">
        <form action="<?= $base_url; ?>trainees/store.php" method="POST" enctype="multipart/form-data" class="p-4">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="full_name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="dob" class="form-label">Date of Birth</label>
              <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-select" id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Other</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="joining_date" class="form-label">Joining Date</label>
              <input type="date" class="form-control" id="joining_date" name="joining_date" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="col-md-6 mb-3">
              <label for="qualification" class="form-label">Qualification</label>
              <textarea type="text" class="form-control" id="qualification" name="qualification"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="specialization" class="form-label">Specialization</label>
              <textarea type="text" class="form-control" id="specialization" name="specialization"></textarea>
            </div>
            <div class="col-md-6 mb-3">
              <label for="experience" class="form-label">Experience</label>
              <textarea type="text" class="form-control" id="experience" name="experience"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="image" class="form-label">Profile Image</label>
              <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <div class="col-md-6 mb-3">
              <label for="salary" class="form-label">Salary</label>
              <input type="text" class="form-control" id="salary" name="salary">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
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
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once "../component/footer.php" ?>