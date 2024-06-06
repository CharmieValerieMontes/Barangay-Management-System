<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user data is set
if (isset($_GET['id'])) {
    $request_id = $_GET['id'];

    // Retrieve the user data from the database based on request ID
    $sql = "SELECT * FROM blotter WHERE id=$request_id";
    $result = $conn->query($sql);

    // Check if the request exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "No request found.";
        exit;
    }
} else {
    echo "No request ID provided.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blotter Report</title>
    <style>
        /* CSS styles */
    </style>
</head>
<body>
    <div class="cert-container">
        <div class="cert-header">
            <!-- Header content -->
        </div>

        <div class="cert-body">
            <!-- Certificate body content -->
            <?php if (isset($user)) : ?>
                <!-- Display user data -->
            <?php else : ?>
                <!-- Display message if no user data found -->
            <?php endif; ?>
        </div>

        <div class="cert-footer">
            <!-- Footer content -->
        </div>

        <!-- Buttons to print or save certificate -->
        <button class="btn" onclick="printCertificate()">Print</button>
        <button class="btn" onclick="saveAsPDF()">Save as PDF</button>
    </div>

    <!-- JavaScript for printing and saving as PDF -->
    <script>
        function printCertificate() {
            window.print();
        }

        function saveAsPDF() {
            // JavaScript code to save certificate as PDF
        }
    </script>
</body>
</html>
