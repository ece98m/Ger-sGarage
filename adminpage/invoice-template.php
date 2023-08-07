<?php
require "../userpages/connection.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

// Check if the 'id' parameter exists in the URL
if (isset($_GET["id"])) {
 // Get the 'id' value from the URL and sanitize it
 $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

 $sql = "SELECT b.idbookings, c.firstname, c.surname, c.mobile_phone, v.vehicle_type, v.license, b.booking_date, s.service_name, s.fixed_price, 
    GROUP_CONCAT(pt.part_name) as part_names, GROUP_CONCAT(pt.price) as part_prices
    FROM bookings b
    INNER JOIN customers c ON b.idcustomers = c.idcustomers
    INNER JOIN vehicles v ON b.idvehicles = v.idvehicles
    INNER JOIN services s ON b.service_id = s.service_id
    LEFT JOIN part_cost pc ON b.idbookings = pc.bill_id
    LEFT JOIN parts pt ON pc.part_id = pt.part_id
    WHERE b.idbookings = ?
    GROUP BY b.idbookings, c.firstname, c.surname, c.mobile_phone, v.vehicle_type, v.license, b.booking_date, s.service_name, s.fixed_price";
 $stmt = $mysqli->prepare($sql);
 $stmt->bind_param("i", $id);
 $stmt->execute();
 $bookings = $stmt->get_result();

 if ($bookings->num_rows > 0) {
  $row = $bookings->fetch_assoc();
  // Display the data

  echo '
     <!DOCTYPE html>
<html>
<head>
 <title>Invoice</title>
 <style>
  /* Common invoice styles */
  body {
   font-size: 16px;
   padding: 0 100px;
  }

  table {
   width: 100%;
   border-collapse: collapse;
  }

  table tr td {
   padding: 0;
  }

  table tr td:last-child {
   text-align: right;
  }

  .bold {
   font-weight: bold;
  }

  .right {
   text-align: right;
  }

  .large {
   font-size: 1.75em;
  }

  .total {
   font-weight: bold;
   color: #fb7578;
  }

  .logo-container {
   margin: 20px 0 70px 0;
  }

  .invoice-info-container {
   font-size: 0.875em;
  }

  .invoice-info-container td {
   padding: 4px 0;
  }

  .client-name {
   font-size: 1.5em;
   vertical-align: top;
  }

  .line-items-container {
   margin: 70px 0;
   font-size: 0.875em;
  }

  .line-items-container th {
   text-align: left;
   color: #999;
   border-bottom: 2px solid #ddd;
   padding: 10px 0 15px 0;
   font-size: 0.75em;
   text-transform: uppercase;
  }

  .line-items-container th:last-child {
   text-align: right;
  }

  .line-items-container td {
   padding: 15px 0;
  }

  .line-items-container tbody tr:first-child td {
   padding-top: 25px;
  }

  .line-items-container.has-bottom-border tbody tr:last-child td {
   padding-bottom: 25px;
   border-bottom: 2px solid #ddd;
  }

  .line-items-container.has-bottom-border {
   margin-bottom: 0;
  }

  .line-items-container th.heading-quantity {
   width: 50px;
  }

  .line-items-container th.heading-price {
   text-align: right;
   width: 100px;
  }

  .line-items-container th.heading-subtotal {
   width: 100px;
  }

  .payment-info {
   width: 38%;
   font-size: 0.75em;
   line-height: 1.5;
  }

  .footer {
   margin-top: 100px;
  }

  .footer-thanks {
   font-size: 1.125em;
  }

  .footer-thanks img {
   display: inline-block;
   position: relative;
   top: 1px;
   width: 16px;
   margin-right: 4px;
  }

  .footer-info {
   float: right;
   margin-top: 5px;
   font-size: 0.75em;
   color: #ccc;
  }

  .footer-info span {
   padding: 0 5px;
   color: black;
  }

  .footer-info span:last-child {
   padding-right: 0;
  }

  /* Custom PDF styles */
  @media print {
   body {
    padding: 0;
   }

   .pdf-container {
    padding: 20px;
   }

   .page-container {
    display: block;
    text-align: right;
    font-size: 12px;
    margin-bottom: 10px;
   }
   .logo-container img {
    max-height: 50px;
   }

   .footer-info {
    font-size: 12px;
   }
  }
 </style>
</head>
<body>
<div class="pdf-container" style="padding-left:100px;padding-right:100px;">
 <div class="logo-container">
  <img
   style="height: 18px"
   src="https://app.useanvil.com/img/email-logo-black.png"
  >
 </div>

 <table class="invoice-info-container">
 <tr>
  <td rowspan="2" class="client-name">
   Client Name
  </td>
  <td>
  ' .
   $row["firstname"] .
   " " .
   $row["surname"] .
   '
  </td>
 </tr>
 <tr>
 <td>
 Phone: <strong>' .
   $row["mobile_phone"] .
   '</strong>
 </td>
 </tr>
 <tr>
  <td>
  Vehicle: <strong>' .
   $row["vehicle_type"] .
   '</strong>
  </td>
  <td>
  License: <strong>' .
   $row["license"] .
   '</strong>
  </td>
 </tr>
 <tr>
  <td>
  Booking Date: <strong>' .
   $row["booking_date"] .
   ' </strong>
  </td>
  <td>
   hello@ece.com
  </td>
 </tr>
</table>


<table class="line-items-container">
 <thead>
  <tr>
   <th class="heading-quantity">Qty</th>
   <th class="heading-description">Name</th>
   <th class="heading-price">Price</th>
  </tr>
 </thead>
 <tbody>
  <tr>
   <td>1</td>
   <td>' .
   $row["service_name"] .
   '</td>
   <td class="right">$' .
   $row["fixed_price"] .
   '</td>
  </tr>';
  // Check if part information is available
  if ($row["part_names"] && $row["part_prices"]) {
   $partNames = explode(",", $row["part_names"]);
   $partPrices = explode(",", $row["part_prices"]);

   $totalCost = $row["fixed_price"] + array_sum($partPrices);

   for ($i = 0; $i < count($partNames); $i++) {
    echo ' <tr>
     <td>1</td>
     <td>' .
     $partNames[$i] .
     '</td>
     <td class="right">$' .
     $partPrices[$i] .
     '</td>
    </tr>';
   }
   echo '</tbody>
</table>


<table class="line-items-container has-bottom-border">
 <thead>
  <tr>
   <th>Payment Info</th>
   <th>Due By</th>
   <th>Total Due</th>
  </tr>
 </thead>
 <tbody>
  <tr>
   <td class="payment-info">
    <div>
     Account No: <strong>123567744</strong>
    </div>
    <div>
     Routing No: <strong>120000547</strong>
    </div>
   </td>
   <td class="large">May 30th, 2024</td>
   <td class="large total">$' .
    $totalCost .
    '</td>
  </tr>
 </tbody>
</table>

<div class="footer">
 <div class="footer-info">
  <span>ece@fatma.com</span> |
  <span>555 444 6666</span> |
  <span>ecekalistan.com</span>
 </div>
 <div class="footer-thanks">
  <span>Thank you!</span>
 </div>
</div>
 </div>
</body>
</html>
     ';
   // End capturing the HTML content
   $htmlContent = ob_get_clean();
   header("Content-Type: text/html");
   echo $htmlContent;
  }
 } else {
  echo "No results found.";
 }
} else {
 // If 'id' parameter is not provided, return an error response
 header("HTTP/1.1 400 Bad Request");
 echo "Error: ID parameter missing in the request.";
}
?>


 ?>