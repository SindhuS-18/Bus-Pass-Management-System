<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: userlogin.php');
    exit;

}
include('includes/header.php');
include('includes/sidebar.php');
?>
<!DOCTYPE html>
<head>
    <title>User Dashboard - Bus Pass System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('https://diganthtoursandtravels.in/wp-content/uploads/2022/07/Resizer_166070607632715.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            display: flex;
        }

        .content {
            margin-left: 250px; /* space for sidebar */
            width: calc(100% - 250px);
            display: flex;
            justify-content: flex-start; /* align to the left */
            align-items: center;
            height: 100vh;
            padding-left: 5%; /* adjust this value for fine-tuning */
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 480px;
            width: 100%;
        }

        h2 {
            font-weight: 600;
            font-size: 28px;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .dashboard-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px 20px;
            margin-bottom: 18px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            color: #fff;
            background: linear-gradient(135deg, #3498db, #2980b9);
        }

        .dashboard-links a.logout-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }

        .dashboard-links a i {
            font-size: 20px;
        }

        .dashboard-links a:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            opacity: 0.95;
        }

        footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #e0e0e0;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;       /* Full height */
            width: 250px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding-top: 20px;
            overflow-y: auto;
        }

    </style>
</head>
<body>
    <div class="content">
        <div class="dashboard-container">
            <h2>Welcome, Bus Pass User!</h2>
            <div class="dashboard-links">
                <a href="apply_pass.php"><i class="bi bi-plus-circle-fill"></i> Apply for Bus Pass</a>
                <a href="view_pass.php"><i class="bi bi-card-checklist"></i> View Your Pass</a>
                <a href="logout.php" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
