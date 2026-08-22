<?php
    // Define a list of known local environments
    $local_hosts = ['localhost', '127.0.0.1', '::1'];

    if (in_array($_SERVER['HTTP_HOST'], $local_hosts) || in_array($_SERVER['REMOTE_ADDR'], $local_hosts)) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/technova_training_institute/student/component/connection.php";
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/student/component/connection.php";
    }

    
    if(!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']){
        echo "<script>window.location='{$base_url}login.php'</script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Technova Training Institute</title>
    <!-- Stylesheets -->
    <link rel="shortcut icon" href="<?= $base_url ?>../assets/images/favicon.ico" type="image/x-icon">
    <link href="<?= $base_url ?>../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>../assets/icons/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>../assets/icons/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>../assets/icons/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>../assets/css/style.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .main-content{
                margin: 0 !important;
                padding: 15px !important;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <!-- <div id="preloader">
        <div class="spinner"></div>
    </div> -->
    