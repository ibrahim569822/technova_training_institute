<!-- Main Wrapper -->
    <div id="main-wrapper" class="d-flex">
        <div class="sidebar no-print">
                <!-- Sidebar -->
               <div class="sidebar-header">
                   <div class="lg-logo"><a href="<?php echo $base_url; ?>dashboard.php"><img src="<?php echo $base_url; ?>assets/images/logo.png" alt="logo large" width="100%" height="50"></a></div>
                   <div class="sm-logo"><a href="<?php echo $base_url; ?>dashboard.php"><img src="<?php echo $base_url; ?>assets/images/small_logo.png" alt="logo small" width="100%" height="50"></a></div>
               </div>
               <div class="sidebar-body  custom-scrollbar">
                    <ul class="sidebar-menu">
                        <li><a href="<?php echo $base_url; ?>dashboard.php" class=" sidebar-link active"><i class="fa-solid fa-house"></i><p>Dashboard</p></a></li>
                        <li><a href="<?php echo $base_url; ?>exam/exam.php" class="sidebar-link"><i class="fa-brands fa-discourse"></i><p>Exams</p></a></li>
                    </ul>
               </div>
        </div>
       <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Header -->
            <div class="no-print header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="collapse-sidebar me-3 d-none d-lg-block text-color-1"><span><i class="fa-solid fa-bars font-size-24"></i></span></div>
                    <div class="menu-toggle me-3 d-block d-lg-none text-color-1"><span><i class="fa-solid fa-bars font-size-24"></i></span></div>
                    <div class="d-none d-md-block d-lg-block">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text bg-white " id="addon-wrapping"><i class="fa-solid search-icon fa-magnifying-glass text-color-1"></i></span>
                            <input type="text" class="form-control search-input border-l-none ps-0" placeholder="Search anything" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <ul class="nav d-flex align-items-center">
                      
                         <!-- User Profile -->
                        <li class="nav-item dropdown user-profile">
                            <div class="d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="user-avatar me-0 me-lg-3">A</span>
                                <div>
                                    <a href="#" class="d-none d-lg-block">
                                        <span class="d-block auth-role">Student</span>
                                        <span class="auth-name"><?= $_SESSION['user_name']; ?></span>
                                        <span class="ms-2 text-color-1 text-size-sm"><i class="fa-solid fa-angle-down"></i></span>
                                    </a>
                                    <ul class="dropdown-menu mt-3">
                                        <li><a class="dropdown-item" href="#">Profile</a></li>
                                        <li><a class="dropdown-item" href="#">Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" onclick="logout()" href="#">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
