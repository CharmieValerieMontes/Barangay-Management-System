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
        $request_id = $_POST['id'];
        $new_status = $_POST['new_status'];

        // Update the status of the request in the database
        $sql = "UPDATE cert_requests SET status='$new_status' WHERE id=$request_id";

        if ($conn->query($sql) === TRUE) {
            // Generate certificate if status is approved
            if ($new_status == 'Approved') {
                header("Location: cert_outine.php?id=$request_id");

                exit();
            } else {
                // Redirect back to the same page
                header("Location: ".$_SERVER['PHP_SELF']);
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Your CSS file for styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
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
    <h1>Admin Dashboard</h1>

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
                <th>Action</th>
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
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>";
                    echo "<form id='form_".$row['id']."' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<select name='new_status'>";
                    echo "<option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>";
                    echo "<option value='Approved'" . ($row['status'] == 'Approved' ? ' selected' : '') . ">Approved</option>";
                    echo "<option value='Rejected'" . ($row['status'] == 'Rejected' ? ' selected' : '') . ">Rejected</option>";
                    echo "</select>";
                    echo "<button type='submit'>Update</button>";
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
