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

    
  
}
?>

  
 
   
    <head>
    <title>Autoservice</title>
    <link rel="stylesheet" type="text/css" href="styleprofile.css">
  

    <header>
  <link rel="stylesheet" type="text/css" href="styleprofile.css">
    <h1>Welcome, <?php echo $email; ?> </h1>
    <h3>
    <section id="buttons">
    <button onclick="location.href='profile.php';">My Reservations</button>
    <button onclick="location.href='my_vehicles.php';">My Vehicles</button>
  </section></h3>
    
  </header>

 
  <button onclick="location.href='booking.php';">BOOK NOW</button>

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



<!-- Diğer içerikler buraya eklenebilir -->
<?php include "footer.php"; ?>
