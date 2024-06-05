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

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Retrieve the logged-in username from the session
$logged_in_username = $_SESSION['username'];

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE username='$logged_in_username'";
$result = $conn->query($sql);

// Check if the user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $picture_path = $user['picture'];
} else {
    echo "No user found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="sidenavbar.css">
    <title>User Profile</title>
    <style>
        .form-label {
            text-align: left;
            /* Ensures the label text is left-aligned */
        }
    </style>
</head>

<body>
    <header>
        <ul class="sidenav">
            <li class="logo-profile">
                <img src="logo.png" alt="Profile Picture" class="logo-profile-photo">
                <div class="text-profile">
                    <p style="color: #fff;">Resident</p>
                </div>
            </li>
            <div class="tools">
                <li class="sidebar"><a href="dashboard.php" style="text-decoration: none;">Home </a></li>
                <li class="sidebar-active"><a href="user_profile.php" style="text-decoration: none;">Profile User </a></li>
                <li class="sidebar"><a href="blotter.php" style="text-decoration: none;">Blotter</a></li>
                <li class="sidebar"><a href="brgy_id_req.php" style="text-decoration: none;">ID Request</a></li>
                <li class="sidebar"><a href="brgy_cert_req.php" style="text-decoration: none;">Certificate </a></li>
                <li class="sidebar"><a href="history_transaction.php" style="text-decoration: none;">History of Transactions </a></li>
                <li class="sidebar"><a href="logout.php" style="text-decoration: none;">Logout</a></li>
            </div>
        </ul>
    </header>

    <section class="main">
        <h1>User Profile</h1>

        <!-- User Picture -->
        <div class="text-center mb-4">
            <!-- Display the user's picture -->
            <!-- Assuming $picture_path contains the file path retrieved from the database -->
            <img src="<?php echo $picture_path; ?>" alt="User Picture" class="img-thumbnail" style="width:150px;height:150px;">
        </div>

        <form action="update_profile.php" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $user['birthdate']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="birthplace" class="form-label">Birthplace</label>
                <input type="text" class="form-control" id="birthplace" name="birthplace" value="<?php echo $user['birthplace']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="marital_status" class="form-label">Marital Status</label>
                <select class="form-select" id="marital_status" name="marital_status" required>
                    <option value="Single" <?php if ($user['marital_status'] == 'Single') echo 'selected'; ?>>Single</option>
                    <option value="Married" <?php if ($user['marital_status'] == 'Married') echo 'selected'; ?>>Married</option>
                    <option value="Widowed" <?php if ($user['marital_status'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                    <option value="Divorced" <?php if ($user['marital_status'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="formchecker.js"></script>
    <script type="module" src="Firebase.js"></script>

</body>

</html>