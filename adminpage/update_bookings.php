<?php
require '../userpages/connection.php';
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'mechanic_') === 0) {
            $booking_id = substr($key, strlen('mechanic_'));
            $mechanic_id = $value;

            if (isset($_POST['status_' . $booking_id])) {
                $status_id = $_POST['status_' . $booking_id];

                // Update booking in the database
                $sql = "UPDATE bookings SET id_mechanics=?, status=? WHERE idbookings=?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ssi", $mechanic_id, $status_id, $booking_id);
                $stmt->execute();
         
                if ($stmt->error) {
                    echo "ERROR: Could not able to execute $sql. " . $stmt->error;
                } else {
                    echo "Reservations updated successfully.";
                }
            }
        }
    }
}

?>
