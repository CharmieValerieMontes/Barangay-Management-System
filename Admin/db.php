<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $LastName = $_POST["last_name"];
    $FirstName = $_POST["first_name"];
    $MiddleName = $_POST["middle_name"];
    $sex = $_POST["sex"];
    $maritalStatus = filter_input(INPUT_POST, "marital_status", FILTER_SANITIZE_STRING);
    $address = $_POST["address"];
    $employmentStatus = filter_input(INPUT_POST, "employment_status", FILTER_SANITIZE_STRING);
    $birthDate = $_POST["birth_date"]; // Assuming birth_date is a valid date string
    $BirthPlace = $_POST["place_of_birth"]; // Assuming you want to sanitize this
    $age = $_POST["age"];
    $religion = $_POST["religion"];
    $voterStatus = isset($_POST['voter_status']) && in_array('Active', $_POST['voter_status']) ? 'Active' : 'Inactive';

    // Database connection details
    $host = "localhost";
    $dbname = "barangay";
    $username = "root";
    $password = "";

    // Connect to the database
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (mysqli_connect_errno()) {
        die("Connection error: " . mysqli_connect_error());
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO residences (last_name, first_name, middle_name, sex, marital_status, address, employment_status, birth_date, place_of_birth, age, religion, voter_status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssissssisss",
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
?>
