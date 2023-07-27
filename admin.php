<?php

if(!empty($_SESSION['username'])) { //eğer $_SESSION['email'] değişkeni
    header("Location: profie.php"); // boş değilse (yani kullanıcı oturumu açmışsa), tarayıcıyı "profile.php" sayfasına yönlendirir.
}


?>





<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ger's Garage Admin Page</title>
  <link rel="stylesheet" type="text/css" href="styleadmin.css">
</head>
<body>
  <div class="container">

    <h1>Welcome to Ger's Garage Admin Page</h1>

    <div class="text-end">
            <?php if(!empty($_SESSION['username'])) { ?>
                <a href="adminlogout.php" type="button" class="btn btn-primary">Logout</a>
            <?php } else { ?> 
                <a href="adminlogout.php" type="button" class="btn btn-primary">LogOut</a>
            <?php } ?>
          
          
        </div>
    <h3>Today's Bookings</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>Customer Name</th>
          <th>Vehicle Type</th>
          <th>Service Type</th>
          <th>Status</th>
          <th>Mechanic Assigned</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="booking-list">
        <!-- Booking list items will be populated here from backend -->
      </tbody>
    </table>

    <h3>Assign Mechanic</h3>
    <form id="assign-mechanic-form">
      <label for="booking-id">Booking ID:</label><br>
      <input type="text" id="booking-id" name="booking-id"><br>
      <label for="mechanic">Mechanic:</label><br>
      <select id="mechanic" name="mechanic">
        <!-- Mechanic options will be populated here from backend -->
      </select><br>
      <input type="submit" value="Assign Mechanic">
    </form>

    <h3>Add New Part</h3>
    <form id="new-part-form">
      <label for="part-name">Part Name:</label><br>
      <input type="text" id="part-name" name="part-name"><br>
      <label for="part-cost">Part Cost:</label><br>
      <input type="text" id="part-cost" name="part-cost"><br>
      <input type="submit" value="Add Part">
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/antd/4.16.13/antd.min.js"></script>
</body>
