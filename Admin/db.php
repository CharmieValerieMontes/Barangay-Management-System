<?php
// Database connection details



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $host = "localhost";
$username = "root";
$password = "";
$database = "barangay";
    

    // Connect to MySQL server
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $LastName = $_POST["last_name"] ?? '';
    $FirstName = $_POST["first_name"] ?? '';
    $MiddleName = $_POST["middle_name"] ?? '';
    $sex = $_POST["sex"] ?? '';
    $maritalStatus = $_POST["marital_status"] ?? '';
    $address = $_POST["address"] ?? '';
    $employmentStatus = $_POST["employment_status"] ?? '';
    $birthDate = $_POST["birth_date"] ?? '';
    $BirthPlace = $_POST["place_of_birth"] ?? '';
    $age = $_POST["age"] ?? '';
    $religion = $_POST["religion"] ?? '';
    $voterStatus = $_POST["voter_status"] ?? '';

    // SQL query to insert data into the database
    $sql = "INSERT INTO residences (last_name, first_name, middle_name, sex, marital_status, address, employment_status, birth_date, place_of_birth, age, religion, voter_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("SQL error: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssssssssss",
                           $LastName,
                           $FirstName,
                           $MiddleName,
                           $sex,
                           $maritalStatus,
                           $address,
                           $employmentStatus,
                           $birthDate,
                           $BirthPlace,
                           $age,
                           $religion,
                           $voterStatus);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Record saved successfully.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "No form data submitted.";
}
