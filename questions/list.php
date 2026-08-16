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
                      <h3 class="mb-2 text-size-26 text-color-2">Questions</h3>
                  </div>
                  <div class="mt-3 mt-lg-0">
                      <div class="d-flex align-items-center">
                        <!-- Date Range Button -->
                        <div class="cursor-pointer bg-white d-flex align-items-center text-color-1 px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter me-3"></i>
                            Filter by
                          <i class="fa-solid fa-chevron-right ms-3 text-size-sm"></i>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li><a class="dropdown-item" href="#">Inactive</a></li>
                          </ul>
                        </div>
                        <!-- Reports Button -->
                          <a href="<?php echo $base_url; ?>questions/create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                            <i class="fa-solid fa-plus me-3"></i>
                            Add New
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
                          <th>Question Name</th>
                          <th>Option A</th>
                          <th>Option B</th>
                          <th>Option C</th>
                          <th>Option D</th>
                          <th>Correct Option</th>
                          <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Fetch questions from the database
                        if(isset($_GET['page']) && is_numeric($_GET['page'])){
                            $page = (int)$_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $questions = $crud->common_select("questions",'*',[],'AND','id','ASC',10,($page-1)*10);
                        
                        if($questions['status']){
                        foreach ($questions['data'] as $question) { ?>
                        <tr>
                          
                          <td><?= $question->question_name ?></td>
                          <td><?= $question->option_a ?></td>
                          <td><?= $question->option_b ?></td>
                          <td><?= $question->option_c ?></td>
                          <td><?= $question->option_d ?></td>
                          <td><?= $question->correct_option ?></td>
                          <td class="text-center">
                            <a href="<?= $base_url ?>questions/edit.php?id=<?= $question->id ?>" class="btn btn-sm btn-primary mb-2 mb-lg-0 me-0 me-lg-2"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="<?= $base_url ?>questions/delete.php?id=<?= $question->id ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                          </td>
                        </tr>
                        <?php } } ?>
                       
                      </tbody>
                    </table>
              </div>

              <div class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
                <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
                  <?php
                      $total_records = $crud->number_of_records("questions");
                      $records_per_page = 10;
                      $total_pages = ceil($total_records / $records_per_page);
                  ?>
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-chevron-left text-size-12"></i></a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a class="page-link" href="<?= $base_url ?>questions/list.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php } ?>
                    
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next"><i class="fa-solid fa-chevron-right text-size-12"></i></a>
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