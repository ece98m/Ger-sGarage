<?php
// Bağlantıyı include edin ve session_start() işlemini ekleyin
/* include "connection.php"; */
include '../userpages/connection.php';
require 'helpers.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!-- admin-booking.php -->

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="admincss/styleadminbooking.css">
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <style>
    /* Add any additional CSS styles specific to your admin booking page here */
  </style>
</head>

<body>
  <h1>Welcome to Ger's Garage Admin Page</h1>
  <p>Select a date:</p>
  <input type="text" id="datepicker">

  <!-- Add a container element with ID "bookings" -->
  <div id="bookings"></div>

  <!-- Add a select element for mechanics -->
  <label for="mechanicSelect">Select a mechanic:</label>
  <select id="mechanicSelect">
    <?php echo getMechanicsOptions(); ?>
  </select>
  <button id="assignMechanicBtn">Assign Mechanic</button>

  <!-- Your JavaScript code goes here -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script>
    $(function() {
      $("#datepicker").datepicker({
        onSelect: function(dateText, inst) {
          // Convert the date format to 'yyyy-mm-dd' before sending the data
          var formattedDate = formatDate(dateText);
          console.log("Selected date:", formattedDate);
          // Function to format the date as 'yyyy-mm-dd'

          $.ajax({
            url: 'get_bookings.php',
            type: 'POST',
            data: { date: formattedDate },
            dataType: 'html', // Change dataType to 'html' as we are returning HTML from the server
            success: function(data) {
              $('#bookings').html(data);
            }
          });
        }
      });

      // Function to format the date as 'yyyy-mm-dd'
      function formatDate(dateText) {
        var parts = dateText.split('/');
        return parts[2] + '-' + parts[0].padStart(2, '0') + '-' + parts[1].padStart(2, '0');
      }

      // Assign mechanic to booking
      $("#assignMechanicBtn").click(function() {
        var selectedDate = $("#datepicker").val();
        var selectedMechanic = $("#mechanicSelect").val();

        $.ajax({
          url: 'assign_mechanic.php',
          type: 'POST',
          data: {
            date: selectedDate,
            mechanicId: selectedMechanic
          },
          success: function(response) {
            alert(response); // Show any response message from the server
            // Refresh the bookings table
            $("#datepicker").trigger("change");
          }
        });
      });
    });
  </script>
</body>

</html>
