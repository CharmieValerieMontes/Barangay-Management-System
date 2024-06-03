<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form action="registration _process.php" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" required><br><br>
        
        <label for="birthdate">Birthdate:</label><br>
        <input type="date" id="birthdate" name="birthdate" required><br><br>
        
        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" required><br><br>
        
        <label for="birthplace">Birthplace:</label><br>
        <input type="text" id="birthplace" name="birthplace" required><br><br>
        
        <label for="marital_status">Marital Status:</label><br>
        <select id="marital_status" name="marital_status">
            <option value="single">Single</option>
            <option value="married">Married</option>
        </select><br><br>
        
        <label for="picture">Upload Picture:</label><br>
        <input type="file" id="picture" name="picture" accept="image/*" required><br><br>
        
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>