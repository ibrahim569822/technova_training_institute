<?php
    require_once "../component/connection.php";

    $id = $_POST['id'];

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $_POST['password'] = sha1($_POST['password']);
        } else {
            unset($_POST['password']); // Remove password from POST data if it's empty
        }
      

        // Handle file upload
        if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
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
            unset($_POST['image']);
        }

        $result = $crud->common_update("trainees", $_POST, ['id' => $id]);
        if ($result['status']) {
            $_SESSION['message'] = array('success','Success', $result['message']);
        } else {
            $_SESSION['message'] = array('danger','Error', $result['message']);
        }

        echo "<script>window.location.href = '".$base_url."trainees/list.php';</script>";
    