
<?php include "header.php" ;  ?>
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

  // İstenen form verilerini almak
  $vehicleType = $_POST['vehicle_type'];
  $vehicleMake = $_POST['vehicle_make'];
  $vehicleLicense = $_POST['vehicle_license'];
  $vehicleEngineType = $_POST['vehicle_engine_type'];

  // Müşteri ID'sini bulmak için sorguyu oluştur$sql = "SELECT idcustomers FROM customers WHERE email='$email'";

  $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // Müşteri bulundu, ID'yi al
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; //bu idyi gerekli değişkene ata 
  }

    
  
}

?>

<!-- Page Title -->
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
                            <i class='bx bx-chevron-right'></i>
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
                        <tbody>
                            <tr>
                                <th class="table-item" scope="row">
                                    <img src="assets/img/home-one/parts/1.png" alt="Parts">
                                </th>
                                <td>Audeck Tyre 200</td>
                                <td>$120.00</td>
                                <td>
                                    <a href="#">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-item" scope="row">
                                    <img src="assets/img/home-one/parts/2.png" alt="Parts">
                                </th>
                                <td>Audeck Gear 200</td>
                                <td>$110.00</td>
                                <td>
                                    <a href="#">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-item" scope="row">
                                    <img src="assets/img/home-one/parts/3.png" alt="Parts">
                                </th>
                                <td>Audeck Seat 200</td>
                                <td>$130.00</td>
                                <td>
                                    <a href="#">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-item" scope="row">
                                    <img src="assets/img/home-one/parts/4.png" alt="Parts">
                                </th>
                                <td>Audeck Engine 200</td>
                                <td>$150.00</td>
                                <td>
                                    <a href="#">
                                        <i class='bx bx-x'></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="shop-back">
                        <a href="#">Go for Order?</a>
                    </div>
                    <div class="total-shopping">
                        <h2>Total Order</h2>
                        <h3>Total: <span>$510.00</span></h3>
                        <a href="checkout.html">Checkout Items</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Cart -->
 
  

    <section id="my-reservations">
      <h2>My Reservations</h2>
      <table>
        <tr>
          <th>Vehicle Type</th>
          <th>Vehicle Make</th>
          <th>Vehicle License Details</th>
          <th>Vehicle Engine Type</th>
          <th>Status</th>
        </tr>
        <tr>
          <td>Motorbike</td>
          <td>Audi</td>
          <td>ABC 123</td>
          <td>Diesel</td>
          <td>Approved</td>
        </tr>
        <!-- Other reservations can be added here -->
      </table>
    </section>
    <button id='bookbutton' onclick="location.href='booking.php';">BOOK NOW</button>
  </main>

  <footer>
    <p>Telif Hakkı &copy; 2023 Autoservice</p>
  </footer>



<!-- Diğer içerikler buraya eklenebilir -->
<?php include "footer.php"; ?>
