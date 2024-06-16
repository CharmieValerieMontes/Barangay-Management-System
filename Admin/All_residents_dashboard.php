<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
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
            width: 100%;
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
            text-align: center;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #343a40;
            text-align: left;
            color: white;
            text-align: center;
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
            <li class="sidebar"><a href="blotter.php">Blotter</a></li>
            <li class="sidebar"><a href="brgy_id.php">ID Request</a></li>
            <li class="sidebar"><a href="brgy_cert.php">Certificate</a></li>
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
        <center><h2>All User</h2></center>
        <table id="requestsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>Birthplace</th>
                    <th>Marital Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['birthdate'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['birthplace'] . "</td>";
                        echo "<td>" . $row['marital_status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
