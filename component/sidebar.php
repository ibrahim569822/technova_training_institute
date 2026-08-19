<!-- Main Wrapper -->
<div id="main-wrapper" class="d-flex">
    <div class="sidebar no-print">
        <!-- Sidebar -->
        <div class="sidebar-header">
            <div class="lg-logo"><a href="<?php echo $base_url; ?>dashboard.php"><img
                        src="<?php echo $base_url; ?>assets/images/logo.png" alt="logo large" width="100%"
                        height="50"></a></div>
            <div class="sm-logo"><a href="<?php echo $base_url; ?>dashboard.php"><img
                        src="<?php echo $base_url; ?>assets/images/small_logo.png" alt="logo small" width="100%"
                        height="50"></a></div>
        </div>
        <div class="sidebar-body  custom-scrollbar">
            <ul class="sidebar-menu">
                <li><a href="<?php echo $base_url; ?>dashboard.php" class=" sidebar-link active"><i
                            class="fa-solid fa-house"></i>
                        <p>Dashboard</p>
                    </a></li>
                <li><a href="<?php echo $base_url; ?>courses/courselist.php" class="sidebar-link"><i
                            class="fa-brands fa-discourse"></i>
                        <p>Courses</p>
                    </a></li>
                <li><a href="<?php echo $base_url; ?>trainees/list.php" class=" sidebar-link"><i
                            class="fa-solid fa-user"></i>
                        <p>Students</p>
                    </a></li>
                <li><a href="<?php echo $base_url; ?>teacher/list.php" class=" sidebar-link"><i
                            class="fa-solid fa-chalkboard-user"></i>
                        <p>Teachers</p>
                    </a></li>
                <li><a href="<?php echo $base_url; ?>batches/list.php" class="sidebar-link"><i
                            class="fa-solid fa-layer-group"></i>
                        <p>Batches</p>
                    </a></li>
                <li><a href="<?php echo $base_url; ?>attendance/list.php" class="sidebar-link"><i
                            class="fa-solid fa-calendar-check"></i>
                        <p>Attendance</p>
                    </a></li>
                <li><a href="<?php echo $base_url; ?>Certificates/list.php" class="sidebar-link"><i
                            class="fa-solid fa-calendar-check"></i>
                        <p>Certificates</p>
                    </a></li>
                <li>
                    <a href="<?php echo $base_url; ?>enrollments/list.php" class="sidebar-link">
                        <i class="fa-solid fa-user-graduate"></i>
                        <p>Enrollments</p>
                        <?php
                        $enroll_count = $crud->common_query("SELECT COUNT(*) as total FROM enrollments WHERE status = 0 AND deleted_at IS NULL");
                        $count = $enroll_count['data'][0]->total ?? 0;
                        if ($count > 0) {
                            echo '<span class="badge bg-danger rounded-pill ms-auto">' . $count . '</span>';
                        }
                        ?>
                    </a>
                </li>
                <li><a href="<?php echo $base_url; ?>invoices/list.php" class="sidebar-link"><i
                            class="fa-solid fa-file-invoice"></i>
                        <p>Invoices</p>
                    </a></li>
                <!--
                        <li><a href="<?php echo $base_url; ?>library.php" class=" sidebar-link"><i class="fa-solid fa-book"></i><p>Library</p></a></li>
                        <li><a href="<?php echo $base_url; ?>department.php" class=" sidebar-link"><i class="fa-solid fa-building"></i><p>Department</p></a></li>
                        <li><a href="<?php echo $base_url; ?>staff.php" class="sidebar-link"><i class="fa-solid fa-users"></i><p>Staff</p></a></li>
                        <li><a href="<?php echo $base_url; ?>fees.php" class="sidebar-link"><i class="fa-solid fa-dollar-sign"></i><p>Fees</p></a></li>
                        <li><a href="#" class=" sidebar-link submenu-parent"><i class="fa-solid fa-list"></i><p>Pages <i class="fa-solid fa-chevron-right right-icon"></i></p></a>
                            <ul class="sidebar-submenu">
                                <li><a href="<?php echo $base_url; ?>login.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">Login</p></a></li>
                                <li><a href="<?php echo $base_url; ?>signup.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">Register</p></a></li>
                                <li><a href="<?php echo $base_url; ?>forgot-password.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">Forgot password</p></a></li>
                                <li><a href="<?php echo $base_url; ?>404.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">404 page</p></a></li>
                                <li><a href="<?php echo $base_url; ?>500.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">500 page</p></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class=" sidebar-link submenu-parent"><i class="fa-solid fa-list"></i><p>Table <i class="fa-solid fa-chevron-right right-icon"></i></p></a>
                            <ul class="sidebar-submenu">
                                <li><a href="<?php echo $base_url; ?>table-bootstrap.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">Bootstrap</p></a></li>
                                <li><a href="<?php echo $base_url; ?>data-table.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">DataTable</p></a></li>
                            </ul>
                        </li>
                        <li><a href="#" class=" sidebar-link submenu-parent"><i class="fa-solid fa-list"></i><p>Components <i class="fa-solid fa-chevron-right right-icon"></i></p></a>
                            <ul class="sidebar-submenu">
                                <li><a href="<?php echo $base_url; ?>form.php" class="submenu-link"><i class="fa-solid fa-circle me-4 font-size-12"></i><p class="m-0">Form Element</p></a></li>
                            </ul>
                        </li>-->
            </ul>
        </div>
    </div>
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Header -->
        <div class="no-print header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="collapse-sidebar me-3 d-none d-lg-block text-color-1"><span><i
                            class="fa-solid fa-bars font-size-24"></i></span></div>
                <div class="menu-toggle me-3 d-block d-lg-none text-color-1"><span><i
                            class="fa-solid fa-bars font-size-24"></i></span></div>
                <div class="d-none d-md-block d-lg-block">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text bg-white " id="addon-wrapping"><i
                                class="fa-solid search-icon fa-magnifying-glass text-color-1"></i></span>
                        <input type="text" class="form-control search-input border-l-none ps-0"
                            placeholder="Search anything" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <ul class="nav d-flex align-items-center">

                    <!-- User Profile -->
                    <li class="nav-item dropdown user-profile">
                        <div class="d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="user-avatar me-0 me-lg-3">A</span>
                            <div>
                                <a href="#" class="d-none d-lg-block">
                                    <span class="d-block auth-role"><?= $_SESSION['user_role']; ?></span>
                                    <span class="auth-name"><?= $_SESSION['user_name']; ?></span>
                                    <span class="ms-2 text-color-1 text-size-sm"><i
                                            class="fa-solid fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu mt-3">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" onclick="logout()" href="#">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>