<?php 
include('includes/header.php'); 
include('includes/sidebar.php'); 
?>
<!DOCTYPE html>
<head>
    <title>Bus Pass Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('https://media.istockphoto.com/photos/white-bus-traveling-on-the-asphalt-road-in-a-rural-landscape-at-picture-id879364174?k=20&m=879364174&s=612x612&w=0&h=JJ90BcO8di7yr0EuHMelSZ3H8W6RGJ8fSgyBViPcP34=')
                        no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            margin: 0;
        }
        .main-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            margin: auto;
            margin-top: 100px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            text-align: center;
        }
        .main-card h1 {
            font-size: 2.5rem;
            margin-bottom: 0;
            animation: fadeInDown 1s ease-out;
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="main-card text-white">
        <h1>eBusPass Gateway<br><small class="text-light">GoPass Connect</small></h1>
    </div>
<?php include('includes/footer.php'); ?>
</body>
</html>
