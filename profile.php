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

  // Müşteri ID'sini bulmak için sorguyu oluştur$sql = "SELECT idcustomers FROM customers WHERE email='$email'";

  $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // Müşteri bulundu, ID'yi al
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; //bu idyi gerekli değişkene ata 
  }
     
  $errors = array();

  if(empty($vehicleType) || $vehicleType == 'select') {
      $errors[] = "Please select the vehicle type";
  }
  
  if(empty($vehicleMake) || $vehicleMake == 'select') {
      $errors[] = "Please select the vehicle make";
  }
  
  if(empty($vehicleLicense)) {
      $errors[] = "Please enter the vehicle license details";
  }
  
  if(empty($vehicleEngineType) || $vehicleEngineType == 'select') {
      $errors[] = "Please select the vehicle engine type";
  }
  
    if(empty($errors)) {
    // vehicles tablosuna yeni kayıt ekleme
    $sql = "INSERT INTO vehicles (idcustomers, vehicle_type, make, license, engine_type)
    VALUES ('$customerId', '$vehicleType', '$vehicleMake', '$vehicleLicense', '$vehicleEngineType')";
    if ($mysqli->query($sql) === true) {
      $vehicleId = $mysqli->insert_id; //eklenen aracın id sini booking tablosuna eklemek için çekme
      $successMessage = "Yeni araç eklendi. Araç ID'si: " . $vehicleId; // Başarı mesajını güncelle
    } else {
      echo "Araç ekleme hatasi: " . $mysqli->error;
    }
  }
  
}
?>


<section id="">

  <head>
    <title>Autoservice</title>
    <link rel="stylesheet" type="text/css" href="styleprofile.css">
  </head>

  <header>
    <h1>Profile</h1>
    <h3>Welcome, <?php echo $email; ?></h3>

  </header>

  <main>
    <section id="add-vehicle">
      <h2>Add Your Vehicle</h2>
      <form action="" method="POST">
      <?php 
                if(!empty($errors)): foreach ($errors as $key => $value) { ?>
                <div class="alert alert-warning" role="alert">
                    <?=$value?>
                </div>
                <?php } endif; ?>

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

  </main>

  <footer>
    <p>Telif Hakkı &copy; 2023 Autoservice</p>
  </footer>


</section>

<!-- Diğer içerikler buraya eklenebilir -->
<?php include "footer.php"; ?>
