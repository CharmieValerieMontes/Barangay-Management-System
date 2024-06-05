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
            <img src="profile.png" alt="Profile Picture" class="logo-profile-photo">
            <div class="text-profile"><p style="color: #fff;">Admin</p></div>
        </li>
        </center>
        <div class="tools">
                <!-- Left Nav Bar -->
                <li class="sidebar"><a href="admin_dashboard.php" style="text-decoration: none;">Dashboard </a></li>
                <li class="sidebar"><a href="new_residences.php" style="text-decoration: none;">New Residences </a></li>
                <li class="sidebar"><a href="blotter.php" style="text-decoration: none;">Blotter</a></li>
                <li class="sidebar-active"><a href="brgy_id.php" style="text-decoration: none;">ID Request</a></li>
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
    <center><h1>Barangay ID Request</h1></center>

    <form class="row g-3 needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
        <div class="col-md-4">
            <label for="firstname" class="form-label">First name</label>
            <input type="text" class="form-control" name="first_name" id="firstname" required>
        </div>
        <div class="col-md-4">
            <label for="lastname" class="form-label">Last name</label>
            <input type="text" class="form-control" name="last_name" id="lastname" required>
        </div>
        <div class="col-md-4">
            <label for="age" class="form-label">Age</label>
            <input type="age" class="form-control" name="age" id="age" required>
            <div class="invalid-feedback">
                Please provide age
            </div>
        </div>
        <div class="col-md-6">
            <label for="adress" class="form-label">Address</label>
            <input type="text" class="form-control" name="user_add" id="adress" required>
            <div class="invalid-feedback">
                Please provide adress
            </div>
        </div>
        <div class="col-md-6">
            <label for="photo_upload" class="form-label">Upload Photo</label>
            <input type="file" class="form-control" name="photo_upload" id="photo_upload" accept="image/*" required>
            <small class="form-text text-muted">Please upload a JPEG or PNG image</small>
            <div class="invalid-feedback">
                Please upload a photo
            </div>
        </div>
        <div class="col-md-3">
            <label for="contnum" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contnum" required>
            <div class="invalid-feedback">
                Please provide a contact number.
            </div>
        </div>
        <div class="col-md-3">
            <label for="contnum" class="form-label">In Case of Emergency</label>
            <input type="text" class="form-control" id="contnum" required>
            <div class="invalid-feedback">
                Please provide a contact number.
            </div>
        </div>
        <div class="col-md-3">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" class="form-control" id="birthdate" required>
            <div class="invalid-feedback">
                Please provide birthday
            </div>
        </div>
        <div class="col-12">
           <center> <button class="btn btn-primary" id="submit" type="submit">Submit form</button></center>
        </div>
    </form>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="formchecker.js"></script>
<script type="module" src="Firebase.js"></script>


</body>
</html>