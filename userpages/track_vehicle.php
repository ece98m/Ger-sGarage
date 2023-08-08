<?php include "header.php"; ?>
<?php

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];

  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  // Kullanıcı oturumu açıksa, lisansları getir
  // get the customer id
  $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // customer has been found, now use the customer id
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; // assign the customer id to a variable

    // get the vehicle licenses belong to the specific customer account
    $sql = "SELECT * FROM vehicles WHERE idcustomers='$customerId'";
    $vehicles = $mysqli->query($sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $license = $_POST['license'];

      // Find the corresponding vehicle ID for the selected license
      $sql = "SELECT idvehicles FROM vehicles WHERE license='$license'";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vehicleId = $row['idvehicles']; // assign the vehicle id to a variable

        // get the vehicle status now belong to the specific customer account
        $sql = "SELECT status FROM bookings WHERE idvehicles='$vehicleId'";
        $result = $mysqli->query($sql);
        
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $vehicleStatus = $row['status']; // assign the vehicle status to a variable

          // Now you have the vehicle status, you can use it as needed
          // For example, you can echo it here:
          echo "Selected vehicle's status: " . $vehicleStatus;
        } else {
          echo "No bookings found for the selected vehicle.";
        }
      } else {
        echo "Selected vehicle not found in the database.";
      }
    }
  }


} else {
  // Kullanıcı oturumu açık değilse, burada başka işlemleri yapabilirsiniz
}
?>

<body>
  <section id="tracking-form">
    <head>
      <link rel="stylesheet" type="text/css" href="userpagecss/stylebooking.css">
      <style>
        .custom-margin {
          margin-top: 200px;
        }
      </style>
    </head>
    <div class="container">
      <div class="row justify-content-center custom-margin"> <!-- bootstrap -->
        <div class="col-lg-6">
          <div class="checkout-item">
            <h2>Choose your vehicle</h2>
            <div class="checkout-one">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="license">License</label>
                  <select class="form-control" id="license" name="license" required>
                    <?php
                    if (isset($vehicles) && $vehicles->num_rows > 0) {
                      while ($row = $vehicles->fetch_assoc()) {
                        echo "<option value=\"" . $row['license'] . "\">" . $row['license'] . "</option>";
                      }
                    } else {
                      echo "<option value=\"\">No licenses available</option>";
                    }
                    ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Check Vehicle Status</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

<?php include "footer.php"; ?>
