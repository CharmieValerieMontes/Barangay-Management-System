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
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $marital_status = $_POST['marital_status'];

    // Handle picture upload
    $image = $_FILES['picture']['name'];
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . 'Barangay-Management-System/User/photo/';
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $new_image_name = time() . "_" . basename($image);

    // Validate file extension
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "<script>alert('Please upload photo having extension .jpg/.jpeg/.png');</script>";
    } 
    // Validate file size (max 2MB)
    else if ($_FILES['picture']['size'] > 2000000) {
        echo "<script>alert('Your photo exceeds the size of 2 MB');</script>";
    } 
    else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir . $new_image_name)) {
            $picture_path = 'registration_process/photo/' . $new_image_name; // Relative path to store in the database

            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $sql = "INSERT INTO new_admin (username, password, name, address, birthdate, age, birthplace, marital_status, picture) 
                    VALUES ('$username', '$hashed_password', '$name', '$address', '$birthdate', '$age', '$birthplace', '$marital_status', '$picture_path')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful. You can now login with your credentials.";
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close database connection
$conn->close();
