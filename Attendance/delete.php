```php
<?php

require_once "../config/database.php";

$id = $_GET['id'] ?? 0;

if ($id > 0) {

    $result = $crud->common_delete(
        "attendance",
        ['id' => $id]
    );

    if ($result['status']) {

        $_SESSION['message'] = array(
            'success',
            'Success',
            'Attendance deleted successfully.'
        );

    } else {

        $_SESSION['message'] = array(
            'danger',
            'Error',
            $result['message']
        );
    }
}

echo "<script>
window.location.href = '" . $base_url . "attendance/list.php';
</script>";

exit;
?>
```