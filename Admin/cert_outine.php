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

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the user's information from the database based on their username
$username = $_SESSION['username'];

$sql = "SELECT first_name, last_name, age, user_add, user_purpose FROM cert_requests WHERE username='$username' ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $age = $row['age'];
    $user_add = $row['user_add'];
    $user_purpose = $row['user_purpose'];

    // Generate the barangay certificate using the retrieved user information
    // Example format:
    $certificate_content = "This is to certify that $first_name $last_name, aged $age, residing at $user_add, has requested this certificate for the purpose of $user_purpose.";

    // Output the certificate content
    echo $certificate_content;
} else {
    echo "No data found for generating the certificate.";
}

// Close database connection
$conn->close();
?>