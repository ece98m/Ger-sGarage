<?php include "header.php"; ?>

<?php

session_start();


// Check if the user is logged in
if (!isset($_SESSION['email'])) {
  // Redirect the user to the login page or show an error message
  header("Location: login.php");
  exit();
}

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
} else {

} 




$successMessage = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $vehicleType = $_POST['vehicle_type'];
  $vehicleMake = $_POST['vehicle_make'];
  $vehicleLicense = $_POST['vehicle_license'];
  $vehicleEngineType = $_POST['vehicle_engine_type'];

  // fetch the customer id s
  $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
   
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; // assign to a variable
  }

  $errors = array();

  if (empty($vehicleType) || $vehicleType == 'select') {
    $errors[] = "Please select the vehicle type";
  }

  if (empty($vehicleMake) || $vehicleMake == 'select') {
    $errors[] = "Please select the vehicle make";
  }

  if (empty($vehicleLicense)) {
    $errors[] = "Please enter the vehicle license details";
  }

  if (empty($vehicleEngineType) || $vehicleEngineType == 'select') {
    $errors[] = "Please select the vehicle engine type";
  }

  

  

  if (empty($errors)) {

      // adding new vehicle to database
  $checkSql = "SELECT * FROM vehicles WHERE idcustomers='$customerId' AND license='$vehicleLicense' ";
  $checkResult = $mysqli->query($checkSql);
          if ($checkResult->num_rows > 0) {
          $errorMessage = "This vehicle has already been registered."; 
          } else {
          
            $sql = "INSERT INTO vehicles (idcustomers, vehicle_type, make, license, engine_type)
            VALUES ('$customerId', '$vehicleType', '$vehicleMake', '$vehicleLicense', '$vehicleEngineType')";
                if ($mysqli->query($sql) === true) {
                 $vehicleId = $mysqli->insert_id; 
                 $successMessage = "New vehicle has been added. Vehicle id: " . $vehicleId; 
                 header("Location: profile.php"); 
                 exit(); 
         } else {
               echo "Error. Unsuccesfull : " . $mysqli->error;
    }
  }
 }
}

?>
<!-- <head>
<link rel="stylesheet" type="text/css" href="userpagecss/stylemyvehicles.css">
</head>
     -->
  

<body>
<section id="vehicles">
 
 <h3>Your Vehicles</h3>
 
 <?php
$sql = "SELECT idcustomers FROM customers WHERE email='$email'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $customerId = $row['idcustomers']; // Bu idyi gerekli değişkene ata
}


$sql = "SELECT * FROM vehicles WHERE idcustomers='$customerId'";
$vehicles = $mysqli->query($sql);

echo '<!-- Page Title -->
      <div class="page-title-area">
          <img src="assets/img/home-one/footer-car.png" alt="Title">
          <div class="container">
              <div class="page-title-content">
                  <h2>Profile</h2>
                  <ul>
                      <li>
                          <a href="index.php">Home</a>
                      </li>
                      <li>
                          <i class="bx bx-chevron-right"></i>
                      </li>
                      <li>Profile</li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- End Page Title -->

      <!-- Cart -->
      <section class="cart-area ptb-100">
          <div class="container">
              <div class="cart-wrap">
                  <table class="table">
                      <thead class="thead">
                          <tr>
                              <th class="table-head" scope="col">Vehicle Type</th>
                              <th class="table-head" scope="col">Vehicle Make</th>
                              <th class="table-head" scope="col">Vehicle Licence</th>
                              <th class="table-head" scope="col">Vehicle Engine Type</th>
                              <th class="table-head" scope="col">Remove</th>
                          </tr>
                      </thead>
                      <tbody>';

if ($vehicles->num_rows > 0) {
  while ($row = $vehicles->fetch_assoc()) {
    echo '<tr>
            <td>' . $row['vehicle_type'] . '</td>
            <td>' . $row['make'] . '</td>
            <td>' . $row['license'] . '</td>
            <td>' . $row['engine_type'] . '</td>
            <td>
            <a href="delete_vehicle.php?id=' . $row['idvehicles'] . '">
            <i class="bx bx-x"></i>
                </a>
            </td>
          </tr>';
  }
} else {
  echo '<tr>
          <td colspan="4">NO VEHICLE RECORD ON YOUR ACCOUNT. PLEASE REGISTER YOUR VEHICLE DETAILS.</td>
        </tr>';
}

echo '</tbody>
      </table>
    
      <div class="total-shopping">
          <h3>Do you need a service?</h3>
          <a href="booking.php">Book Now</a>
      </div>
  </div>
</div>
</section>
<!-- End Cart -->';
?>

</section>

  <section id="add-vehicle">

  <div class="container">
                <div class="row justify-content-center custom-margin"> <!-- bootstrap -->
                   
                    <div class="col-lg-6">
                        <div class="checkout-item">
                          <h2>Add Your Vehicle</h2>
                          <div class="checkout-one">
                            <!-- Display error messages here -->
                            <?php if (!empty($errors)) : ?>
              <div class="alert alert-danger">
                <ul>
                  <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

                  <!-- Display success message here -->
            <?php if (!empty($successMessage)) : ?>
              <div class="alert alert-success">
                <?php echo $successMessage; ?>
              </div>
            <?php endif; ?>
    <!------------------------------------------------------------------->
                         <form action="" method="POST">
                      
                <label for="vehicle_type">Vehicle Type:</label>
                 <div class="form-group">
                 <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                 <option value="select">Please select</option>
                 <option value="motorbike">Motorbike</option>
                 <option value="car">Car</option>
                 <option value="small_van">Small Van</option>
                 <option value="small_bus">Small Bus</option>
                 </select>
                 </div>

                  <label for="vehicle_make">Vehicle Make:</label>
                  <div class="form-group">
                  <select class="form-control" id="vehicle_make" name="vehicle_make" required>
                  <option value="select">Please select</option>
                  <option value="audi">Audi</option>
                  <option value="bmw">BMW</option>
                    <!-- More car makes -->
                  <option value="mercedes">Mercedes</option>
                    <!--  -->
                    </select>
                    </div>
                   <label for="vehicle_license">Vehicle License Details:</label>
                   <div class="form-group">
                   <input class="form-control" type="text" id="vehicle_license" name="vehicle_license" required>
                   </div>
                   <label for="vehicle_engine_type">Vehicle Engine Type:</label>
                   <div class="form-group">
                   <select class="form-control" id="vehicle_engine_type" name="vehicle_engine_type" required>
                   <option value="select">Please select</option>
                   <option value="diesel">Diesel</option>
                   <option value="petrol">Petrol</option>
                   <option value="hybrid">Hybrid</option>
                   <option value="electric">Electric</option>
                   </select>
                   </div>
                       
               
                  <button type="submit">Add Vehicle</button>
                
                          </form>
                          </div>
                          </div>
                        </div>
                    </div>
                    </div>
                  

    <?php if (!empty($successMessage)) : ?>
      <div class="success-message">
        <?php echo $successMessage; ?>
      </div>
    <?php endif; ?>
  </section>
  </body>
  



<?php include "footer.php"; ?>