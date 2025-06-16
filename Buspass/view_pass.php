<?php
session_start();
include('includes/dbconn.php');
include('includes/header.php');
include('includes/sidebar.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: userlogin.php");
    exit;
}
$where = "1";
if (!empty($_GET['q'])) {
    $q = $mysqli->real_escape_string($_GET['q']);
    $where = "(users.name LIKE '%$q%' OR passes.route LIKE '%$q%' OR passes.status LIKE '%$q%')";
}
$query = "
  SELECT passes.*, users.name 
  FROM passes 
  JOIN users ON passes.user_id = users.id 
  WHERE $where 
  ORDER BY passes.id DESC
";
$user_id = $_SESSION['user_id'];
$result = $mysqli->query("SELECT * FROM passes WHERE user_id = $user_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bus Passes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://media.istockphoto.com/photos/white-bus-traveling-on-the-asphalt-road-in-a-rural-landscape-at-picture-id879364174?k=20&m=879364174&s=612x612&w=0&h=JJ90BcO8di7yr0EuHMelSZ3H8W6RGJ8fSgyBViPcP34=') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 60px 20px;
        }
        .container {
    max-width: 900px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    padding: 60px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    color: #fff;
    margin-left: 350px; /* Added to shift the box right */
}
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            color: #fff;
        }
        .form-control {
            border-radius: 10px;
            border: none;
            padding: 12px 15px;
        }
        .btn-search {
            border-radius: 10px;
            background-color: #3498db;
            color: white;
            padding: 10px 18px;
            border: none;
            margin-left: 10px;
        }
        .btn-search:hover {
            background-color: #2980b9;
        }
        table {
            background-color: rgba(255,255,255,0.95);
            color: #2c3e50;
            border-radius: 10px;
            overflow: hidden;
        }
        thead {
            background-color: #2980b9;
            color: white;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
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
        footer {
            text-align: center;
            margin-top: 40px;
            color: #eee;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .search-bar {
                flex-direction: column;
            }
            .btn-search {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Your Bus Passes</h2>
    <form method="GET" class="search-bar">
        <input type="text" name="q" class="form-control" style="max-width: 400px;" placeholder="Search by name, route, or status" value="<?= $_GET['q'] ?? '' ?>">
        <button type="submit" class="btn btn-search">Search</button>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Route</th>
                    <th>Duration</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['route']) ?></td>
                    <td><?= htmlspecialchars($row['duration']) ?></td>
                    <td>
                        <span class="badge bg-<?= $row['status'] === 'Approved' ? 'success' : ($row['status'] === 'Pending' ? 'warning' : 'secondary') ?>">
                            <?= htmlspecialchars($row['status']) ?>
                        </span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
<?php include('includes/header.php');?>
</body>
</html>