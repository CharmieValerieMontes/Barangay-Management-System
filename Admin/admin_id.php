<?php

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="sidenavbar.css">
    <title>Barangay ID</title> 
    <style>
        .id-card {
            width: 500px;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            font-family: Arial, sans-serif;
        }
        .id-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .id-card .details {
            text-align: left;
        }
        .id-card .details h3 {
            margin: 10px 0;
            font-size: 1.5em;
        }
        .id-card .details p {
            margin: 5px 0;
            font-size: 1em;
        }
    </style>
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

<div class="container">
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
        // Display records as ID cards
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='id-card'>";
            echo "<img src='../User/uploads/" . $row['photo_upload'] . "' alt='Profile Photo'>";
            echo "<div class='details'>";
            echo "<h3>" . $row['first_name'] . " " . $row['last_name'] . "</h3>";
            echo "<p>Age: " . $row['age'] . "</p>";
            echo "<p>Address: " . $row['user_address'] . "</p>";
            echo "<p>Contact: " . $row['contact_number'] . "</p>";
            echo "<p>Emergency Contact: " . $row['emergency_contact'] . "</p>";
            echo "<p>Birthdate: " . $row['birthdate'] . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No records found";
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
}

// Close database connection
$conn = null;
?>
</div>
</section>
</body>
</html>
