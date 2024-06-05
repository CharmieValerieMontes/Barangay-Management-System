<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_db";

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $user_add = isset($_POST['user_add']) ? $_POST['user_add'] : '';
    $user_purpose = isset($_POST['user_purpose']) ? $_POST['user_purpose'] : '';

    // Retrieve the logged-in username from the session
    $logged_in_username = $_SESSION['username'];

    // Check if required fields are not empty
    if (!empty($first_name) && !empty($last_name) && !empty($age) && !empty($user_add) && !empty($user_purpose)) {
        // Database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL statement to save the certificate request
        $sql = "INSERT INTO cert_requests (username, first_name, last_name, age, user_add, user_purpose) 
                VALUES ('$logged_in_username', '$first_name', '$last_name', '$age', '$user_add', '$user_purpose')";

        if ($conn->query($sql) === TRUE) {
            // Redirect the user to the confirmation page
            header("Location: history_transaction.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close database connection
        $conn->close();
    } else {
        echo "Please fill out all the required fields.";
    }
}
?>
