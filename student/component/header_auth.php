<?php
    require_once "component/connection.php";
    if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
        echo "<script>window.location='{$base_url}dashboard.php'</script>";
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
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/icons/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="../assets/icons/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="../assets/icons/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Preloader -->
    <!-- <div id="preloader">
        <div class="spinner"></div>
    </div> -->
    