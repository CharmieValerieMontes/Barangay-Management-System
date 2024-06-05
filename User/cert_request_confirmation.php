<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_db";

// Start the session
session_start();

// Retrieve the logged-in username from the session
$logged_in_username = $_SESSION['username'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the saved data for the logged-in user
$sql = "SELECT * FROM cert_requests WHERE username = '$logged_in_username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>First Name</th><th>Last Name</th><th>Age</th><th>Address</th><th>Purpose</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['age'] . "</td>";
        echo "<td>" . $row['user_add'] . "</td>";
        echo "<td>" . $row['user_purpose'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found for the logged-in user.";
}

// Close database connection
$conn->close();
?>