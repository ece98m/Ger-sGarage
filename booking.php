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

    $contactEmail = $_POST['contact_email'];

    $vehicleType = $_POST['vehicle_type'];
    $vehicleMake = $_POST['vehicle_make'];
    $vehicleLicense = $_POST['vehicle_license'];
    $vehicleEngineType = $_POST['vehicle_engine_type'];

    $serviceType = $_POST['service_type'];
    $service_description = $_POST['service_description'];

    // Müşteri ID'sini bulmak için sorguyu oluştur
    $sql = "SELECT idcustomers FROM customers WHERE email='$contactEmail'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        // Müşteri bulundu, ID'yi al
        $row = $result->fetch_assoc();
        $customerId = $row['idcustomers']; //bu idyi gerekli değişkene ata 

        // vehicles tablosuna yeni kayıt ekleme
        $sql = "INSERT INTO vehicles (idcustomers, vehicle_type, make, license, engine_type)
        VALUES ('$customerId', '$vehicleType', '$vehicleMake', '$vehicleLicense', '$vehicleEngineType')";
        if ($mysqli->query($sql) === true) {
            $vehicleId = $mysqli->insert_id; //eklenen aracın id sini booking tablosuna eklemek için çekme
            echo "Yeni araç eklendi. Araç ID'si: " . $vehicleId;
        } else {
            echo "Araç ekleme hatasi: " . $mysqli->error;
        }
    } else {
        echo "No customer registered with this email before.";
    }

    // Servis ID'sini bulmak için sorguyu oluştur
    $sql = "SELECT service_id FROM services WHERE service_name='$serviceType'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        // Servis bulundu, ID'yi al
        $row = $result->fetch_assoc();
        $serviceId = $row['service_id'];

        echo "service ID'si: " . $serviceId;
    } else {
        echo "NO SERVICE HAS BEEN FOUND.";
    }

    $idMechanic = rand(1, 4);
    $bookingDate = date("Y-m-d");
    $status = "aaa";
    $sql = "INSERT INTO bookings (idcustomers, idvehicles, booking_date, service_id, customer_note, id_mechanics, status)
            VALUES ('$customerId', '$vehicleId', '$bookingDate' , '$serviceId', '$service_description', '$idMechanic', '$status' )";

    if ($mysqli->query($sql) === true) {
        echo "Yeni rezervasyon başarıyla eklendi.";
    } else {
        echo "Rezervasyon ekleme hatası: " . $mysqli->error;
    }
} 

// services tablosundan tüm satırları almak için sorguyu oluştur
$sql = "SELECT service_id, service_name FROM services";
$list = $mysqli->query($sql);

$sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // Müşteri bulundu, ID'yi al
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; // Bu idyi gerekli değişkene ata
  }
// services tablosundan tüm satırları almak için sorguyu oluştur
   
$sql = "SELECT * FROM vehicles WHERE idcustomers='$customerId'";
$licenses = $mysqli->query($sql);
?>




<section id="booking">
<head>

    <link rel="stylesheet" type="text/css" href="stylebooking.css">
</head>
    <h2>Book Your Service or Repair</h2>

    <form action="" method="post">
   

     
        <label for="vehicle_type">Choose Your Vehicle </label>
        <select id="vehicle_type" name="vehicle_type" required>
         <?php
            if ($licenses->num_rows > 0) {
                while ($row = $licenses->fetch_assoc()) {
                    echo "<option value=\"" . $row['license'] . "\">" . $row['license'] . "</option>";
                }
            } else {
                echo "No services available";
            }
            ?>
        </select>



        <label for="service_type">Service Type:</label>
        <select id="service_type" name="service_type" required>
            <?php
            if ($list->num_rows > 0) {
                while ($row = $list->fetch_assoc()) {
                    echo "<option value=\"" . $row['service_name'] . "\">" . $row['service_name'] . "</option>";
                }
            } else {
                echo "No services available";
            }
            ?>
        </select>

        <label for="service_description">Service Description:</label>
        <textarea id="service_description" name="service_description"></textarea>

        <input type="submit" value="Submit">
    </form>
</section>

<!-- Diğer içerikler buraya eklenebilir -->




<footer>
    <p>&copy; 2023 Ger's Garage. </p>
</footer
