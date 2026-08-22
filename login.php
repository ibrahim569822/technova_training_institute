<?php require_once "component/header_auth.php"; ?>
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-11 col-sm-8 col-md-8 col-lg-4">
                <div class="bg-white rounded-4 shadow-sm p-4">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <a href="<?php echo $base_url; ?>dashboard.php"><img src="<?php echo $base_url; ?>assets/images/logo.png" alt="logo" width="100%" height="50"></a>
                        </div>
                    </div>

                    <!-- Sign In Form -->
                    <h2 class="mb-4 text-dark h4">Sign In</h2>
                    <form action="" method="POST">
                        <!-- Email Input -->
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label text-muted small">Email</label>
                            <div class="position-relative">
                                <input name="email" type="email" class="form-control form-control-lg rounded-3" 
                                       id="email" placeholder="example@outlook.com">
                                <i class="fas fa-envelope input-icon"></i>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4 position-relative">
                            <label for="password" class="form-label text-muted small">Password</label>
                            <div class="position-relative">
                                <input name="password" type="password" class="form-control form-control-lg rounded-3" 
                                       id="password" placeholder="••••••••">
                                <i class="fas fa-lock input-icon"></i>
                            </div>
                        </div>

                        <div class="row mb-4">
                            
                            <div class="col-12 col-lg-6 text-lg-end">
                                <a href="<?php echo $base_url; ?>forgot-password.php" class="text-primary">Forgot password</a>
                            </div>
                        </div>


                        <!-- Sign In Button -->
                        <button type="submit" class="btn btn-signin btn-lg w-100 rounded-3 mb-4">
                            Sign In
                        </button>

                        <!-- Divider -->
                        <div class="text-center text-muted mb-4 text-size-14">
                             Don't have an account yet? <a href="<?php echo $base_url; ?>signup.php" class="text-primary">Sign Up</a>
                        </div>
                    </form>
                    <?php
                    if ($_POST) {
                        $_POST['password'] = sha1($_POST['password']);

                        // Prepare and execute the SQL statement
                        $rs = $crud->common_query("
                                                    SELECT 
                                                    users.*, roles.role_name, roles.access
                                                    FROM `users`
                                                    join roles on roles.id=users.role_id
                                                    WHERE
                                                    users.email = '{$_POST['email']}'
                                                    AND
                                                    users.password = '{$_POST['password']}'
                                                ");

                        if ($rs['status']) {
                            // User found, set session variables
                            $user = $rs['data'][0];
                            $_SESSION['user_id'] = $user->id; // Store user ID in session
                            $_SESSION['user_name'] = $user->full_name; // Store user name in session
                            $_SESSION['user_email'] = $user->email; // Store user email in session
                            $_SESSION['user_phone'] = $user->phone; // Store user phone in session
                            $_SESSION['user_role'] = $user->role_name; // Store user role in session
                            $_SESSION['access'] = $user->access; // Store user access in session
                            $_SESSION['is_logged_in'] = true; // Set a flag to indicate the user is logged in
                            // Redirect to dashboard or home page
                            echo '<script>window.location.href = "index.php";</script>';
                        } else {
                            echo '<div class="alert alert-danger">Invalid email or password.</div>';
                        }

                        
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once "component/footer.php" ?>