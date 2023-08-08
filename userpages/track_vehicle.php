<?php include "header.php"; ?>

<?php

session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];

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
    $licenses = $mysqli->query($sql);
  }
} else {
  // Kullanıcı oturumu açık değilse, burada başka işlemleri yapabilirsiniz
}

?>

<body>

<section id="tracking-form">
  <div class="container">
    <div class="row justify-content-center custom-margin">
      <div class="col-lg-6">
        <div class="checkout-item">
          <h2>Choose your vehicle</h2>
          <div class="checkout-one">
            <form action="" method="post">
              <div class="form-group">
                <label for="vehicle_type">License</label>
                <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                  <?php
                  if (isset($licenses) && $licenses->num_rows > 0) {
                    while ($row = $licenses->fetch_assoc()) {
                      echo "<option value=\"" . $row['license'] . "\">" . $row['license'] . "</option>";
                    }
                  } else {
                    echo "<option value=\"\">No licenses available</option>";
                  }
                  ?>
                </select>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="tracking">
 
 <h3>Your Vehicles</h3>
 
 <?php
$sql = "SELECT idcustomers FROM customers WHERE email='$email'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // Müşteri bulundu, ID'yi al
  $row = $result->fetch_assoc();
  $customerId = $row['idcustomers']; // Bu idyi gerekli değişkene ata
}

// Müşteriye ait araçları sorgula
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
                              <th class="table-head" scope="col">Remove</th>
                          </tr>
                      </thead>
                      <tbody>';

if ($vehicles->num_rows > 0) {
  while ($row = $vehicles->fetch_assoc()) {
    echo '<tr>
            <td>' . $row['vehicle_type'] . '</td>
            <td>' . $row['make'] . '</td>
            <td>$' . $row['license'] . '</td>
            <td>
                <a href="#">
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

 
  </body>
  



<?php include "footer.php"; ?>