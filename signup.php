<?php require_once "component/header_auth.php"; ?>
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-11 col-sm-8 col-md-6 col-lg-4">
                <div class="bg-white rounded-4 shadow-sm p-4">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <a href="login.html"><img src="assets/images/logo.png" alt="logo"></a>
                        </div>
                    </div>

                    <!-- Sign In Form -->
                    <h2 class="mb-4 text-dark h4">Sign Up</h2>
                    <form action="" method="POST">

                        <!-- Name Input -->
                        <div class="mb-3 position-relative">
                            <label for="name" class="form-label text-muted small">Name</label>
                            <div class="position-relative">
                                <input required name="full_name" type="text" class="form-control form-control-lg rounded-3" 
                                       id="name" placeholder="Rogger">
                                <i class="fas fa-user input-icon"></i>
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label text-muted small">Email</label>
                            <div class="position-relative">
                                <input required name="email" type="email" class="form-control form-control-lg rounded-3" 
                                       id="email" placeholder="example@outlook.com">
                                <i class="fas fa-envelope input-icon"></i>
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="phone" class="form-label text-muted small">Phone</label>
                            <div class="position-relative">
                                <input required name="phone" type="tel" class="form-control form-control-lg rounded-3" 
                                       id="phone" placeholder="123-456-7890">
                                <i class="fas fa-phone input-icon"></i>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4 position-relative">
                            <label for="password" class="form-label text-muted small">Password</label>
                            <div class="position-relative">
                                <input required name="password" type="password" class="form-control form-control-lg rounded-3" placeholder="••••••••" id="password">
                                <i class="fas fa-lock input-icon"></i>
                            </div>
                        </div>

                        
                        <!-- Sign In Button -->
                        <button type="submit" class="btn btn-signin btn-lg w-100 rounded-3 mb-4">
                            Sign Up
                        </button>

                        <!-- Divider -->
                        <div class="text-center text-muted mb-4 text-size-14">
                            You have an account? <a href="login.html" class="text-primary">Login</a>
                        </div>
                    </form>
                    <?php
                    if ($_POST) {
                       
                        $_POST['password'] = sha1($_POST['password']);
                        $_POST['role_id'] = '1'; 

                        // Validate input
                        if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password'])) {
                            $_SESSION['message'] = array('danger','Error', 'All fields are required.');
                        } else {
                          
                            // check if the email already exists in the database
                            $existingUser = $crud->common_query("SELECT * FROM users WHERE email = '{$_POST['email']}'");
                            if ($existingUser['status'] && count($existingUser['data']) > 0) {
                                 $_SESSION['message'] = array('danger','Error', 'Email already exists. Please use a different email.');
                            } else {
                                // Prepare and execute the SQL statement
                                $rs = $crud->common_insert("users", $_POST);
                                
                                if ($rs['status']) {
                                    $_SESSION['message'] = array('success','Success', 'Registration successful! You can now login.');
                                    echo '<script>window.location.href = "login.php";</script>';
                                
                                } else {
                                    $_SESSION['message'] = array('danger','Error', 'Registration failed. Please try again.');
                                    echo '<script>window.location.href = "signup.php";</script>';
                                }
                            }
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
<?php require_once "component/footer.php" ?>