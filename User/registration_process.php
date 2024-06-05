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

// User Registration with Username and Password
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $marital_status = $_POST['marital_status'];

    // Handle picture upload
    $picture_name = $_FILES['picture']['name'];
    $picture_tmp = $_FILES['picture']['tmp_name'];
    $picture_path = "uploads/".$picture_name;
    move_uploaded_file($picture_tmp, $picture_path);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, name, address, birthdate, age, birthplace, marital_status, picture) 
            VALUES ('$username', '$hashed_password', '$name', '$address', '$birthdate', '$age', '$birthplace', '$marital_status', '$picture_path')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful. You can now login with your credentials.";
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();