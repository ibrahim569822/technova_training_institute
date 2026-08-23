<?php
require_once "../component/connection.php";


$Cert_data['trainee_id'] = $_POST['trainee_id'];
$Cert_data['course_id'] = $_POST['course_id'];
$Cert_data['batch_id'] = $_POST['batch_id'];
$Cert_data['certificate_no'] = $_POST['certificate_no'];
$Cert_data['issue_date'] = $_POST['issue_date'];
$Cert_data['status'] = $_POST['status'];
$result = $crud->common_update("certificates", $Cert_data, ['certificate_id' => $_POST['certificate_id']]);

echo "<script>window.location.href = '" . $base_url . "certificates/list.php';</script>";