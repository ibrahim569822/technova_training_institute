<?php
session_start();
$base_url = "http://localhost/technova_training_institute/";
require_once($_SERVER['DOCUMENT_ROOT'] . "/technova_training_institute/crud/crud_class.php");
$crud = new crud_class();
?>