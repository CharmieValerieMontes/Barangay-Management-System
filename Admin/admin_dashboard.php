<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="sidenavbar.css">
    <title>Barangay ID Request</title> 
</head>

<body>
<header>
    <ul class="sidenav">
        <!-- Profile Section -->
        <center>
        <li class="logo-profile">
            <img src="logo.png" alt="Profile Picture" class="logo-profile-photo">
            <div class="text-profile"><p style="color: #fff;">Admin</p></div>
        </li>
        </center>
        <div class="tools">
            <!-- Left Nav Bar -->
            <li class="sidebar-active"><a href="admin_dashboard.php" style="text-decoration: none;">Dashboard </a></li>
            <li class="sidebar"><a href="new_residences.php" style="text-decoration: none;">New Residences </a></li>
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
<center>
<h2>Welcome to Your Dashboard</h2>
    <p>This is your dashboard where you can view and manage your account information.</p>
    </center>

    <div class="button-container">
        <form method="post">
            <button type="submit" name="button1" class="button">RESIDENCES</button>
        </form>
        <form method="post">
            <button type="submit" name="button2" class="button">BLOTTER</button>
        </form>
        <form method="post">
            <button type="submit" name="button3" class="button">REQUEST BARANGAY ID</button>
        </form>
        <form method="post">
            <button type="submit" name="button4" class="button">REQUEST BARANGAY CERTIFICATE</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['button1'])) {
            echo "<p>You pressed Button 1</p>";
        } elseif (isset($_POST['button2'])) {
            echo "<p>You pressed Button 2</p>";
        } elseif (isset($_POST['button3'])) {
            echo "<p>You pressed Button 3</p>";
        } elseif (isset($_POST['button4'])) {
            echo "<p>You pressed Button 4</p>";
        }
    }
    ?>

<style>
        .button-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            margin: 50px;
            max-width: 300px;
            margin-left: 210px; 
            
        }
        .button-container form {
            display: flex;
        }
        .button {
            width: 500px;
            height: 250px;
            font-size: 16px;
            background-color: #4CAF50; 
            border: none;
            color: white;
            text-align: center;
            cursor: pointer;
            border-radius: 8px;
        }
    </style>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="formchecker.js"></script>
<script type="module" src="Firebase.js"></script>


</body>
</html>
    