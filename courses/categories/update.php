<?php
    require_once "../../component/connection.php";

    $id = $_POST['id'];

        $result = $crud->common_update("categories", $_POST, ['id' => $id]);
        if ($result['status']) {
            $_SESSION['message'] = array('success','Success', $result['message']);
        } else {
            $_SESSION['message'] = array('danger','Error', $result['message']);
        }

        echo "<script>window.location.href = '".$base_url."categories/list.php';</script>";
    