<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->

  <!-- Main Content -->
  <div class="main-content">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-lg-center  flex-column flex-md-row flex-lg-row mt-3">
          <div class="flex-grow-1">
            <h3 class="mb-2 text-size-26 text-color-2">Add New Categories </h3>
          </div>
        </div><!-- end card header -->
      </div>
      <!--end col-->
    </div>
    <div class="mt-4">
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <form action="<?= $base_url; ?>courses/categories/store.php" method="POST" class="p-4">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Category Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary">Add Category</button>
              </div>
            </div>
          </form>
        </div> 
      </div> 
    </div>
  </div>

<?php require_once "../../component/footer.php" ?>      