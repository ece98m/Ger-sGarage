<?php
require "../userpages/connection.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 foreach ($_POST as $key => $value) {
  $k = strpos($key, "mechanic_");
  $booking_id = substr($key, strlen("mechanic_"));
  $mechanic_id = $value;
  
  

  $status_key = "status_" . $booking_id;
  if (isset($_POST[$status_key])) {
   $status_id = $_POST[$status_key];
   

   // Update booking in the database
   $sql = "UPDATE bookings SET id_mechanics=?, status=? WHERE idbookings=?";
   $stmt = $mysqli->prepare($sql);

   // Adjust the bind_param based on data types
   $stmt->bind_param("iii", $mechanic_id, $status_id, $booking_id);

   $stmt->execute();

  
  }
 }
}

header("Location: main.php?page=bookings");
exit();

?>
