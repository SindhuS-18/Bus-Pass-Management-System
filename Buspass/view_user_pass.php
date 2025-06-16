<?php
session_start();
include('includes/dbconn.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: adminlogin.php');
    exit;
}
if (!isset($_GET['user_id'])) {
    die("User ID is missing.");
}
$user_id = intval($_GET['user_id']);
$result = $mysqli->query("
    SELECT u.name, u.email, u.phone, p.id AS pass_id, p.route, p.duration, p.apply_date, p.start_date, p.status, p.cost
    FROM users u
    LEFT JOIN passes p ON u.id = p.user_id
    WHERE u.id = $user_id
");
if (!$result || $result->num_rows == 0) {
    die("No user/pass found.");
}
include('includes/header.php');
include('includes/sidebar.php');
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Pass Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: 50px auto;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">User Pass Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Name</th>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                    </tr>
                    <tr>
                        <th>Pass ID</th>
                        <td><?= htmlspecialchars($user['pass_id'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th>Route</th>
                        <td><?= htmlspecialchars($user['route'] ?? 'Not Applied') ?></td>
                    </tr>
                    <tr>
                        <th>Duration</th>
                        <td><?= htmlspecialchars($user['duration'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th>Apply Date</th>
                        <td><?= htmlspecialchars($user['apply_date'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td><?= htmlspecialchars($user['start_date'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th>Cost</th>
                        <td><?= isset($user['cost']) ? '₹' . htmlspecialchars($user['cost']) : '-' ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php 
                                $status = $user['status'] ?? '-';
                                $badgeColor = match($status) {
                                    'Approved' => 'success',
                                    'Pending' => 'warning',
                                    'Rejected' => 'danger',
                                    default => 'secondary'
                                };
                            ?>
                            <span class="badge bg-<?= $badgeColor ?>"><?= htmlspecialchars($status) ?></span>
                        </td>
                    </tr>
                </table>
                <div class="text-end">
                    <a href="manage_users.php" class="btn btn-outline-secondary">⬅ Back to Users</a>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>
</body>
</html>