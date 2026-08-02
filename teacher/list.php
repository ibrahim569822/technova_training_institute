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
                                <h3 class="mb-2 text-size-26 text-color-2">Teacher</h3>
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
                                   <a href="#" data-bs-toggle="modal" data-bs-target="#CreateModal" class="cursor-pointer ms-4 bg-white bg-primary text-white d-flex align-items-center px-3 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">
                                      <i class="fa-solid fa-plus me-3"></i>
                                      Add Teacher
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
                                    <th>Gender</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Education</th>
                                    <th>Joining Date</th>
                                    <th>Status</th>
                                    <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <!-- Row 1 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-1.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Jane Cooper</span>
                                      </div>
                                    </td>
                                    <td>Female</td>
                                    <td>Accounting</td>
                                    <td>jane.cooper@example.com</td>
                                    <td>9658745874</td>
                                    <td>MTech</td>
                                    <td>2023-01-01</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 2 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-2.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">John Doe</span>
                                      </div>
                                    </td>
                                    <td>Male</td>
                                    <td>Human Resources</td>
                                    <td>john.doe@example.com</td>
                                    <td>9876543210</td>
                                    <td>BBA</td>
                                    <td>2023-03-15</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 3 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-3.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Sarah Connor</span>
                                      </div>
                                    </td>
                                    <td>Female</td>
                                    <td>IT</td>
                                    <td>sarah.connor@example.com</td>
                                    <td>8541234567</td>
                                    <td>MSc</td>
                                    <td>2022-12-01</td>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 4 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-4.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Michael Scott</span>
                                      </div>
                                    </td>
                                    <td>Male</td>
                                    <td>Sales</td>
                                    <td>michael.scott@example.com</td>
                                    <td>9456781230</td>
                                    <td>MBA</td>
                                    <td>2024-01-10</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 5 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-5.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Pam Beesly</span>
                                      </div>
                                    </td>
                                    <td>Female</td>
                                    <td>Marketing</td>
                                    <td>pam.beesly@example.com</td>
                                    <td>9321459876</td>
                                    <td>BA</td>
                                    <td>2023-02-25</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 6 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-1.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Dwight Schrute</span>
                                      </div>
                                    </td>
                                    <td>Male</td>
                                    <td>Logistics</td>
                                    <td>dwight.schrute@example.com</td>
                                    <td>9547896312</td>
                                    <td>BSc</td>
                                    <td>2023-05-15</td>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 7 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-2.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Angela Martin</span>
                                      </div>
                                    </td>
                                    <td>Female</td>
                                    <td>Finance</td>
                                    <td>angela.martin@example.com</td>
                                    <td>9876547890</td>
                                    <td>CA</td>
                                    <td>2022-11-20</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 8 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-3.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Jim Halpert</span>
                                      </div>
                                    </td>
                                    <td>Male</td>
                                    <td>Sales</td>
                                    <td>jim.halpert@example.com</td>
                                    <td>9658745898</td>
                                    <td>BCom</td>
                                    <td>2023-07-01</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 9 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-4.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Ryan Howard</span>
                                      </div>
                                    </td>
                                    <td>Male</td>
                                    <td>Operations</td>
                                    <td>ryan.howard@example.com</td>
                                    <td>9541234567</td>
                                    <td>MBA</td>
                                    <td>2023-06-10</td>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                  </tr>
                                  <!-- Row 10 -->
                                  <tr>
                                    <td><input type="checkbox" class="custom-checkbox row-checkbox"></td>
                                    <td>
                                      <div class="d-flex justify-content-start align-items-center">
                                        <img src="./assets/images/avatar-5.jpg" class="tbl-img" alt="">
                                        <span class="ms-2">Kelly Kapoor</span>
                                      </div>
                                    </td>
                                    <td>Female</td>
                                    <td>Customer Support</td>
                                    <td>kelly.kapoor@example.com</td>
                                    <td>9874563210</td>
                                    <td>BCA</td>
                                    <td>2024-02-05</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td class="text-center">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#EditModal" class="btn btn-sm btn-primary mb-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                      <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
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
         