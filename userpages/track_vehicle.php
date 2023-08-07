<?php include "header.php"; ?>

<?php

session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
} else {
  // Kullanıcı oturum açmamışsa veya oturumu kapatılmışsa burada ilgili işlemleri yapabilirsiniz
  // Örneğin, oturum açma sayfasına yönlendirme yapabilirsiniz.
}

$successMessage = ""; // Başlangıçta boş bir başarı mesajı


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  // Müşteri ID'sini bulmak için sorguyu oluştur
  $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // Müşteri bulundu, ID'yi al
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; // Bu idyi gerekli değişkene ata
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