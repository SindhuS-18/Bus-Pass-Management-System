<?php
session_start();
include('includes/dbconn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $mysqli->real_escape_string($_POST['phone']);
    $address = $mysqli->real_escape_string($_POST['address']);
    $check = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful.'); window.location='userlogin.php';</script>";
        } else {
            echo "<script>alert('Registration failed.');</script>";
        }
    }
}
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration - GoPass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0,0,0,0.6)),
                        url('https://media.istockphoto.com/photos/white-bus-traveling-on-the-asphalt-road-in-a-rural-landscape-at-picture-id879364174?k=20&m=879364174&s=612x612&w=0&h=JJ90BcO8di7yr0EuHMelSZ3H8W6RGJ8fSgyBViPcP34=')
                        no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin-top: 80px;
        }
        h2 {
            font-weight: 600;
             color: #007bff;
        }
        .form-control {
            border-radius: 10px;
        }
        .mt-3.text-center {
            color: white;
        }
        .mt-3.text-center a {
            color: white;
            text-decoration: underline;
        }
        .mt-3.text-center a:hover {
            
            text-decoration: none;
        }
        .btn-primary {
            border-radius: 10px;
            padding: 10px 25px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h2 class="text-center mb-4">User Registration</h2>
                    <form name="registrationForm" action="register.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="address" class="form-control" rows="3" placeholder="Address" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Register Now</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <small>Already have an account? <a href="userlogin.php">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>
</body>
</html>