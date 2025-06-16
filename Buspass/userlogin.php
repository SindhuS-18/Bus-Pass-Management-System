<?php
session_start();
include('includes/dbconn.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();
    if ($id && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        echo "<script>alert('Login successful'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Login - GoPass</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0,0,0,0.7)),
        url('https://media.istockphoto.com/photos/white-bus-traveling-on-the-asphalt-road-in-a-rural-landscape-at-picture-id879364174?k=20&m=879364174&s=612x612&w=0&h=JJ90BcO8di7yr0EuHMelSZ3H8W6RGJ8fSgyBViPcP34=') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
    }
    .login-card {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 500px;
    }
    .form-label {
      font-weight: 500;
      color: #fff; 
    }
    .login-card input.form-control {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff; 
      border: none;
    }
    .login-card input::placeholder {
      color: rgba(255, 255, 255, 0.7); 
    }
    .login-card small,
    .login-card a {
      color: #fff !important; 
    }
    .btn-primary {
      border-radius: 10px;
      font-size: 16px;
      padding: 10px 0;
    }
    .login-title {
      font-weight: 600;
      color: #007bff;
    }
   .form-control {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: 1px solid #ccc;
    }
    .form-control::placeholder {
      color: #eee;
    }
    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.25);
      color: #fff;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-start align-items-center h-100" style="padding-left: 150px;">
    <div class="login-card" style="margin-left: 200px;">
      <h3 class="text-center login-title mb-4">User Login</h3>
      <form method="POST" action="userlogin.php">
        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input type="email" name="email" class="form-control" required />
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required />
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
      <div class="mt-3 text-center">
        <small>Don't have an account? <a href="register.php">Register here</a></small>
      </div>
    </div>
  </div>
</body>
</html>