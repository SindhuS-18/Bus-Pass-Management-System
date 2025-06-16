<?php
session_start();
include('includes/dbconn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['edit_id'])) {
    echo "<script>alert('No pass ID provided.'); window.location.href='delete_pass.php';</script>";
    exit;
}

$edit_id = intval($_GET['edit_id']);

// Fetch pass
$stmt = $mysqli->prepare("SELECT * FROM passes WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $edit_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Pass not found or access denied.'); window.location.href='delete_pass.php';</script>";
    exit;
}

$pass = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $route = $_POST['route'];
    $duration = $_POST['duration'];

    $update = $mysqli->prepare("UPDATE passes SET route = ?, duration = ? WHERE id = ? AND user_id = ?");
    $update->bind_param("ssii", $route, $duration, $edit_id, $user_id);

    if ($update->execute()) {
        echo "<script>alert('Pass updated successfully'); window.location.href='delete_pass.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to update pass');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pass</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .container { margin-top: 50px; max-width: 600px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Bus Pass</h2>
    <form method="POST">
        <div class="form-group">
            <label>Route</label>
            <input type="text" name="route" class="form-control" value="<?= htmlspecialchars($pass['route']) ?>" required>
        </div>
        <div class="form-group">
            <label>Duration</label>
            <input type="text" name="duration" class="form-control" value="<?= htmlspecialchars($pass['duration']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="delete_pass.php" class="btn btn-default">Cancel</a>
    </form>
</div>
</body>
</html>
