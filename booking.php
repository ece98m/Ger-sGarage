<?php include "header.php"; ?>

<?php 

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

?>




<section id="booking">
<head>

    <link rel="stylesheet" type="text/css" href="stylebooking.css">
</head>
    <h2>Book Your Service or Repair</h2>

    <form action="" method="post">
   

        <label for="contact_email">Contact Email:</label>
        <input type="email" id="contact_email" name="contact_email" required>

        <label for="vehicle_type">Vehicle Type:</label>
        <select id="vehicle_type" name="vehicle_type" required>
            <option value="motorbike">Motorbike</option>
            <option value="car">Car</option>
            <option value="small_van">Small Van</option>
            <option value="small_bus">Small Bus</option>
        </select>

        <label for="vehicle_make">Vehicle Make:</label>
        <select id="vehicle_make" name="vehicle_make" required>
            <!-- -->
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
            <option value="diesel">Diesel</option>
            <option value="petrol">Petrol</option>
            <option value="hybrid">Hybrid</option>
            <option value="electric">Electric</option>
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
