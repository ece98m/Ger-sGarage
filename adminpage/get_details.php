<?php
require "../userpages/connection.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["date"])) {
 $dateText = $_POST["date"]; // Make sure to sanitize and validate this input.
 // ...
}

// Database'den mekaniklerin isimlerini al
$sql_parts = "SELECT part_id, part_name, price FROM parts";
$result_parts = $mysqli->query($sql_parts);
$parts = [];
if ($result_parts->num_rows > 0) {
 while ($row = $result_parts->fetch_assoc()) {
  $parts[$row["part_id"]] = $row["part_name"] . " " . $row["price"];
 }
}

$sql = "SELECT
b.idbookings,
c.firstname,
c.surname,
c.mobile_phone,
v.vehicle_type,
v.license,
b.booking_date,
s.service_name,
s.fixed_price,
COALESCE(pt_price_sum, 0) + COALESCE(s.fixed_price, 0) AS total_cost
FROM
bookings b
INNER JOIN customers c ON b.idcustomers = c.idcustomers
INNER JOIN vehicles v ON b.idvehicles = v.idvehicles
INNER JOIN services s ON b.service_id = s.service_id
LEFT JOIN (
SELECT
  pc.bill_id,
  SUM(pt.price) AS pt_price_sum
FROM
  part_cost pc
INNER JOIN parts pt ON pc.part_id = pt.part_id
GROUP BY pc.bill_id
) AS part_totals ON b.idbookings = part_totals.bill_id
WHERE
booking_date = ?
GROUP BY
b.idbookings,
c.firstname,
c.surname,
c.mobile_phone,
v.vehicle_type,
v.license,
b.booking_date,
s.service_name,
s.fixed_price,
pt_price_sum;
";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $dateText);
$stmt->execute();
$bookings = $stmt->get_result();

if ($bookings->num_rows > 0) {
 $bookingData = [];
 while ($row = $bookings->fetch_assoc()) {
  $bookingData[] = $row;
 }
 echo '<body>
  <div class="row">
  <div class="col-md-7 mt-4">
   <div class="card">
   <div class="card-header pb-0 px-3">
    <h6 class="mb-0">Billing Information</h6>
   </div>
   <div class="card-body pt-4 p-3">
    <ul class="list-group">';
 foreach ($bookingData as $row) {
  echo '
    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
     <div class="d-flex flex-column">
     <h6 class="mb-3 text-sm">' .
   $row["firstname"] .
   " " .
   $row["surname"] .
   '</h6>
   <span class="mb-2 text-xs">Booking id: <span class="text-dark font-weight-bold ms-sm-2">' .
   $row["idbookings"] .
   '</span></span>
   <span class="mb-2 text-xs">Vehicle: <span class="text-dark font-weight-bold ms-sm-2">' .
   $row["vehicle_type"] .
   '</span></span>
     <span class="mb-2 text-xs">Service: <span class="text-dark ms-sm-2 font-weight-bold">' .
   $row["service_name"] .
   '</span></span>
     <span class="text-xs">Total Cost: <span class="text-dark ms-sm-2 font-weight-bold">$' .
   $row["total_cost"] .
   '</span></span>
     </div>
     <div class="ms-auto text-end">
     <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
     <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
     </div>
    </li>';
 }
 echo '</ul>
   </div>
   </div>
  </div>
  <div class="col-md-5 mt-4">
   <div class="card h-100">
   <div class="card-header pb-0 p-3">
    <div class="row">
    <div class="col-6 d-flex align-items-center">
     <h6 class="mb-0">Invoices</h6>
    </div>
    <div class="col-6 text-end">
     <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
    </div>
    </div>
   </div>
   <div class="card-body p-3 pb-0">
    <ul class="list-group">';
 foreach ($bookingData as $row) {
  echo '
    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
     <div class="d-flex flex-column">
     <h6 class="mb-1 text-dark font-weight-bold text-sm">' .
   $row["firstname"] .
   " " .
   $row["surname"] .
   '</h6>
     <span class="text-xs">#MS-415646</span>
     </div>
     <div class="d-flex align-items-center text-sm">
     $' .
   $row["total_cost"] .
   '
     <button id="pdfBtn_' .
   $row["idbookings"] .
   '" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
     </div>
    </li>';
 }
 echo '</ul>
   </div>
   </div>
  </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
  </body>';
} else {
 echo "NO BOOKINGS FOR THIS DAY.";
}

if (empty($_POST["selected_parts"])) { ?>

<head>
</head>
<body>
<form method="post" action="" id="booking_last">
 <div class="row">
 <div class="col-md-5 mt-4">
   <div class="card h-100 mb-4">
   <div class="card-header pb-0 px-3">
    <div class="row">
    <div class="col-md-6">
     <h6 class="mb-0">Parts And Products</h6>
    </div>
    <div class="col-md-6 d-flex justify-content-end align-items-center">
     <input type="text" class="form-control" placeholder="Booking Id" name="booking_id" id="booking_id" required>
    </div>
    </div>
   </div>
   <div class="card-body pt-4 p-3">
    <ul class="list-group">
    <?php foreach ($parts as $part_id => $part_info) {
     // $part_info contains the part_name and price concatenated with a space.
     // To get the separate name and price, you can use explode function.

     // Explode the part_info using the space as the separator.
     $part_data = explode(" ", $part_info);

     // Get the name and price from the $part_data array.
     $part_name = implode(" ", array_slice($part_data, 0, -1));
     $part_price = end($part_data);

     echo '
   <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
   <div class="d-flex align-items-center">
    <div class="mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><input type="checkbox" name="selected_parts[]" value="' .
      $part_id .
      '"></div>
    <div class="d-flex flex-column">
    <h6 class="mb-1 text-dark text-sm">' .
      $part_name .
      '</h6>
    <span class="text-xs">27 March 2020, at 12:30 PM</span>
    </div>
   </div>
   <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
    $ ' .
      $part_price .
      '
   </div>
   </li>';
    } ?>
    </ul>
    <div class="col-12 px-4">
  <button type="submit" name="submit" value="Add on Receipt" class="btn bg-gradient-primary right mb-0" style="float:right">Update</button>
  </div>
   </div>
   </div>
  </div>
</div>
 </form>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
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

 function generatePDF(id) {
 const script = document.createElement('script');
 script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js';
 script.onload = function () {
  const pdf = new jsPDF();
  const url = 'http://localhost/garage/adminpage/invoice-template.php?id='+id;
  fetch(url)
  .then((response) => response.text())
  .then((html) => {
   html2pdf().from(html).save('pdf_' + id + '.pdf');
  });
 };
 document.head.appendChild(script);
 }

 // Add event listeners to each PDF button
 const buttons = document.querySelectorAll('button[id^="pdfBtn_"]');
 buttons.forEach((button) => {
 const id = button.id.split('_')[1];
 button.addEventListener('click', () => {
  console.log('button clicked...')
  generatePDF(id);
 });
 });
</script>
<?php } else { ?>
alert
<?php }
?>
