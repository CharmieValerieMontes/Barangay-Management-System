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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the status update form is submitted
    if (isset($_POST['id']) && isset($_POST['new_status'])) {
        // Validate and sanitize form data
        $request_id = intval($_POST['id']);
        $new_status = $conn->real_escape_string($_POST['new_status']);

        // Update the status of the request in the database
        $sql = $conn->prepare("UPDATE cert_requests SET status=? WHERE id=?");
        $sql->bind_param("si", $new_status, $request_id);

        if ($sql->execute() === TRUE) {
            // Generate certificate if status is approved
            if ($new_status == 'Approved') {
                header("Location: cert_outine.php?id=$request_id");
                exit();
            } elseif ($new_status == 'Completed') {
                // Delete the record if the status is set to "Completed"
                $delete_sql = $conn->prepare("DELETE FROM cert_requests WHERE id=?");
                $delete_sql->bind_param("i", $request_id);
                if ($delete_sql->execute() === TRUE) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error deleting request: " . $conn->error;
                }
            } else {
                // Redirect back to the same page
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}

// Retrieve certificate requests from the database
$sql = "SELECT * FROM cert_requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="sidenavbar.css">
    <title>Blotter</title> 
    <style>
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
            <li class="sidebar"><a href="history_transaction.php"style="text-decoration: none;">History Transaction</a></li>
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
    <div class="requests">
        <h2>Certificate Requests</h2>
        <table id="requestsTable">
            <tr>
                <th>Request ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Purpose</th>
                <th>Status</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr id='row_".$row['id']."'>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                    echo "<td>" . $row['age'] . "</td>";
                    echo "<td>" . $row['user_add'] . "</td>";
                    echo "<td>" . $row['user_purpose'] . "</td>";
                    echo "<td>";
                    echo "<form id='form_".$row['id']."' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<select name='new_status'>";
                    echo "<option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>";
                    echo "<option value='Approved'" . ($row['status'] == 'Approved' ? ' selected' : '') . ">Approved</option>";
                    echo "<option value='Rejected'" . ($row['status'] == 'Rejected' ? ' selected' : '') . ">Rejected</option>";
                    echo "<option value='Completed'" . ($row['status'] == 'Completed' ? ' selected' : '') . ">Completed</option>";
                    echo "</select>";
                    echo "<center><button type='submit'>Okay</button></center";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No requests yet.</td></tr>";
            }
            ?>
        </table>
    </div>

    <?php
    // Close database connection
    $conn->close();
    ?>
</body>
</html>
