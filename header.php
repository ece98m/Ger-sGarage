<?php include "connection.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONNECTION TO MYSQL IN PHP</title>
</head>
<body>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ger's Garage - Home</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<header class="p-3 ">
    <h1>Welcome to Ger's Garage</h1>
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="http://localhost/garage/" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 ">Services</a></li>
          <li><a href="#" class="nav-link px-2 ">Bookings</a></li>
          <li><a href="#" class="nav-link px-2 ">Contact</a></li>
        </ul>

        <div class="text-end">
            <?php if(!empty($_SESSION['email'])) { ?>
                <a href="logout.php" type="button" class="btn btn-primary">Logout</a>
                <a href="profile.php" type="button" class="btn btn-warning">Profile</a>
            <?php } else { ?> 
                <a href="login.php" type="button" class="btn btn-primary">Login</a>
                <a href="register.php" type="button" class="btn btn-warning">Sign-up</a>
            <?php } ?>
          
          
        </div>
      </div>
    </div>
  </header>