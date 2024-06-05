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
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Age</th><th>Address</th><th>Photo</th><th>Contact Number</th><th>Emergency Contact</th><th>Birthdate</th></tr>";

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

