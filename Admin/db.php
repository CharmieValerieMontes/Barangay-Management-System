<?php

var_dump($_POST); // Debug statement to see the submitted form data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay";



// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted

    // Retrieve form data
    $lastName =($_POST['last_name']) ;
    $firstName = ($_POST['first_name']) ;
    $middleName = ($_POST['middle_name']) ;
    $sex = ($_POST['sex']) ;
    $maritalStatus = ($_POST['marital_status']) ;
    $address = ($_POST['address']) ;
    $employmentStatus = ($_POST['employment_status']) ;
    $birthDate = ($_POST['birth_date']);
    $placeOfBirth = ($_POST['place_of_birth']);
    $age = ($_POST['age']);
    $religion = ($_POST['religion']) ;
    $voterStatus = 'Inactive'; // Default value
    if (($_POST['voter_status'])) {
        $voterStatus = in_array('Active', $_POST['voter_status']) ? 'Active' : 'Inactive';
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO residences (last_name, first_name, middle_name, sex, marital_status, address, employment_status, birth_date, place_of_birth, age, religion, voter_status) VALUES ('$lastName', '$firstName', '$middleName', '$sex', '$maritalStatus', '$address', '$employmentStatus', '$birthDate', '$placeOfBirth', '$age', '$religion', '$voterStatus')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


// Close the connection
$conn->close();

