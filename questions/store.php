<?php
    require_once "../component/connection.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $result = $crud->common_insert("questions", $_POST);
        var_dump($_POST); // Debugging line to check the POST data
        var_dump($result); // Debugging line to check the result of the insert operation
        if ($result['status']) {
            $_SESSION['message'] = array('success','Success', $result['message']);
        } else {
            $_SESSION['message'] = array('danger','Error', $result['message']);
        }

        echo "<script>window.location.href = '".$base_url."questions/list.php';</script>";
    }
    