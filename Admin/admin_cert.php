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

// Retrieve data from the database (Assuming 'cert_requests' table structure)
$sql = "SELECT * FROM cert_requests ORDER BY id DESC LIMIT 1"; // Assuming you want the latest request
$result = $conn->query($sql);

$user = null;

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user data found.";
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
        .cert-header, .cert-footer {
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
            <img src="logo.png" alt="Barangay Logo">
            <h2>Republic of the Philippines</h2>
            <h3>City of Manila</h3>
            <h3>Office of the Barangay Captain</h3>
            <h3>Barangay 867, Zone 95, District VI</h3>
            <h3>Kahlom 2 Pandacan, Manila</h3>
        </div>

        <div class="cert-body">
            <h2>Barangay Indigency</h2>
            <p>To whom it may concern,</p>
            <?php if ($user) : ?>
                <p>This is to certify that <strong><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></strong>, legal age, is a bonafide resident of this barangay with address <strong><?php echo $user['user_add']; ?></strong>, and has been classified to be one of the INDIGENT FAMILIES of this barangay.</p>
                <p>This certification is being issued for the purpose of <strong><?php echo $user['user_purpose']; ?></strong>.</p>
                <p>This certification is being issued upon the request of the above-mentioned name for whatever legal purpose it may serve him/her best.</p>
                <p>Issued this <?php echo date("jS"); ?> day of <?php echo date("F Y"); ?></p>
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

        <button class="btn" onclick="printCertificate()">Print</button>
        <button class="btn" onclick="saveAsPDF()">Save as PDF</button>
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
