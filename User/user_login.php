<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User Login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the admin table
    $sql_admin = "SELECT * FROM new_admin WHERE username=?";
    $stmt_admin = $conn->prepare($sql_admin);
    if ($stmt_admin === false) {
        die("Error in preparing SQL statement: " . $conn->error);
    }
    $stmt_admin->bind_param("s", $username);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin === false) {
        die("Error in executing SQL statement: " . $conn->error);
    }

    if ($result_admin->num_rows > 0) {
        $user = $result_admin->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Password is correct, admin logged in successfully
            session_start();
            $_SESSION['username'] = $user['username'];
            header("Location: ../Admin/admin_dashboard.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid password. Please try again.";
        }
        $stmt_admin->close();
    } else {
        // Check if the username exists in the user table
        $sql_user = "SELECT * FROM users WHERE username=?";
        $stmt_user = $conn->prepare($sql_user);
        if ($stmt_user === false) {
            die("Error in preparing SQL statement: " . $conn->error);
        }
        $stmt_user->bind_param("s", $username);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        if ($result_user === false) {
            die("Error in executing SQL statement: " . $conn->error);
        }

        if ($result_user->num_rows > 0) {
            $user = $result_user->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Password is correct, user logged in successfully
                session_start();
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                // Invalid password
                echo "Invalid password. Please try again.";
            }
        } else {
            // User not found
            echo "User not found. Please register first.";
        }
        $stmt_user->close();
    }
}

// Close database connection
$conn->close();
?>
