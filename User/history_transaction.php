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

// Start the session
session_start();

// Retrieve the logged-in username from the session
$logged_in_username = $_SESSION['username'];

// Fetch transaction history for the logged-in user
$sql = "SELECT * FROM cert_requests WHERE username='$logged_in_username'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="sidenavbar.css">
    <title>History of Transactions</title>
</head>
<style>
.history {
     width: 100%;
     margin: 0 auto;
     background-color: #fff;
     padding: 20px;
     box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
.table-transaction {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border: 1px solid #ddd;
}

.table-transaction thead th {
    background-color: #343a40;
    color:#f2f2f2;
    padding: 15px;
    vertical-align: middle;
}

.table-transaction tbody tr:nth-of-type(odd) {
    background-color: #f8f9fa;
}

.table-transaction tbody tr:hover {
    background-color: #f1f1f1;
}

.table-transaction td, .table-transaction th {
    padding: 15px;
    vertical-align: middle;
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
<body>
    <header>
        <ul class="sidenav">
            <li class="logo-profile">
                <img src="profile.png" alt="Profile Picture" class="logo-profile-photo">
                <div class="text-profile"><p style="color: #fff;">Resident</p></div>
            </li>
            <div class="tools">
                <li class="sidebar"><a href="dashboard.php" style="text-decoration: none;">Home </a></li>
                <li class="sidebar"><a href="edit_profile.php" style="text-decoration: none;">Profile User </a></li>
                <li class="sidebar"><a href="brgy_id_req.php" style="text-decoration: none;">ID Request</a></li>
                <li class="sidebar"><a href="brgy_cert_req.php" style="text-decoration: none;">Certificate </a></li>
                <li class="sidebar-active"><a href="history_transaction.php" style="text-decoration: none;">History of Transactions </a></li>
                <li class="sidebar"><a href="logout.php" style="text-decoration: none;">Logout</a></li>
            </div>
        </ul>
    </header>

    <section class="main">
    <div class="header">
<img src="logo.png" alt="Logo" class="header-logo">
        <h2>BARANGAY MANAGEMENT SYSTEM</h2>
    </div>
    <div class="history">
        <center><h1>Transaction History</h1></center>
        <table class="table-transaction">
    <thead>
        <tr>
            <th>Request Date</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Purpose</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="7">No transactions found.</td>
        </tr>
    </tbody>
</table>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['request_date'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['user_add'] . "</td>";
                        echo "<td>" . $row['user_purpose'] . "</td>";
                        if ($row['status'] === '') {
                            echo "<td>Pending</td>";
                        } else {
                            echo "<td>" . $row['status'] . "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                   
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </section>
          

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="formchecker.js"></script>
    <script type="module" src="Firebase.js"></script>

</body>

</html>