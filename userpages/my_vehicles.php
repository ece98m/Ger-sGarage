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
  // İstenen form verilerini almak
  $vehicleType = $_POST['vehicle_type'];
  $vehicleMake = $_POST['vehicle_make'];
  $vehicleLicense = $_POST['vehicle_license'];
  $vehicleEngineType = $_POST['vehicle_engine_type'];

  // Müşteri ID'sini bulmak için sorguyu oluştur
  $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // Müşteri bulundu, ID'yi al
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; // Bu idyi gerekli değişkene ata
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

    // vehicles tablosuna yeni kayıt ekleme
    $sql = "INSERT INTO vehicles (idcustomers, vehicle_type, make, license, engine_type)
            VALUES ('$customerId', '$vehicleType', '$vehicleMake', '$vehicleLicense', '$vehicleEngineType')";
    if ($mysqli->query($sql) === true) {
      $vehicleId = $mysqli->insert_id; // Eklenen aracın ID'sini booking tablosuna eklemek için çekme
      $successMessage = "Yeni araç eklendi. Araç ID'si: " . $vehicleId; // Başarı mesajını güncelle
    } else {
      echo "Araç ekleme hatası: " . $mysqli->error;
    }
  }
}

?>

  <header>
  <link rel="stylesheet" type="text/css" href="userpagecss/stylemyvehicles.css">
    <h1>Welcome, <?php echo $email; ?> </h1>
    <h3>
    <section id="buttons">
    <button onclick="location.href='profile.php';">My Reservations</button>
    <button onclick="location.href='my_vehicles.php';">My Vehicles</button>
  </section></h3>
    
  </header>

  

<main>
  
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

   if ($vehicles->num_rows > 0) {
     echo '<table>
             <tr>
               <th>Vehicle Type</th>
               <th>Make</th>
               <th>License</th>
               <th>Engine Type</th>
             </tr>';

     while ($row = $vehicles->fetch_assoc()) {
       echo '<tr>
               <td>' . $row['vehicle_type'] . '</td>
               <td>' . $row['make'] . '</td>
               <td>' . $row['license'] . '</td>
               <td>' . $row['engine_type'] . '</td>
             </tr>';
     }

     echo '</table>';
   } else {
     echo 'NO VEHICLE RECORD ON YOUR ACCOUNT. PLEASE REGISTER YOUR VEHICLE DETAILS.';
   }
 ?>
</section>

  <section id="add-vehicle">
    <h2>Add Your Vehicle</h2>
    <form action="" method="POST">
      <?php
        if (!empty($errors)):
          foreach ($errors as $key => $value) {
      ?>
            <div class="alert alert-warning" role="alert">
              <?=$value?>
            </div>
      <?php
          }
        endif;
      ?>

      <label for="vehicle_type">Vehicle Type:</label>
      <select id="vehicle_type" name="vehicle_type" required>
        <option value="select">Please select</option>
        <option value="motorbike">Motorbike</option>
        <option value="car">Car</option>
        <option value="small_van">Small Van</option>
        <option value="small_bus">Small Bus</option>
      </select>

      <label for="vehicle_make">Vehicle Make:</label>
      <select id="vehicle_make" name="vehicle_make" required>
        <option value="select">Please select</option>
        <option value="audi">Audi</option>
        <option value="bmw">BMW</option>
        <!-- More car makes -->
        <option value="mercedes">Mercedes</option>
        <!--  -->
      </select>

      <label for="vehicle_license">Vehicle License Details:</label>
      <input type="text" id="vehicle_license" name="vehicle_license" required>

      <label for="vehicle_engine_type">Vehicle Engine Type:</label>
      <select id="vehicle_engine_type" name="vehicle_engine_type" required>
        <option value="select">Please select</option>
        <option value="diesel">Diesel</option>
        <option value="petrol">Petrol</option>
        <option value="hybrid">Hybrid</option>
        <option value="electric">Electric</option>
      </select>

      <button type="submit">Add Vehicle</button>
    </form>

    <?php if (!empty($successMessage)) : ?>
      <div class="success-message">
        <?php echo $successMessage; ?>
      </div>
    <?php endif; ?>
  </section>


<footer>
  <p>Telif Hakkı &copy; 2023 Autoservice</p>
</footer>

<!-- Diğer içerikler buraya eklenebilir -->
<?php include "footer.php"; ?>