<?php
session_start();
include('includes/dbconn.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: adminlogin.php');
    exit;
}
include('includes/header.php');
include('includes/sidebar.php');
$result = $mysqli->query("
    SELECT u.id, u.name, u.email, p.route
    FROM users u
    LEFT JOIN (
        SELECT * FROM passes 
        WHERE id IN (
            SELECT MAX(id) FROM passes GROUP BY user_id
        )
    ) p ON u.id = p.user_id
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin-top: 70px;
        }
        .card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }
        h2 {
            font-weight: bold;
            color: #2c3e50;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-primary, .btn-danger {
            border-radius: 20px;
        }
        .btn-secondary {
            border-radius: 20px;
        }
        .text-end a {
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">👥 Manage Registered Users</h2>
    <div class="card shadow-lg">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Route</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $serial = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="text-center"><?= $serial++ ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= $row['route'] ? htmlspecialchars($row['route']) : '<span class="text-muted">No Pass Applied</span>' ?></td>
                            <td class="text-center">
                                <a href="view_user_pass.php?user_id=<?= $row['id'] ?>" class="btn btn-sm btn-primary me-2">View Pass</a>
                                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-end">
                <a href="adminpage.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
</body>
</html>