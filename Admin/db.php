<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bms1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to save form data to the database
function saveFormData($table, $data) {
    global $conn;

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Example usage to save BLOTTER form data
$blotterData = array(
    'complainant_name' => $_POST['txtComplainantName'],
    'complainant_address' => $_POST['txtComplainantAddress'],
    'accusation' => $_POST['txtAccusation'],
    'record_status' => $_POST['rdoStatus']
);

saveFormData('BlotterRecords', $blotterData);

// Repeat the above process for other forms (CLEARANCE, INDIGENCY, PERMIT, NEW RESIDENCE) with appropriate data and table names

// Example usage to save CLEARANCE form data
$clearanceData = array(
    'name' => $_POST['txtClearanceName'],
    'sex' => $_POST['sex'],
    'address' => $_POST['txtClearanceAddress'],
    'voter_status' => isset($_POST['voterStatus']) ? implode(", ", $_POST['voterStatus']) : "",
    'purpose' => $_POST['purpose']
);

saveFormData('ClearanceRecords', $clearanceData);

// Example usage to save INDIGENCY form data
$indigencyData = array(
    'name' => $_POST['txtIndigencyName'],
    'address' => $_POST['txtIndigencyAddress'],
    'voter_status' => isset($_POST['voterStatus']) ? implode(", ", $_POST['voterStatus']) : "",
    'sex' => $_POST['sex'],
    'years_of_living' => $_POST['yearsOfLiving'],
    'purpose' => $_POST['purpose']
);

saveFormData('IndigencyRecords', $indigencyData);

// Example usage to save PERMIT form data
$permitData = array(
    'owner_name' => $_POST['txtPermitOwnerName'],
    'business_name' => $_POST['txtPermitBusinessName'],
    'business_type' => $_POST['txtPermitBusinessType'],
    'address' => $_POST['txtPermitAddress']
);

saveFormData('PermitRecords', $permitData);

// Example usage to save NEW RESIDENCE form data
$residenceData = array(
    'last_name' => $_POST['last_name'],
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'sex' => $_POST['sex'],
    'marital_status' => $_POST['maritalStatus'],
    'address' => $_POST['address'],
    'employment_status' => $_POST['employmentStatus'],
    'birth_date' => $_POST['birth_date'],
    'place_of_birth' => $_POST['place_of_birth'],
    'age' => $_POST['age'],
    'religion' => $_POST['religion'],
    'voter_status' => isset($_POST['voterStatus']) ? implode(", ", $_POST['voterStatus']) : ""
);

saveFormData('ResidenceRecords', $residenceData);