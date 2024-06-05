<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="center-container">
    <div class="center-container">
        <div class="logo-container">
            <img src="logo.png" alt="logo">
        </div>
        <div class="login-container">
            <h2>Login</h2>
            <form action="login_process.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <center><button type="submit">Login</button></center>
            </form>
           <center> <p>Don't have an account? <a href="signup.php">Sign Up</a></p></center>
        </div>
    </div>
</body>
</html>
