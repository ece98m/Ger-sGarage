<?php
if (!empty($_SESSION['username'])) {
    header("Location: admin.php");
}
include '../userpages/connection.php';
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ger's Garage Admin Page</title>
    <link rel="stylesheet" type="text/css" href="admincss/styleadmin.css">
</head>

<body>
    <div class="container">
        <nav class="navbar"> <!-- Added the class "navbar" to the nav element -->
            <h1>Ger's Garage Admin Page</h1>
            <div>
                <a href="admincreate.php" class="btn nav-link">Add Admin</a> <!-- Added the class "nav-link" to the anchor elements -->
                <a href="bookings.php" class="btn nav-link">Reservations</a>
                <a href="staffroster.php" class="btn nav-link">Staff Roster</a>
                <a href="vehicle_products.php" class="btn nav-link">Vehicle Products</a>
                <a href="invoice.php" class="btn nav-link">Customer Invoice</a>
                <?php if (!empty($_SESSION['username'])) { ?>
                    <a href="adminlogout.php" class="btn btn-primary nav-link">Logout</a> <!-- Added the class "nav-link" to the anchor element -->
                <?php } else { ?>
                    <a href="adminlogout.php" class="btn btn-primary nav-link">LogOut</a> <!-- Added the class "nav-link" to the anchor element -->
                <?php } ?>
            </div>
        </nav>
    
        <!-- Rest of the content -->
    </div>

  
</body>
