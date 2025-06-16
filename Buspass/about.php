<?php
session_start();
include('includes/dbconn.php');
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
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
            margin: 100px auto;
            text-align: center;
        }
        .form-container h2 {
            font-size: 32px;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .form-container h2 {
            font-size: 32px;
            margin-bottom: 30px;
            font-weight: 600;
            color:rgb(10, 82, 127);  
        }
        p {
            font-size: 16px;
            color: #fff;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>About Bus Pass Services</h2>
        <p>This Bus Pass Management System is designed to streamline the process of applying for, approving, and managing bus passes for daily commuters.</p>
        <p>We aim to make transportation more convenient, flexible, and accessible for everyone.</p>
        <p>This platform helps users apply for their bus passes online, track their application status, and enable administrators to efficiently approve or manage applications.</p>
        
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
