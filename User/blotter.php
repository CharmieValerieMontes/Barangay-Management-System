<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "barangay";

// Connect to MySQL server
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form data if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $complainantName = $_POST['complainant'];
    $complainantAddress = $_POST['address'];
    $accusation = $_POST['accusation'];
    $recordStatus = $_POST['rdoStatus'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO blotter_records (complainant_name, complainant_address, accusation, record_status)
            VALUES ('$complainantName', '$complainantAddress', '$accusation', '$recordStatus')";

    if (mysqli_query($conn, $sql)) {
        echo "Record saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
