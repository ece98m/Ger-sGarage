<!-- assign_mechanic.php -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'helpers.php';
require '../userpages/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $dateText = $_POST['date']; // Make sure to sanitize and validate this input.
    $mechanicId = $_POST['mechanicId']; // Make sure to sanitize and validate this input.

    // Get the existing mechanics data for the selected date from the bookings table
    $sql = "SELECT id_mechanics FROM bookings WHERE booking_date = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $dateText);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $existingMechanics = json_decode($data['id_mechanics'], true);

    // Add the new mechanic to the existing mechanics array
    $existingMechanics[] = $mechanicId;

    // Update the 'id_mechanics' field in 'bookings' table for the selected date
    $sql = "UPDATE bookings SET id_mechanics = ? WHERE booking_date = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", json_encode($existingMechanics), $dateText);

    if ($stmt->execute()) {
        echo "Mechanic assigned successfully!";
    } else {
        echo "Failed to assign mechanic.";
    }
}
?>
