<?php
    require_once "../component/connection.php";

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/uploads/courses/images/';
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

        $result = $crud->common_insert("courses", $_POST);
        if ($result['status']) {
            $_SESSION['message'] = array('success','Success', $result['message']);
        } else {
            $_SESSION['message'] = array('danger','Error', $result['message']);
        }

        echo "<script>window.location.href = '".$base_url."courses/courselist.php';</script>";
    