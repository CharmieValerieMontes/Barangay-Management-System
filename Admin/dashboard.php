<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome to Your Dashboard, <?php echo $username; ?>!</h2>
    <p>This is your dashboard where you can view and manage your account information.</p>
    <!-- Add dashboard content here based on your application requirements -->
</body>
</html>