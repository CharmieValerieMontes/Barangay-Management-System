<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
<div class="center-container">
    <div class="center-container">
        <div class="logo-container">
            <img src="logo.png" alt="logo">
        </div>
        <div class="login-container">
    <h2>Login</h2>
    <form action="user_login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <center><button type="submit" name="login">Login</button></center>
           <center> <p>Don't have an account? <a href="user_registration.php">Sign Up</a></p></center>
    </form>
</body>
</html>