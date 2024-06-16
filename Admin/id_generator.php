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

// Retrieve data from the database (Assuming 'barangay_id_requests' table structure)
$sql = "SELECT * FROM barangay_id_requests ORDER BY id DESC LIMIT 1"; // Assuming you want the latest request
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
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="sidenavbar.css">
    <title>Barangay ID</title>
    <style>
        .id-card {
            width: 60%;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            font-family: Arial, sans-serif;
        }

        .id-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }
        .id-header p{
            font-size: 13px;
            text-align: center;
            padding:0;
            margin-left:50px;
            
        
        }

        .id-header img {
            max-width: 75px;
            margin-left: 20px;
        }

        .id-header div {
            text-align: center;
            flex: 1;
        }

        .id-body {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .id-body img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-left:70px;
            margin-right: 90px;
        }

        .id-body .details {
            text-align: left;
        }

        .id-body .details p {
            margin: 10px 0;
            font-size: 20px;
        }

        .id-body .details p {
            margin: 5px 0;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <header>
        <ul class="sidenav">
            <!-- Profile Section -->
            <center>
                <li class="logo-profile">
                    <img src="profile.png" alt="Profile Picture" class="logo-profile-photo">
                    <div class="text-profile">
                        <p style="color: #fff;">Admin</p>
                    </div>
                </li>
            </center>
            <div class="tools">
                <!-- Left Nav Bar -->
                <li class="sidebar-active"><a href="admin_dashboard.php" style="text-decoration: none;">Dashboard </a></li>
                <li class="sidebar"><a href="blotter.php" style="text-decoration: none;">Blotter</a></li>
                <li class="sidebar"><a href="brgy_id.php" style="text-decoration: none;">ID Request</a></li>
                <li class="sidebar"><a href="brgy_cert.php" style="text-decoration: none;">Certificate </a></li>
                <li class="sidebar">
                    <a href="logout.php" style="text-decoration: none;">Logout</a>
                </li>
            </div>
        </ul>
    </header>

    <section class="main">
        <div class="header">
            <img src="logo.png" alt="Logo" class="header-logo">
            <h2>BARANGAY MANAGEMENT SYSTEM</h2>
        </div>

        <div class="container">
            <div class="id-container">
                <center>
                    <h2>Barangay ID</h2>
                </center>
                <?php if ($user) : ?>
                    <div class="id-card">
                        <div class="id-header">
                            <img src="logo.png" alt="Barangay Logo">
                            <div>
                                <p>Republic of the Philippines</></p>
                                <p>City of Manila</p>
                                <p>Office of the Barangay Captain</p>
                                <p>Barangay 867, Zone 95, District VI</p>
                                <p>Kahlom 2 Pandacan, Manila</p>
                            </div>
                            <img src="manila.png" alt="Barangay Logo" style="max-width: 150px;">
                        </div>
                        <div class="id-body">
                            <div class="image-container">
                                <img src='../User/uploads/<?php echo $user['photo_upload']; ?>' alt='Profile Photo'>
                            </div>
                            <div class='details'>
                                <p><?php echo $user['first_name'] . " " . $user['last_name']; ?></p>
                                <p>Age: <?php echo $user['age']; ?></p>
                                <p>Address: <?php echo $user['user_address']; ?></p>
                                <p>Contact: <?php echo $user['contact_number']; ?></p>
                                <p>Emergency Contact: <?php echo $user['emergency_contact']; ?></p>
                                <p>Birthdate: <?php echo $user['birthdate']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <p>No user data found.</p>
                <?php endif; ?>
                <center>
                    <button class="btn" onclick="printCertificate()">Print</button>
                </center>
                <center>
                    <button class="btn" onclick="saveAsPDF()">Save as PDF</button>
                </center>
            </div>
        </div>

        <script>
            function printCertificate() {
                window.print();
            }

            function saveAsPDF() {
                var idCard = document.querySelector('.id-card');
                var opt = {
                    margin: 0.5,
                    filename: 'barangay_id.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };

                html2pdf().set(opt).from(idCard).save();
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</body>

</html>