<?php
require '../userpages/connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dateText = $_POST['date']; // Make sure to sanitize and validate this input.
  
    // Database'den mekaniklerin isimlerini al
    $sql_mechanics = "SELECT id_mechanics, firstname, surname FROM mechanics";
    $result_mechanics = $mysqli->query($sql_mechanics);
    $mechanics = [];
    if ($result_mechanics->num_rows > 0) {
        while($row = $result_mechanics->fetch_assoc()) {
            $mechanics[$row['id_mechanics']] = $row['firstname'] . ' ' . $row['surname'];
        }
    }
  
    // get the status from database
    $sql_status = "SELECT Status_ID, Status_Name FROM booking_statuses";
    $result_status= $mysqli->query($sql_status );
    $status= [];
    if ($result_status->num_rows > 0) {
        while($row = $result_status->fetch_assoc()) {
            $status[$row['Status_ID']] = $row['Status_Name'] ;
        }
    }

    $sql = "SELECT b.idbookings, c.firstname, c.surname, v.vehicle_type, b.booking_date, s.service_name, b.customer_note, b.status 
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
                  <th>vehicle type</th>
                  <th>book date</th>
                  <th>service name</th>
                  <th>customer note</th>
                  <th>mechanic name</th>
                  <th>status</th>
                </tr>';

        while ($row = $bookings->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['idbookings'] . '</td>
                    <td>' . $row['firstname'] . ' ' . $row['surname'] . '</td>
                    <td>' . $row['vehicle_type'] . '</td>
                    <td>' . $row['booking_date'] . '</td>
                    <td>' . $row['service_name'] . '</td>
                    <td>' . $row['customer_note'] . '</td>
                    <td>
                    <select name="mechanic_' . $row['idbookings'] . '">
                    ';

            foreach ($mechanics as $id => $name) {
                echo "<option value='$id'>$name</option>";
            }

            echo '</select>
                </td>
                <td>
                <select name="status_' . $row['idbookings'] . '">
                ';

            foreach ($status as $id => $name) {
                echo "<option value='$id'>$name</option>";
            }

            echo '</select></td>
              </tr>';
        }

        echo '</table>
     
        <input type="submit" value="Update Bookings">
       
        </form>';
    } else {
        echo 'NO BOOKINGS FOR THIS DAY.';
    }
}
?>
