<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
    <div class="center-container">
        <div class="signup-container">
            <h2>Sign Up</h2>
            <form action="signup_process.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
              <center> <button type="submit">Sign Up</button> </center>
            </form>
         <center><p>Already have an account? <a href="login.php">Login</a></p></center>
        </div>
    </div>
</body>
</html>
