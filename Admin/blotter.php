<?php
var_dump($_POST); // Debug statement to see the submitted form data
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked
    if (isset($_POST["btnSave"])) {
        // Insert new blotter record
        $complainantName = $_POST["txtComplainantName"];
        $complainantAddress = $_POST["txtComplainantAddress"];
        $accusation = $_POST["txtAccusation"];
        $status = $_POST["rdoStatus"];

        $sql = "INSERT INTO blotter (complainant_name, complainant_address, accusation, status)
                VALUES ('$complainantName', '$complainantAddress', '$accusation', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST["btnUpdate"])) {
        // Update existing blotter record
        // Add your update logic here
    } elseif (isset($_POST["btnDelete"])) {
        // Delete existing blotter record
        // Add your delete logic here
    } elseif (isset($_POST["btnClear"])) {
        // Clear all records (if needed)
        // Add your clear logic here
    }
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


// Close MySQL connection
$conn->close();

