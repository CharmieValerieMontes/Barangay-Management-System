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

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the logged-in username from the session
$logged_in_username = $_SESSION['username'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $marital_status = $_POST['marital_status'];

    // Handle picture upload
    if (!empty($_FILES['picture']['name'])) {
        $picture_name = $_FILES['picture']['name'];
        $picture_tmp = $_FILES['picture']['tmp_name'];
        $picture_path = "uploads/".$picture_name;
        move_uploaded_file($picture_tmp, $picture_path);

        $sql = "UPDATE users SET name='$name', address='$address', birthdate='$birthdate', age='$age', birthplace='$birthplace', marital_status='$marital_status', picture='$picture_path' WHERE username='$logged_in_username'";
    } else {
        $sql = "UPDATE users SET name='$name', address='$address', birthdate='$birthdate', age='$age', birthplace='$birthplace', marital_status='$marital_status' WHERE username='$logged_in_username'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully.";
        header("Location: edit_profile.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

