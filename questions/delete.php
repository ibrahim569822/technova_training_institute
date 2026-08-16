<?php
    require_once "../component/connection.php";

    //$result = $crud->common_delete("trainees", ['id' => $_GET['id']]);
    $result = $crud->common_update("questions", ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $_GET['id']]);
    if ($result['status']) {
        $_SESSION['message'] = array('success','Success', $result['message']);
    } else {
        $_SESSION['message'] = array('danger','Error', $result['message']);
    }

    echo "<script>window.location.href = '".$base_url."questions/list.php';</script>";
    