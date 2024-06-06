<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="sidenavbar.css">
    <title>Barangay ID Request</title> 
</head>

<body>
<header>
    <ul class="sidenav">
        <li class="logo-profile">
            <img src="profile.png" alt="Profile Picture" class="logo-profile-photo">
            <div class="text-profile"><p style="color: #fff;">Resident</p></div>
        </li>
        <div class="tools">
            <li class="sidebar-active"><a href="dashboard.php" style="text-decoration: none;">Home </a></li>
            <li class="sidebar"><a href="edit_profile.php" style="text-decoration: none;">Profile User </a></li>
            <li class="sidebar"><a href="brgy_id_req.php" style="text-decoration: none;">ID Request</a></li>
            <li class="sidebar"><a href="brgy_cert_req.php" style="text-decoration: none;">Certificate </a></li>
            <li class="sidebar"><a href="history_transaction.php" style="text-decoration: none;">History of Transactions </a></li>
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

    
<div class="job">
<h1> JOB HIRING! </h1>
    <img src= " https://philippinego.com/wp-content/uploads/2022/01/OCD-HIRING-1-1.png"alt="Barangay"/>
    <img src= " https://philippinego.com/wp-content/uploads/2022/06/Copy-of-JOB-2-3.png"alt="Barangay"/>
    <img src= " https://th.bing.com/th/id/OIP.q5Pxl665RYlTQvBQ7W-n8gAAAA?rs=1&pid=ImgDetMain"alt="Barangay"/>
</div>

<div class="job">
    <img src= " https://th.bing.com/th/id/OIP.IrI7CzDw_dvdXpNPE3d-SAHaHa?pid=ImgDet&w=182&h=182&c=7"alt="Barangay"/>
    <img src= " https://th.bing.com/th/id/OIP.LljNg_bbFE4QAAHTTrWCIQHaHa?w=1080&h=1080&rs=1&pid=ImgDetMain"alt="Barangay"/>
    <img src= " https://th.bing.com/th/id/OIP.d-Iud693HHAS7PDkfmLPdwHaHa?w=1080&h=1080&rs=1&pid=ImgDetMain"alt="Barangay"/>
</div>

<style>
    .job {
    justify-content: space-evenly;
	align-items: center;
}

.job img {
    max-width: 300px; 
    height: 300px;
    border: 5px solid #000; 
    border-radius: 10px; 
}
.h1 {
    font-size: 30px bold;
    text-align: center;

}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="formchecker.js"></script>
<script type="module" src="Firebase.js"></script>


</body>
</html>
    