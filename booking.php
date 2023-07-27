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
    $date = $_POST["date"];
    $serviceType = $_POST['service_type'];
    $service_description = $_POST['service_description'];
    


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

    $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
    $result = $mysqli->query($sql);

   
    if ($result->num_rows > 0) {
      // Müşteri bulundu, ID'yi al
      $row = $result->fetch_assoc();
      $customerId = $row['idcustomers']; // Bu idyi gerekli değişkene ata
    }

    $sql = "SELECT idvehicles FROM vehicles WHERE idcustomers='$customerId'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // Müşteri bulundu, ID'yi al
  $row = $result->fetch_assoc();
  $vehicleId = $row['idvehicles']; // Bu idyi gerekli değişkene ata
} 
    $idMechanic = rand(1, 4);
    $status = "aaa";
    $sql = "INSERT INTO bookings (idcustomers, idvehicles, booking_date, service_id, customer_note, id_mechanics, status)
            VALUES ('$customerId', '$vehicleId', '$date' , '$serviceId', '$service_description', '$idMechanic', '$status' )";
  
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

        <label for="date">Tarih:</label>
        <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>

        <script>
            document.getElementById("date").addEventListener("change", function() {
                var selectedDate = new Date(this.value);
                var dayOfWeek = selectedDate.getDay(); // 0 (Pazar) ile 6 (Cumartesi) arasında bir değer döndürür

                if (dayOfWeek == 0) {
                    this.value = ""; // Seçilen tarihi temizle
                    alert("Oops! Ger's Garage is not open on Sundays");
                }
            });
        </script>

        <label for="service_description">Service Description:</label>
        <textarea id="service_description" name="service_description"></textarea>
<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        var serviceDescription = document.getElementById("service_description").value;

        if (serviceDescription.trim() === "") {
            event.preventDefault(); // Formun gönderilmesini engelle
            alert("Please fill up the description part");
        }
    });
</script>
        <input type="submit" value="Submit">
    </form>
</section>

<!-- Diğer içerikler buraya eklenebilir -->

<footer>
    <p>&copy; 2023 Ger's Garage. </p>
</footer>
