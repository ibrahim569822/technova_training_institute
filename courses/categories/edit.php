<?php require_once "../../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../../component/sidebar.php"; ?>
<!-- Sidebar End -->
<?php
  $id = $_GET['id'];
  $category = $crud->common_select("categories", "*", ['id' => $id]);
  if (!$category['status'] || empty($category['data'])) {
    $_SESSION['message'] = array('danger','Error', 'Category not found.');
    echo "<script>window.location.href = '".$base_url."courses/categories/list.php';</script>";
    exit;
  }

  $category = $category['data'][0];

?>
  <!-- Main Content -->
  <div class="main-content">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-lg-center  flex-column flex-md-row flex-lg-row mt-3">
          <div class="flex-grow-1">
            <h3 class="mb-2 text-size-26 text-color-2">Edit Category </h3>
          </div>
        </div><!-- end card header -->
      </div>
      <!--end col-->
    </div>
    <div class="mt-4">
      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <form action="<?= $base_url; ?>courses/categories/update.php" method="POST" class="p-4">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $category->category_name ?>" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Category Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?= $category->description ?></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <input type="hidden" name="id" value="<?= $category->id ?>">
                <button type="submit" class="btn btn-primary">Update Category</button>
              </div>
            </div>
          </form>
        </div> 
      </div> 
    </div>
  </div>

<?php require_once "../../component/footer.php" ?>      