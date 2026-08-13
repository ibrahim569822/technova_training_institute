<?php
    session_start();
    $base_url = "http://172.16.20.143/technova_training_institute/";
    require_once  ($_SERVER['DOCUMENT_ROOT'] . "/technova_training_institute/crud/crud_class.php");
    $crud = new crud_class();
?>