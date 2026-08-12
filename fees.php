<?php require_once "component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "component/sidebar.php"; ?>
<!-- Sidebar End -->
            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center  flex-column flex-md-row flex-lg-row mt-3">
                            <div class="flex-grow-1">
                                <h3 class="mb-2 text-size-26 text-color-2">Fees</h3>
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
                                   <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#CreateModal" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                                      <i class="fa-solid fa-plus me-3"></i>
                                      Add Fees
                                   </a> -->
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
                                    <th>Student Name</th>
                                    <th>Batch</th>
                                    <th>Amount Paid</th>
                                    <th>Amount Due</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch fees from the database 
                                    if(isset($_GET['page']) && is_numeric($_GET['page'])){
                                        $page = (int)$_GET['page'];
                                    } else {
                                        $page = 1;
                                    }
                                    $limit = 10; // Number of records per page
                                    $offset = ($page - 1) * $limit;
                                    
                                    ?>

                                  <tr>
                                    <td>Roger</td>
                                    <td>01</td>
                                    <td>V</td>
                                    <td>$98</td>
                                    <td>cash</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                  </tr>
                                  
                                
                                </tbody>
                              </table>                              
                        </div>

                        <div class="pb-3 ps-3 mt-3 d-flex justify-content-center justify-content-md-between justify-content-lg-between flex-wrap flex-md-nowrap">
                            <nav aria-label="Page navigation" class="mb-3 mb-md-0 mb-lg-0">
                                <ul class="pagination">
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-chevron-left text-size-12"></i></a>
                                  </li>
                                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#"><i class="fas fa-ellipsis-h"></i></a></li>
                                  <li class="page-item"><a class="page-link" href="#">6</a></li>
                                  <li class="page-item"><a class="page-link" href="#">7</a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next"><i class="fa-solid fa-chevron-right text-size-12"></i></a>
                                  </li>
                                </ul>
                            </nav>
                            <div class="d-flex justify-content-end">
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
                            </div>
                        </div>
                </div> 
                </div> 
           </div>
        </div>
         
<?php require_once "component/footer.php"; ?>