<?php
session_start();
include('includes/dbconn.php');

// Simple admin check (customize as needed)
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login first.");
}

// Fetch all users
$result = $mysqli->query("SELECT id, email FROM users ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Users List</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="delete_user.php?id=<?= $user['id'] ?>" 
                           onclick="return confirm('Are you sure you want to delete this user?');" 
                           class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
