<?php require_once "component/header.php"; ?>

<!-- Sidebar Start -->
<?php require_once "component/sidebar.php"; ?>
<!-- Sidebar End -->

            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-column flex-md-row  flex-lg-row  mt-3">
                            <div class="flex-grow-1">
                                <h3 class="mb-2 text-color-2">Dashboard</h3>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <div class="mt-4">
                      <div class="row">
                             <div class="col-lg-3">
                                <div class="row">
                                  <!-- Total Students Card -->
                                  <div class="col-12 col-md-6 col-lg-12 mb-4">
                                      <div class="stats-card">
                                          <div class="d-flex justify-content-between align-items-start">
                                              <div>
                                                  <div class="stats-label">Total Students</div>
                                                  <div class="stats-value"><?php echo $crud->number_of_records("trainees"); ?></div>
                                                  <div class="trend-wrapper">
                                                      This month 
                                                      <span class="trend-up">
                                                          <i class="fas fa-arrow-up"></i> 8.5%
                                                      </span>
                                                  </div>
                                              </div>
                                              <div class="icon-wrapper icon-purple">
                                                  <i class="fas fa-users"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                      
                                  <!-- Total Courses Card -->
                                  <div class="col-12 col-md-6 col-lg-12 mb-4">
                                      <div class="stats-card">
                                          <div class="d-flex justify-content-between align-items-start">
                                              <div>
                                                  <div class="stats-label">Total Courses</div>
                                                  <div class="stats-value"><?php echo $crud->number_of_records("courses"); ?></div>
                                                  <div class="trend-wrapper">
                                                      This month 
                                                      <span class="trend-up">
                                                          <i class="fas fa-arrow-up"></i> 8.5%
                                                      </span>
                                                  </div>
                                              </div>
                                              <div class="icon-wrapper icon-red">
                                                  <i class="fas fa-play-circle"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                      
                                  <!-- Overall batch -->
                                  <div class="col-12 col-md-6 col-lg-12 mb-4">
                                      <div class="stats-card">
                                          <div class="d-flex justify-content-between align-items-start">
                                              <div>
                                                  <div class="stats-label">Total Batches</div>
                                                  <div class="stats-value"><?php echo $crud->number_of_records("batches"); ?></div>
                                                  <div class="trend-wrapper">
                                                      Active batches
                                                      <span class="trend-up">
                                                          <i class="fas fa-arrow-up"></i> 8.5%
                                                      </span>
                                                  </div>
                                              </div>
                                              <div class="icon-wrapper icon-red">
                                                  <i class="fas fa-play-circle"></i>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  
                                </div>
                            </div>
                             <div class="col-lg-5 mb-4 mb-lg-0">
                              <div class="instructors-section card pb-0">
                                <div class="card-header border-0 bg-white d-flex justify-content-between align-items-center py-3">
                                  <h5 class="mb-0 text-color-2">Traffic Sources</h5>
                                  <div>
                                    <select class="form-select form-select-sm w-auto border-0 text-color-3" aria-label="Select time period">
                                        <option value="30 days" selected>30 days</option>
                                        <option value="15 days">15 days</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="card-body p-0 mt-40">
                                  <div class="mb-2">
                                    <div class="chart-container">
                                      <canvas id="trafficChart"></canvas>
                                   </div>
                                    <div class="mx-5 mt-5 traffic-legend">
                                      <table class="table table-borderless">
                                          <tbody>
                                              <tr>
                                                  <td><span class="organic text-color-1">Organic Search</span></td>
                                                  <td><span class="text-color-2">4,305</span></td>
                                              </tr>
                                              <tr>
                                                  <td><span class="referrals text-color-1">Referrals</span></td>
                                                  <td><span class="text-color-2">482</span></td>
                                              </tr>
                                              <tr>
                                                  <td><span class="social-media text-color-1">Social Media</span></td>
                                                  <td><span class="text-color-2">859</span></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>                                
                                </div>
                                </div>
                              </div>
                             </div>
                             <div class="col-lg-4 mb-4 mb-lg-0">
                              <div class="instructors-section card pb-1">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center py-4">
                                  <h5 class="mb-0 text-color-2">Top Instructors</h5>
                                  <a href="#" class="text-color-3">View All</a>
                                </div>
                                <div class="card-body p-0">
                                  <ul class="list-group list-group-flush">
                                    <?php
                                    $sql = "select user.full_name as trainer_name, user.email from trainers as trainer join users as user on trainer.user_id = user.id ";
                                    $instructors = $crud->common_query($sql);

                                    foreach ($instructors['data'] as $instructor) {
                                        echo '<li class="list-group-item d-flex align-items-center py-3">
                                                <div class="avatar rounded-circle bg-primary text-white me-3">'.$instructor->trainer_name .'</div>
                                                <div class="flex-grow-1">
                                                  <h6 class="mb-0 text-color-2">'.$instructor->trainer_name.'</h6>
                                                  <small class="text-color-3">'.$instructor->email.'</small>
                                                </div>
                                                <div class="text-end">
                                                  <i class="fa-solid fa-chevron-right arrow-icon"></i>
                                              </li>';
                                    }
                                    ?>
                                  </ul>
                                </div>
                              </div>
                             </div>
                             <div class="col-lg-8 mb-4 mb-lg-0">
                              <div class="instructors-section card">
                                <div class="card-header border-0 bg-white d-flex justify-content-between align-items-center py-3">
                                  <h5 class="mb-0 text-color-2">Conversions</h5>
                                  <div>
                                    <select class="form-select form-select-sm w-auto border-0 text-color-3" aria-label="Select time period">
                                        <option value="30 days" selected>30 days</option>
                                        <option value="15 days">15 days</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <canvas id="barChart" class="mt-5" height="96"></canvas>
                                </div>
                              </div>
                             </div>
                             <div class="col-lg-4">
                              <div class="instructors-section card pb-1">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center py-4">
                                  <h5 class="mb-0 text-color-2">Top Categories</h5>
                                  <a href="#" class="text-color-3">View All</a>
                                </div>
                                <div class="card-body p-0">
                                  <ul class="list-group list-group-flush">

                                  <?php
                                  $categories = $crud->common_select("categories", '*', [], 'AND', 'id', 'ASC', 10, 0);
                                  if ($categories['status']) {
                                      foreach ($categories['data'] as $category) {
                                          echo '<li class="list-group-item d-flex align-items-center py-3">
                                                  <div class="avatar rounded-circle bg-primary text-white me-3">'. $category->category_name .'</div>
                                                  <div class="flex-grow-1">
                                                    <h6 class="mb-0 text-color-2">'.$category->category_name.'</h6>
                                                    <small class="text-color-3">'. $crud->common_select("courses", "COUNT(*) as total", ["category_id" => $category->id])['data'][0]->total .' Courses</small>
                                                  </div>
                                                  <div class="text-end">
                                                    <i class="fa-solid fa-chevron-right arrow-icon"></i>
                                                  </div>
                                                </li>';
                                      } ?>
                                  <?php } else { ?>
                                      <li class="list-group-item d-flex align-items-center py-3">
                                          <div class="flex-grow-1">
                                              <h6 class="mb-0 text-color-2">No categories found</h6>
                                          </div>
                                      </li>
                                  <?php } ?>


                                  </ul>
                                </div>
                              </div>
                             </div>
                      </div> 
                </div>
            </div>
             
            <?php require_once "component/footer.php" ?>