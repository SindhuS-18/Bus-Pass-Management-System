<?php
include('includes/dbconn.php');

$type = $_POST['type'] ?? '';

function displayTable($result, $heading, $showActions = false) {
    echo "<h4>$heading</h4>";
    echo "<table class='table table-bordered table-striped'>
            <thead><tr>
                <th>ID</th>
                <th>User</th>
                <th>Route</th>
                <th>Duration</th>
                <th>Cost</th>
                <th>Apply Date</th>
                <th>Start Date</th>
                <th>Status</th>";
    if ($showActions) {
        echo "<th>Action</th>";
    }
    echo "</tr></thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['username']}</td>
            <td>{$row['route']}</td>
            <td>{$row['duration']}</td>
            <td>{$row['cost']}</td>
            <td>{$row['apply_date']}</td>
            <td>{$row['start_date']}</td>
            <td>{$row['status']}</td>";

        if ($showActions && $row['status'] === 'Pending') {
            echo "<td>
                <button class='btn btn-success btn-sm approve-btn' data-id='{$row['id']}'>Approve</button>
                <button class='btn btn-danger btn-sm reject-btn' data-id='{$row['id']}'>Reject</button>
            </td>";
        } elseif ($showActions) {
            echo "<td>-</td>";
        }

        echo "</tr>";
    }

    echo "</tbody></table>";
}

switch ($type) {
    case 'users':
        $result = $mysqli->query("SELECT name, email, phone FROM users");
        echo "<h4>Total Users</h4><table class='table table-bordered'><thead><tr><th>Name</th><th>Email</th><th>Phone</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phone']}</td></tr>";
        }
        echo "</tbody></table>";
        break;

    case 'passes':
        $result = $mysqli->query("SELECT p.*, u.name AS username FROM passes p INNER JOIN users u ON p.user_id = u.id");
        displayTable($result, "All Pass Applications", false);
        break;

    case 'approved':
    case 'pending':
    case 'rejected':
        $status = ucfirst($type);
        $stmt = $mysqli->prepare("SELECT p.*, u.name AS username FROM passes p INNER JOIN users u ON p.user_id = u.id WHERE p.status = ?");
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        displayTable($result, "$status Passes", true);
        $stmt->close();
        break;

    default:
        echo "<p class='text-muted'>Click a card to view detailed data.</p>";
        break;
}
?>
