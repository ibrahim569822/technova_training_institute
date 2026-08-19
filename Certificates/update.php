<?php

require_once "../component/header.php";
require_once "../component/sidebar.php";

$id = $_POST['certificate_id'] ?? '';
$certificate_no = $_POST['certificate_no'] ?? '';
$issue_date = $_POST['issue_date'] ?? '';
$status = $_POST['status'] ?? 0;

if (
    empty($id) ||
    empty($certificate_no) ||
    empty($issue_date)
) {
    die("Required fields are missing.");
}

$certificate_no = $crud->conn->real_escape_string($certificate_no);
$issue_date = $crud->conn->real_escape_string($issue_date);
$status = (int) $status;
$id = (int) $id;

$query = "
    UPDATE certificates
    SET
        certificate_no = '$certificate_no',
        issue_date = '$issue_date',
        status = '$status'
    WHERE certificate_id = '$id'
";

$result = $crud->common_query($query);

if ($result['status']) {

    echo "<script>
        window.location.href = 'index.php?updated=1';
    </script>";

    exit;
}

die("Certificate update failed.");

?>

<?php require_once "../component/footer.php"; ?>