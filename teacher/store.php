<?php
    require_once "../component/connection.php";

        $_POST['password'] = sha1($_POST['password']);

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/uploads/trainees/images/';
            $imageName = rand(1, 999999). time() . '_' . basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $imageName ;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $_POST['image'] = $imageName;
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            $_POST['image'] = null; // No file uploaded
        }

        $result = $crud->common_insert("trainees", $_POST);
        if ($result['status']) {
            $_SESSION['message'] = array('success','Success', $result['message']);
        } else {
            $_SESSION['message'] = array('danger','Error', $result['message']);
        }

        echo "<script>window.location.href = '".$base_url."trainees/list.php';</script>";
    