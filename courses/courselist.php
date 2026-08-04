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
                                <h3 class="mb-2 text-color-2">Courses</h3>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <div class="d-flex align-items-center">
                                  <!-- Date Range Button -->
                                  <div class="cursor-pointer bg-white d-flex align-items-center text-color-1 px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="fa-solid fa-filter me-3"></i>
                                      Filter by
                                    <i class="fa-solid fa-chevron-right ms-3 text-size-sm"></i>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Active</a></li>
                                      <li><a class="dropdown-item" href="#">Inactive</a></li>
                                   </ul>
                                  </div>
                                  <!-- Reports Button -->
                                   <a href="<?= $base_url; ?>courses/create.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                                      <i class="fa-solid fa-plus me-3"></i>
                                      Add Course
                                   </a>
                                   <a href="<?= $base_url; ?>courses/categories/list.php" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                                      <i class="fa-solid fa-list me-3"></i>
                                      Categories
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
                                <th>Course Name</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              // Fetch courses from the database
                              if(isset($_GET['page']) && is_numeric($_GET['page'])){
                                  $page = (int)$_GET['page'];
                              } else {
                                  $page = 1;
                              }
                              $courses = $crud->common_select("courses",'*',[],'AND','id','ASC',3,($page-1)*3);
                              if ($courses['status'] && !empty($courses['data'])) {
                                foreach ($courses['data'] as $course) {
                              ?>
                                <tr>
                                  <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                  <td><?php echo $course->course_name; ?></td>
                                  <td><?php echo $course->category_id; ?></td>
                                  <td><?php echo $course->duration; ?></td>
                                  <td>$<?php echo $course->fee; ?></td>
                                  <td><?php if($course->status == 1) { echo '<span class="badge bg-success">Completed</span>'; }
                                  elseif($course->status == 0){echo '<span class="badge bg-warning">Running</span>';} 
                                  else { echo '<span class="badge bg-danger">Upcoming</span>'; } ?></td>
                                  <td>
                                    <a onclick="courseDetails(<?= $course->id ?>)" href="#" class="btn btn-sm btn-info me-2"><i class="fa-solid fa-eye"></i></a>
                                    <a href="<?= $base_url ?>courses/edit.php?id=<?= $course->id ?>" class="btn btn-sm btn-primary mb-2 mb-lg-0 me-0 me-lg-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteCourse(<?= $course->id ?>)"><i class="fa-solid fa-trash-can"></i></a>
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      <span class="btn btn-sm btn-success"><i class="fas fa-ellipsis-h"></i></span>
                                      <ul class="dropdown-menu">
                                        <li><a class="dropdown-item py-2" href="#">Active</a></li>
                                        <li><a class="dropdown-item py-2" href="#">Inactive</a></li>
                                        <li><a class="dropdown-item py-2" href="#">Pending</a></li>
                                      </ul>
                                    </a>
                                  </td>
                                </tr>
                                <?php } } ?>
                              </tbody>
                          </table>
                        </div>

                <div class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
                <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
                  <?php
                      $total_records = $crud->number_of_records("courses");
                      $records_per_page = 3;
                      $total_pages = ceil($total_records / $records_per_page);
                  ?>
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-chevron-left text-size-12"></i></a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a class="page-link" href="<?= $base_url ?>courses/courselist.php?page=<?= $i ?>"><?= $i ?></a></li>
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

        <?php require_once "../component/footer.php"; ?>