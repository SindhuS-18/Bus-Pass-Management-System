<?php
session_start();
include('includes/dbconn.php');
if (!isset($_SESSION['admin_id'])) {
    header('Location: adminlogin.php');
    exit;
}
$result1 = $mysqli->query("SELECT COUNT(*) AS total_users FROM users");
$result2 = $mysqli->query("SELECT COUNT(*) AS total_passes FROM passes");
$result3 = $mysqli->query("SELECT COUNT(*) AS approved FROM passes WHERE status='Approved'");
$result4 = $mysqli->query("SELECT COUNT(*) AS pending FROM passes WHERE status='Pending'");
$result5 = $mysqli->query("SELECT COUNT(*) AS rejected FROM passes WHERE status='Rejected'");
$data1 = $result1->fetch_assoc();
$data2 = $result2->fetch_assoc();
$data3 = $result3->fetch_assoc();
$data4 = $result4->fetch_assoc();
$data5 = $result5->fetch_assoc();
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>
<!DOCTYPE html>
<head>
    <title>Admin Dashboard - Bus Pass System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }
        .stat-card {
            transition: transform 0.2s ease;
            cursor: pointer;
        }
        .stat-card:hover {
            transform: scale(1.03);
        }
        #details-section {
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="text-center text-primary mb-5">Welcome, Admin</h2>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card text-white bg-primary stat-card p-3" data-type="users">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text fs-3"><?= $data1['total_users'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success stat-card p-3" data-type="passes">
                <div class="card-body">
                    <h5 class="card-title">Total Pass Applications</h5>
                    <p class="card-text fs-3"><?= $data2['total_passes'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info stat-card p-3" data-type="approved">
                <div class="card-body">
                    <h5 class="card-title">Approved</h5>
                    <p class="card-text fs-3"><?= $data3['approved'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-warning stat-card p-3" data-type="pending">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text fs-3"><?= $data4['pending'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger stat-card p-3" data-type="rejected">
                <div class="card-body">
                    <h5 class="card-title">Rejected</h5>
                    <p class="card-text fs-3"><?= $data5['rejected'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <div id="details-section" class="mt-5"></div>
    <div class="text-center mt-4">
        <a href="manage_users.php" class="btn btn-dark">Manage Users</a>
        <a href="logout.php" class="btn btn-outline-danger ms-3">Logout</a>
    </div>
</div>
<?php include('includes/footer.php'); ?>
<script>
$(document).ready(function () {
    $('.stat-card').click(function () {
        const type = $(this).data('type');
        $.ajax({
            url: 'fetch_data.php',
            method: 'POST',
            data: { type: type },
            success: function (data) {
                $('#details-section').html(data);
            }
        });
    });
    $(document).on('click', '.approve-btn, .reject-btn', function () {
        const passId = $(this).data('id');
        const action = $(this).hasClass('approve-btn') ? 'Approved' : 'Rejected';
        $.ajax({
            url: 'update_pass_status.php',
            method: 'POST',
            data: { id: passId, status: action },
            success: function (response) {
                alert(response);
                $('.stat-card[data-type="pending"]').click(); // Refresh pending list
            }
        });
    });
});
</script>
</body>
</html>
