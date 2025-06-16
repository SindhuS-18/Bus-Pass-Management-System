<?php
session_start();
include('includes/dbconn.php'); 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];
    $stmt = $mysqli->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $msg);
    $stmt->execute();
    if ($stmt) {
        echo "<script>alert('Thank you for your message!');</script>";
    } else {
        echo "<script>alert('Failed to save message');</script>";
    }
}
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://media.istockphoto.com/photos/white-bus-traveling-on-the-asphalt-road-in-a-rural-landscape-at-picture-id879364174?k=20&m=879364174&s=612x612&w=0&h=JJ90BcO8di7yr0EuHMelSZ3H8W6RGJ8fSgyBViPcP34=') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
        }
        .form-container {
            background: rgb(255 255 255 / 0.15);
            backdrop-filter: blur(12px);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgb(0 0 0 / 0.3);
            color: #fff;
            max-width: 500px;
            width: 100%;
            margin: 50px auto;  
            text-align: center;
        }
        .form-container h2 {
            font-size: 32px;
            margin-bottom: 30px;
            font-weight: 600;
        }
        label {
            font-weight: 500;
            margin-bottom: 5px;
        }
        .form-control {
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
            padding: 12px 15px;
        }
        .btn-primary {
            background: linear-gradient(to right, #3498db, #2980b9);
            border: none;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #2980b9, #2471a3);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Contact Us</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="msg">Message</label>
                <textarea id="msg" name="msg" class="form-control" rows="5" required></textarea>
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Send Message</button>
        </form>
        <p>You can also reach us directly at:<br> Email: support@buspass.com | Phone: +91 9025593655</p>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
