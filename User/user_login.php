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

// User Login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user is an admin
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $admin['password'])) {
            // Password is correct, admin logged in successfully
            session_start();
            $_SESSION['username'] = $username;
            header("Location: ../Admin/admin_dashboard.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid password. Please try again.";
        }
    } else {
        // Check if the user is a regular user
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, user logged in successfully
                session_start();
                $_SESSION['username'] = $username;
                header("Location: user_dashboard.php");
                exit();
            } else {
                // Invalid password
                echo "Invalid password. Please try again.";
            }
        } else {
            // User not found
            echo "User not found. Please register first.";
        }
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>
