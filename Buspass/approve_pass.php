<?php
session_start();
include('includes/dbconn.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: adminlogin.php');
    exit;
}

$passId = intval($_GET['id']);  // This is the 'id' from the 'passes' table
$action = $_GET['action'];

if ($action === 'approve') {
    // Generate new pass ID
    $prefix = 'PASS';
    $year = date('Y');

    $result = $mysqli->query("SELECT pass_id FROM passes WHERE pass_id IS NOT NULL ORDER BY id DESC LIMIT 1");
    $lastNum = 1;

    if ($result && $row = $result->fetch_assoc()) {
        preg_match('/(\d+)$/', $row['pass_id'], $matches);
        $lastNum = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
    }

    $newPassId = $prefix . $year . str_pad($lastNum, 3, '0', STR_PAD_LEFT);

    // Now update both status and pass_id
    $stmt = $mysqli->prepare("UPDATE passes SET status='Approved', pass_id=? WHERE id=?");
    $stmt->bind_param("si", $newPassId, $passId);

} else {
    // Rejection case
    $status = 'Rejected';
    $stmt = $mysqli->prepare("UPDATE passes SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $passId);
}

// Execute the query
if ($stmt->execute()) {
    echo "<script>alert('Pass $action successfully'); window.location='adminpage.php';</script>";
} else {
    echo "<script>alert('Failed to update pass status'); window.location='adminpage.php';</script>";
}
?>
