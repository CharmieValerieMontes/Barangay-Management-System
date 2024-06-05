<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }
        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>User Registration</h2>
    <form action="registration_process.php" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="picture">Upload Picture:</label>
        <input type="file" id="picture" name="picture"  required>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        
        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" required>
        
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
        
        <label for="birthplace">Birthplace:</label>
        <input type="text" id="birthplace" name="birthplace" required>
        
        <label for="marital_status">Marital Status:</label>
        <select id="marital_status" name="marital_status">
            <option value="single">Single</option>
            <option value="married">Married</option>
        </select>
        
        
        
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>