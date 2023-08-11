<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "../userpages/connection.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $dateText = $_POST["date"]; // Make sure to sanitize and validate this input.

 
 $sql_mechanics = "SELECT id_mechanics, firstname, surname FROM mechanics";
 $result_mechanics = $mysqli->query($sql_mechanics);
 $mechanics = [];
 if ($result_mechanics->num_rows > 0) {
  while ($row = $result_mechanics->fetch_assoc()) {
   $mechanics[$row["id_mechanics"]] =
    $row["firstname"] . " " . $row["surname"];
  }
 }

 // get the status from database
 $sql_status = "SELECT Status_ID, Status_Name FROM booking_statuses";
 $result_status = $mysqli->query($sql_status);
 $status = [];
 if ($result_status->num_rows > 0) {
  while ($row = $result_status->fetch_assoc()) {
   $status[$row["Status_ID"]] = $row["Status_Name"];
  }
 }

 $sql = "SELECT b.idbookings, c.firstname, c.surname, v.vehicle_type, b.booking_date, s.service_name, b.customer_note, b.status, b.id_mechanics
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
  echo '
    <form action="update_bookings.php" method="POST">
    <div class="row">
    <div class="col-12 px-4">
    <button type="submit" value="Update Bookings" class="btn bg-gradient-primary right mb-0" style="float:right">Update</button>
    </div>
    <div class="col-12">
    <div class="card mb-4 mx-4 my-4">
      <div class="card-header pb-0">
       <h6>Reservations</h6>
      </div>
    <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
    <table class="table align-items-center mb-0">
    <thead>
     <tr>
     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking Id</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vehicle Type</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Booking Date</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service</th>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Note</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mechanic Name</th>
      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
      <th class="text-secondary opacity-7"></th>
     </tr>
    </thead>
    <tbody>';
  while ($row = $bookings->fetch_assoc()) {
   echo '
     <tr>
      <td class="align-middle text-center">
       <span class="text-secondary text-xs font-weight-bold">' .
    $row["idbookings"] .
    '</span>
      </td>
      <td>
       <div class="d-flex px-2 py-1">
        <div>
         <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
        </div>
        <div class="d-flex flex-column justify-content-center">
         <h6 class="mb-0 text-sm">' .
    $row["firstname"] .
    " " .
    $row["surname"] .
    '</h6>
        </div>
       </div>
      </td>
      <td>
       <p class="text-xs font-weight-bold mb-0">' .
    $row["vehicle_type"] .
    '</p>
      </td>
      <td>
       <p class="text-xs font-weight-bold mb-0">' .
    $row["booking_date"] .
    '</p>
      </td>
      <td>
       <p class="text-xs font-weight-bold mb-0">' .
    $row["service_name"] .
    '</p>
      </td>
      <td>
       <p class="text-xs font-weight-bold mb-0">' .
    $row["customer_note"] .
    '</p>
      </td>
      <td class="align-middle text-center text-sm">
      <select class="btn bg-gradient-dark dropdown-toggle" name="mechanics' .
    $row["idbookings"] .
    '" style="    padding: 0.2rem 0;
      margin-bottom: 0;
      text-align: center;
      width: 100px;">';
   foreach ($mechanics as $id => $name) {
    $selected = $id == $row["id_mechanics"] ? "selected" : ""; // Check if the mechanic ID matches the currently assigned mechanic
    echo "<option value='$id' $selected>$name</option>";
   }
   echo '</ul>
     </select>
     </td>
      <td class="align-middle text-center text-sm">
      <select class="btn bg-gradient-success dropdown-toggle" name="status_' .
    $row["idbookings"] .
    '" style="    padding: 0.2rem 0;
      margin-bottom: 0;
      text-align: center;
      width: 100px;">';
   foreach ($status as $id => $name) {
    $selected = $id == $row["status"] ? "selected" : ""; // Check if the mechanic ID matches the currently assigned mechanic
    echo "<option value='$id' $selected>$name</option>";
   }
   echo '</ul>
     </select>
     </td>
      <td class="align-middle">
       <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
        Edit
       </a>
      </td>
     </tr>';
  }

  echo '</tbody>
   </table>
   </div>
   <div>
   </div>
   </div>
   </div>
   </form';
 } else {
  echo "NO BOOKINGS FOR THIS DAY.";
 }
}
?>
