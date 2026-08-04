<?php
    require_once "../../component/connection.php";


        $result = $crud->common_insert("categories", $_POST);
        if ($result['status']) {
            $_SESSION['message'] = array('success','Success', $result['message']);
        } else {
            $_SESSION['message'] = array('danger','Error', $result['message']);
        }

        echo "<script>window.location.href = '".$base_url."courses/categories/list.php';</script>";
    