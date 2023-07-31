<?php

// Bağlantıyı include edin ve session_start() işlemini ekleyin
/* include "connection.php";              ../ */
require '../userpages/connection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="admincss/styleadmincreate.css">
  <title>Admin Registration - Ger's Garage</title>
 

</head>
<body>
  <div class="container">
    <h1>Admin Registration</h1>

    <form id="admin-registration-form">
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username"><br>
      
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password"><br>

      <label for="confirm-password">Confirm Password:</label><br>
      <input type="password" id="confirm-password" name="confirm-password"><br>

      <input type="submit" value="Register">
    </form>


  </div>

</body>
</html>
