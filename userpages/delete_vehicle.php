<?php include "header.php"; ?>

<?php

/* session_start(); */

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $vehicleId = $_GET['id'];

    // Construct the SQL query to delete the vehicle from the database
    $deleteSql = "DELETE FROM vehicles WHERE idvehicles = $vehicleId";

    // Execute the delete query
    if ($mysqli->query($deleteSql) === true) {
        // Vehicle deleted successfully, redirect back to the user's profile page
        header("Location: profile.php"); 
        exit();
    } else {
        // Error occurred while deleting the vehicle
        echo "Error. Unsuccessful: " . $mysqli->error;
    }
} else {
    
    // If the request is not valid or no vehicle ID is provided
 
    echo "Invalid request or missing vehicle ID.";
}
?>
