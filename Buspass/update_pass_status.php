<?php
include('includes/dbconn.php');

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $stmt = $mysqli->prepare("UPDATE passes SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    echo "Pass ID $id has been marked as $status.";
}
?>
