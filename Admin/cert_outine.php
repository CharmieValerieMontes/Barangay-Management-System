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
    $sql = "SELECT * FROM cert_requests WHERE id=$request_id";
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
    <title>Barangay Certification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .cert-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
        }
        .cert-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }
        .cert-header img {
            max-width: 100px;
        }
        .cert-body {
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="cert-container">
        <div class="cert-header">
            <div class="header-text">
                <h2>Republic of the Philippines</h2>
                <h3>City of Manila</h3>
                <h3>Office of the Barangay Captain</h3>
                <h3>Barangay 867, Zone 95, District VI</h3>
                <h3>Kahlom 2 Pandacan, Manila</h3>
            </div>
            <img src="logo.png" alt="Barangay Logo">
        </div>

        <div class="cert-body">
            <h2>Barangay Indigency</h2>
            <p>To whom it may concern,</p>
            <?php if (isset($user)) : ?>
                <p>This is to certify that <strong><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></strong>, legal age, is a bonafide resident of this barangay with address <strong><?php echo $user['user_add']; ?></strong>, and has been classified to be one of the INDIGENT FAMILIES of this barangay.</p>
                <p>This certification is being issued for the purpose of <strong><?php echo $user['user_purpose']; ?></strong>.</p>
                <p>This certification is being issued upon the request of the above-mentioned name for whatever legal purpose it may serve him/her best.</p>
            <?php else : ?>
                <p>No user data found.</p>
            <?php endif; ?>
        </div>

        <div class="cert-footer">
            <p>Issued this <?php echo date("jS"); ?> day of <?php echo date("F Y"); ?></p>
            <br><br>
            <p>______________________________</p>
            <p>Joseph S. Valderrama</p>
            <p>Barangay Chairman</p>
            <p>Not valid without dry seal</p>
        </div>

    <script>
        function printCertificate() {
            window.print();
        }

        function saveAsPDF() {
            var certContainer = document.querySelector('.cert-container');
            var opt = {
                margin:       0.5,
                filename:     'barangay_certificate.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(certContainer).save();
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</body>
</html>
