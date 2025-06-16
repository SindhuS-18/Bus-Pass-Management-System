<?php
session_start();
include('includes/dbconn.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminUser = $mysqli->real_escape_string(trim($_POST['username']));
    $adminPass = md5(trim($_POST['password'])); // Note: Use password_hash() in production for better security
    $loginQuery = $mysqli->prepare("SELECT id FROM admin WHERE username = ? AND password = ?");
    $loginQuery->bind_param("ss", $adminUser, $adminPass);
    $loginQuery->execute();
    $loginQuery->bind_result($adminId);
    $loginQuery->fetch();
    if ($adminId) {
        $_SESSION['admin_id'] = $adminId;
        echo "<script>alert('Welcome, Admin!'); window.location='adminpage.php';</script>";
    } else {
        echo "<script>alert('Invalid login. Please try again.');</script>";
    }
    $loginQuery->close();
}
include('includes/header.php');
include('includes/sidebar.php');
?>
<!DOCTYPE html>
<head>
    <title>Admin Login - GoPass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', sans-serif;
        }
        body {
            display: flex;
            background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('https://media.istockphoto.com/photos/white-bus-traveling-on-the-asphalt-road-in-a-rural-landscape-at-picture-id879364174?k=20&m=879364174&s=612x612&w=0&h=JJ90BcO8di7yr0EuHMelSZ3H8W6RGJ8fSgyBViPcP34=') no-repeat center center fixed;
            background-size: cover;
        }
        

        .content {
            margin-left: 200px;
            width: calc(100% - 250px);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 0%;
            min-height: 100vh;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 400px;
            color: white;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.25);
            color: #fff;
            box-shadow: none;
        }
        .btn-primary {
            width: 100%;
            border-radius: 8px;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="card">
            <h3 class="text-center">Admin Login</h3>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Admin Name</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter admin name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
            </form>
        </div>
    </div>
<?php include('includes/footer.php'); ?>
</body>
</html>