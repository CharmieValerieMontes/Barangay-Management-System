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
        <li class="logo-profile">
            <img src="images\global_image\logo-grabage-G-circle.png" alt="Profile Picture" class="logo-profile-photo">
            <div class="text-profile"><p style="color: #fff;">Resident</p></div>
        </li>
        <div class="tools">
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="edit_profile.php" style="text-decoration: none;">Profile User </a></li>
            <li class="sidebar"><a href="brgy_id_req.php" style="text-decoration: none;">ID Request</a></li>
            <li class="sidebar-active"><a href="brgy_cert_req.php" style="text-decoration: none;">Certificate </a></li>
            <li class="sidebar"><a href="history_transaction.php" style="text-decoration: none;">History of Transactions </a></li>
            <!-- Logout Button -->
            <li class="sidebar">
                <a href="logout.php" style="text-decoration: none;">Logout</a>
            </li>
        </div>
        <li class="logo-profile ">
            <img src="images\global_image\logo-grabage-text.png" alt="Profile Picture" class="logo-text-photo">
        </li>
    </ul>
</header>

<section class="main">
    <h1>Barangay Certificate Request</h1>

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
        <div class="col-md-3">
            <label for="purpose" class="form-label">Purposes</label>
            <select class="form-select" name="user_purpose" id="purpose" required>
                <option selected disabled value="">Choose...</option>
                <option>School</option>
                <option>Medical</option>
                <option>Business</option>
                <option>Application for Job</option>
            </select>
            <div class="invalid-feedback">
                Please select purpose
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" id="submit" type="submit">Submit form</button>
        </div>
    </form>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="formchecker.js"></script>
<script type="module" src="Firebase.js"></script>


</body>
</html>