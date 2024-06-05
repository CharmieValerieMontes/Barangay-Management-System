<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="sidenavbar.css">
    <title>Blotter</title> 
</head>

<body>
<header>
    <ul class="sidenav">
        <!-- Profile Section -->
        <center>
        <li class="logo-profile">
            <img src="profile.png" alt="Profile Picture" class="logo-profile-photo">
            <div class="text-profile"><p style="color: #fff;">Admin</p></div>
        </li>
        </center>
        <div class="tools">
                <!-- Left Nav Bar -->
                <li class="sidebar-active"><a href="admin_dashboard.php" style="text-decoration: none;">Dashboard </a></li>
                <li class="sidebar"><a href="new_residences.php" style="text-decoration: none;">New Residences </a></li>
                <li class="sidebar"><a href="blotter.php" style="text-decoration: none;">Blotter</a></li>
                <li class="sidebar"><a href="brgy_id.php" style="text-decoration: none;">ID Request</a></li>
                <li class="sidebar"><a href="brgy_cert.php" style="text-decoration: none;">Certificate </a></li>
                <li class="sidebar">
                    <a href="logout.php" style="text-decoration: none;">Logout</a>
                </li>
            </div>
    </ul>
</header>

<section class="main">
<div class="header">
<img src="logo.png" alt="Logo" class="header-logo">
        <h2>BARANGAY MANAGEMENT SYSTEM</h2>
    </div>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        table th, table td {
            padding: 12px 15px;
        }
        table tbody tr {
            border-bottom: 1px solid #dddddd;
            background-color: #dcdcdc;
        }
        table tbody tr:nth-of-type(even) {
            background-color: white;
        }
        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        table tbody:hover {
            background-color: #f1f1f1;
        }
    </style>
    </head>
<body>
<?php
// Database integration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_db";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement to select records
    $stmt = $conn->query("SELECT * FROM barangay_id_requests");

    // Check if there are any records
    if ($stmt->rowCount() > 0) {
        // Display records in a table
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Age</th><th>Address</th><th>Photo</th><th>Contact Number</th><th>Emergency Contact</th><th>Birthdate</th><th>Status</th></tr>";

        // Loop through each record and display it
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['user_address'] . "</td>";
            echo "<td><img src='../User/uploads/" . $row['photo_upload'] . "' width='100' height='100'></td>"; // Display photo
            echo "<td>" . $row['contact_number'] . "</td>";
            echo "<td>" . $row['emergency_contact'] . "</td>";
            echo "<td>" . $row['birthdate'] . "</td>";
            echo "<td><form id='form_".$row['id']."' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "</td>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<select name='new_status'>";
                    echo "<option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>";
                    echo "<option value='Approved'" . ($row['status'] == 'Approved' ? ' selected' : '') . ">Approved</option>";
                    echo "<option value='Rejected'" . ($row['status'] == 'Rejected' ? ' selected' : '') . ">Rejected</option>";
                    echo "<option value='Completed'" . ($row['status'] == 'Completed' ? ' selected' : '') . ">Completed</option>";
                    echo "</select>";
                    echo "<center><button type='submit'>Okay</button></center";
                    echo "</form>";
            echo "</tr>";
            
                    echo "</td>";
                    echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
}

// Close database connection
$conn = null;

