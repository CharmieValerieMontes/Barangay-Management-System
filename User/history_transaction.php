<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="sidenavbar.css">
    <link rel="stylesheet" href="history_transaction.css">
    <title>History of Transaction</title> 
</head>

<body>
<header>
    <ul class="sidenav">
        <!-- Profile Section -->
        <li class="logo-profile">
            <img src="logo.png" alt="Profile Picture" class="logo-profile-photo">
            <div class="text-profile"><p style="color: #fff;">Resident</p></div>
        </li>
        <div class="tools">
            <!-- Left Nav Bar -->
            <li class="sidebar"><a href="dashboard.php" style="text-decoration: none;">Home </a></li>
            <li class="sidebar"><a href="edit_profile.php" style="text-decoration: none;">Profile User </a></li>
            <li class="sidebar"><a href="blotter.php" style="text-decoration: none;">Blotter</a></li>
            <li class="sidebar"><a href="brgy_id_req.php" style="text-decoration: none;">ID Request</a></li>
            <li class="sidebar"><a href="brgy_cert_req.php" style="text-decoration: none;">Certificate </a></li>
            <li class="sidebar-active"><a href="history_transaction.php" style="text-decoration: none;">History of Transactions </a></li>
            <!-- Logout Button -->
            <li class="sidebar">
                <a href="logout.php" style="text-decoration: none;">Logout</a>
            </li>
        </div>
    </ul>
</header>

<section class="main">
    <h1>History of Transaction</h1>

    <table class="table caption-top">
    <caption>List of Transactions</caption>
    <thead class="table-light">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Type of Request</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Barangay Certificate</td>
        <td>Pending</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Barangay ID</td>
        <td>Ready to pick up</td>
        </tr>
        
    </tbody>
    </table>
    
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="formchecker.js"></script>
<script type="module" src="Firebase.js"></script>


</body>
</html>