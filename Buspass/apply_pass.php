<?php
session_start();
include('includes/dbconn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $route = $_POST['route'];
    $start_date = $_POST['start_date'];
    $duration = $_POST['duration'];

    // Validate start date is not in the past
    $current_date = date("Y-m-d");

    if ($start_date < $current_date) {
        echo "<script>alert('Start date cannot be in the past');</script>";
    } else {
        $apply_date = $current_date;
        $months = intval($duration);
        if ($months <= 0) $months = 1;

        $cost_per_month = 500;
        $cost = $months * $cost_per_month;

        $existing_pass = $mysqli->query("SELECT id FROM passes WHERE user_id=$user_id AND status='Approved'");

        if ($existing_pass->num_rows > 0) {
            $status = 'Renewal';
        } else {
            $status = 'Pending';
        }

        $stmt = $mysqli->prepare("INSERT INTO passes (user_id, route, duration, cost, apply_date, start_date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            echo "<script>alert('Failed to prepare');</script>";
        } else {
            $stmt->bind_param("issdsss", $user_id, $route, $duration, $cost, $apply_date, $start_date, $status);

            if ($stmt->execute()) {
                echo "<script>alert('Pass application submitted successfully!');</script>";
            } else {
                echo "<script>alert('Failed to apply for pass.');</script>";
            }
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
    <title>Apply for Bus Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('https://media.istockphoto.com/photos/white-bus-traveling-on-the-asphalt-road-in-a-rural-landscape-at-picture-id879364174?k=20&m=879364174&s=612x612&w=0&h=JJ90BcO8di7yr0EuHMelSZ3H8W6RGJ8fSgyBViPcP34=') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            color: #fff;
            max-width: 500px;
            width: 100%;
            margin-left: 600px;  /* Added this */
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
        }
        h2 {
            text-align: center;
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
        .info-box {
            background-color: rgba(255,255,255,0.1);
            padding: 15px;
            border-left: 4px solid #27ae60;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Apply for Bus Pass</h2>
        <?php
        $check_pass = $mysqli->query("SELECT * FROM passes WHERE user_id=$user_id AND status='Approved' ORDER BY apply_date DESC LIMIT 1");
        if ($check_pass->num_rows > 0) {
            $last_pass = $check_pass->fetch_assoc();
            echo "<div class='info-box'>You have an active approved pass for <strong>{$last_pass['route']}</strong>. You can renew it here.</div>";
        }
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="route">Route</label>
                <input type="text" name="route" id="route" class="form-control" placeholder="Enter your route" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Enter date" required>
            </div>
            <div class="form-group">
                <label for="duration">Duration (in months)</label>
                <input type="text" name="duration" id="duration" class="form-control" placeholder="e.g., 3 months" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>
<?php include('includes/footer.php'); ?>
</body>
</html>