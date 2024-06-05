<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

require 'db_connection.php'; // Include the database configuration file

// Insert new blotter record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "add") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $address = $_POST['user_add'];
    $accusation = $_POST['user_accu'];

    $stmt = $conn->prepare("INSERT INTO blotter (first_name, last_name, age, address, accusation, status) VALUES (?, ?, ?, ?, ?, 'Unsettled')");
    $stmt->bind_param("ssiss", $first_name, $last_name, $age, $address, $accusation);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Update blotter record status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "update") {
    $id = $_POST['id'];
    $new_status = $_POST['new_status'];

    $stmt = $conn->prepare("UPDATE blotter SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all blotter records
$result = $conn->query("SELECT * FROM blotter");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blotter Dashboard</title>
    <link rel="stylesheet" href="sidenavbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background-color: #fff8de;
        }
        .requests {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .btn {
            padding: 5px 10px;
            text-align: center;
            color: #fff;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn.reject {
            background-color: #d9534f;
        }
    </style>
</head>
<body>
<header>
    <ul class="sidenav">
        <center>
            <li class="logo-profile">
                <img src="profile.png" alt="Profile Picture" class="logo-profile-photo">
                <div class="text-profile"><p style="color: #fff;">Admin</p></div>
            </li>
        </center>
        <div class="tools">
            <li class="sidebar-active"><a href="admin_dashboard.php">Dashboard</a></li>
            <li class="sidebar"><a href="new_residences.php">New Residences</a></li>
            <li class="sidebar"><a href="blotter.php">Blotter</a></li>
            <li class="sidebar"><a href="brgy_id.php">ID Request</a></li>
            <li class="sidebar"><a href="brgy_cert.php">Certificate</a></li>
            <li class="sidebar"><a href="history_transaction.php">History Transaction</a></li>
            <li class="sidebar"><a href="logout.php">Logout</a></li>
            
        </div>
    </ul>
</header>

<section class="main">
    <div class="header">
        <img src="logo.png" alt="Logo" class="header-logo">
        <h2>BARANGAY MANAGEMENT SYSTEM</h2>
    </div>

    <div class="requests">
        <center><h2>Blotter Record</h2></center>
        <table id="requestsTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Accusation</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['accusation'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='action' value='update'>";
                        echo "<select name='new_status' onchange='this.form.submit()'>";
                        echo "<option value='Settled'" . ($row['status'] == 'Settled' ? ' selected' : '') . ">Settled</option>";
                        echo "<option value='Unsettled'" . ($row['status'] == 'Unsettled' ? ' selected' : '') . ">Unsettled</option>";
                        echo "</select>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist
