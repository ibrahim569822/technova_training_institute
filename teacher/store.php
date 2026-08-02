<?php
require_once "../component/connection.php";
// add database transaction
 $crud->conn->begin_transaction();

$users['full_name'] = $_POST['full_name'];
$users['email'] = $_POST['email'];
$users['phone'] = $_POST['phone'];
$users['role_id'] = 3;
$users['status'] = $_POST['status'];
$users['password'] = sha1($_POST['password']);
$result = $crud->common_insert("users", $users);
if ($result['status']) {

    $trainers['user_id'] = $result['data'];
    $trainers['dob'] = $_POST['dob'];
    $trainers['joining_date'] = $_POST['joining_date'];
    $trainers['gender'] = $_POST['gender'];
    $trainers['address'] = $_POST['address'];
    $trainers['qualification'] = $_POST['qualification'];
    $trainers['specialization'] = $_POST['specialization'];
    $trainers['experience'] = $_POST['experience'];
    $trainers['salary'] = $_POST['salary'];
    $trainers['created_by'] = $_SESSION['user_id'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/trainers/images/';
        // check if the directory exists, if not create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = rand(1, 999999) . time() . '_' . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $trainers['image'] = $imageName;
        } else {
            echo "Error uploading file.";
            exit;
        }
    } else {
        $trainers['image'] = null; // No file uploaded
    }

    $result = $crud->common_insert("trainers", $trainers);
    if ($result['status']) {
        $crud->conn->commit();
        $_SESSION['message'] = array('success', 'Success', $result['message']);
    } else {
        $crud->conn->rollback();
        $_SESSION['message'] = array('danger', 'Error', $result['message']);
    }
}else{
    $_SESSION['message'] = array('danger', 'Error', $result['message']);
}

echo "<script>window.location.href = '" . $base_url . "teacher/list.php';</script>";
