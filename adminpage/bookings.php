<?php
include '../userpages/connection.php';
/* require 'helpers.php'; */
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
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <style>
    /* Add any additional CSS styles specific to your admin booking page here */
  </style>
</head>

<body>
  <h1>Welcome to Ger's Garage Admin Page</h1>
  <p>Select a date:</p>
  <input type="text" id="datepicker">
  <div id="bookings"></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script>
  $(function() {
    $("#datepicker").datepicker({
      onSelect: function(dateText, inst) {
        var formattedDate = formatDate(dateText);
        console.log("Selected date:", formattedDate);

        $.ajax({
          url: 'get_bookings.php',
          type: 'POST',
          data: { date: formattedDate },
          dataType: 'html', 
          success: function(data) {
            $('#bookings').html(data);
          }
        });
      }
    });

    function formatDate(dateText) {
      var selectedDate = $("#datepicker").datepicker('getDate');
      return $.datepicker.formatDate('yy-mm-dd', selectedDate);
    }
  });
</script>
</body>

</html>
