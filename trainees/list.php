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
          <h3 class="mb-2 text-size-26 text-color-2">Trainees</h3>
        </div>
        <div class="mt-3 mt-lg-0">
          <div class="d-flex align-items-center">
            <!-- Date Range Button -->
            <div
              class="cursor-pointer bg-white d-flex align-items-center text-color-1 px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26 dropdown-toggle"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-filter me-3"></i>
              Filter by
              <i class="fa-solid fa-chevron-right ms-3 text-size-sm"></i>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Active</a></li>
                <li><a class="dropdown-item" href="#">Inactive</a></li>
              </ul>
            </div>
            <!-- Reports Button -->
            <a href="<?php echo $base_url; ?>trainees/create.php"
              class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
              <i class="fa-solid fa-plus me-3"></i>
              Add Trainee
            </a>
          </div>
        </div>
      </div><!-- end card header -->
    </div>
    <!--end col-->
  </div>
  <div class="mt-4">
    <div class="card shadow-sm border-0">
      <div class="card-body p-0">
        <div class="table-responsive table-rounded-top">
          <table class="table align-middle">
            <thead>
              <tr>
                <th><input type="checkbox" id="select-all" class="custom-checkbox"></th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Education</th>
                <th>Status</th>
                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Fetch trainees from the database
              if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $page = (int) $_GET['page'];
              } else {
                $page = 1;
              }
              $trainees = $crud->common_select("trainees", '*', [], 'AND', 'id', 'ASC', 10, ($page - 1) * 10);

              if ($trainees['status']) {
                foreach ($trainees['data'] as $trainee) { ?>
                  <tr>
                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                    <td>
                      <div class="d-flex justify-content-start align-items-center">
                        <img
                          src="<?= $trainee->image ? '../assets/uploads/trainees/images/' . $trainee->image : '../assets/images/avatar-1.jpg' ?>"
                          class="tbl-img" alt="">
                        <span class="ms-2"><?= $trainee->full_name ?></span>
                      </div>
                    </td>
                    <td><?= $trainee->email ?></td>
                    <td><?= $trainee->phone ?></td>
                    <td><?= $trainee->education ?></td>
                    <td>
                      <?php if ($trainee->status == '1') { ?>
                        <span class="badge bg-success">Active</span>
                      <?php } else { ?>
                        <span class="badge bg-danger">Inactive</span>
                      <?php } ?>
                    </td>
                    <td class="text-center">
                      <a href="<?= $base_url ?>trainees/edit.php?id=<?= $trainee->id ?>"
                        class="btn btn-sm btn-primary mb-2 mb-lg-0 me-0 me-lg-2"><i
                          class="fa-regular fa-pen-to-square"></i></a>
                      <a href="<?= $base_url ?>trainees/delete.php?id=<?= $trainee->id ?>" class="btn btn-sm btn-danger"><i
                          class="fa-solid fa-trash-can"></i></a>
                    </td>
                  </tr>
                <?php }
              } ?>

            </tbody>
          </table>
        </div>

        <div
          class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
          <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
            <?php
            $total_records = $crud->number_of_records("trainees");
            $records_per_page = 10;
            $total_pages = ceil($total_records / $records_per_page);
            ?>
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous"><i
                    class="fa-solid fa-chevron-left text-size-12"></i></a>
              </li>
              <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a class="page-link"
                    href="<?= $base_url ?>trainees/list.php?page=<?= $i ?>"><?= $i ?></a></li>
              <?php } ?>

              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next"><i
                    class="fa-solid fa-chevron-right text-size-12"></i></a>
              </li>
            </ul>
          </nav>
          <!-- <div class="d-flex justify-content-end">
                      <div class="page-selector">
                        <span>PAGE</span>
                        <select class="form-select" aria-label="Select page">
                          <option value="1" selected>1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                        <span>OF 102</span>
                      </div>
                  </div> -->
        </div>
      </div>
    </div>
  </div>

  <?php require_once "../component/footer.php" ?>