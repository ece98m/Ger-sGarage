<?php
require '../userpages/connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date'])) {
    $dateText = $_POST['date']; // Make sure to sanitize and validate this input.
    // ...
}

  
    // Database'den mekaniklerin isimlerini al
    $sql_parts = "SELECT part_id, part_name, price FROM parts";
    $result_parts = $mysqli->query($sql_parts);
    $parts = [];
    if ($result_parts->num_rows > 0) {
        while($row = $result_parts->fetch_assoc()) {
            $parts[$row['part_id']] = $row['part_name'] . ' ' . $row['price'];
        }
    } 
 


  
    $sql = "SELECT b.idbookings, c.firstname, c.surname, c.mobile_phone, v.vehicle_type, v.license, b.booking_date, s.service_name, s.fixed_price
            FROM bookings b
            INNER JOIN customers c ON b.idcustomers = c.idcustomers
            INNER JOIN vehicles v ON b.idvehicles = v.idvehicles
            INNER JOIN services s ON b.service_id = s.service_id
            WHERE booking_date=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $dateText);
    $stmt->execute();
    $bookings = $stmt->get_result();




    if ($bookings->num_rows > 0) {
        echo '<form action="update_bookings.php" method="POST">
            <table>
                <tr>
                  <th>booking id</th>
                  <th>customer name</th>
                  <th>customer phone number</th>
                  <th>vehicle type</th>
                  <th>license</th>
                  <th>book date</th>
                  <th>service name</th>
                  <th>service cost</th>
                </tr>';

        while ($row = $bookings->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['idbookings'] . '</td>
                    <td>' . $row['firstname'] . ' ' . $row['surname'] . '</td>
                    <td>' . $row['mobile_phone'] . '</td>
                    <td>' . $row['vehicle_type'] . '</td>
                    <td>' . $row['license'] . '</td>
                    <td>' . $row['booking_date'] . '</td>
                    <td>' . $row['service_name'] . '</td>
                    <td>' . $row['fixed_price'] . '</td>
              </tr>';
        }

        echo '</table>
     
        </form>';
    } else {
        echo 'NO BOOKINGS FOR THIS DAY.';
    }


if(empty($_POST["selected_parts"])) {
?>

<head>
    <title>Add Product on Invoice</title>
</head>
<body>
    <form method="post" action="" id="booking_last">
        <label for="booking_id">Booking ID:</label>
        <input type="text" name="booking_id" id="booking_id" required>
        <br>
        <label>Parts and Products:</label><br>
        <?php
        foreach($parts as $part_id => $part_name) {
            echo '<input type="checkbox" name="selected_parts[]" value="' . $part_id . '"> ' . $part_name . '<br>';
        }
        ?>
        <br>
        <input type="submit" name="submit" value="Add on Receipt">
    </form>
    
    <div class="invoice-area"></div>
</body>

<script>
    $(document).ready(function() {
        $("#booking_last").on("submit", function(e) {
            e.preventDefault();
            var formValues= $(this).serialize();
            

            $.ajax({
            url: 'get_details_last.php',
            type: 'POST',
            data: formValues,
            dataType: 'html', 
            success: function(data) {
                $('.invoice-area').html(data);
            }
            });
        });
    });
</script>
<?php } else { ?>
alert
<?php } ?>
