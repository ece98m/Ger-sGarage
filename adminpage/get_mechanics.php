<?php
include "../userpages/connection.php";
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

if (isset($_POST["date"])) {
 $selectedDate = $_POST["date"];
 $dates = [];
 for ($i = 0; $i < 6; $i++) {
  $dates[] = date("Y-m-d", strtotime($selectedDate . " + " . $i . " days"));
 }

 $mechanicNames = [];
 foreach ($dates as $date) {
  $sql = "SELECT id_mechanics FROM bookings WHERE booking_date = '$date'";
  $result = mysqli_query($mysqli, $sql);
  $mechanicIdsForTheDay = [];
  if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
    $mechanicIdsForTheDay[] = $row["id_mechanics"];
   }
  }
  $mechanicNames[$date] = $mechanicIdsForTheDay;
 }

 echo '
  <div class="row">
    <div class="col-12">
    <div class="card mb-4 mx-4 my-4">
      <div class="card-header pb-0">
       <h6>Staff Roster</h6>
      </div>
    <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
    <table class="table align-items-center mb-0">
    <thead>
     <tr>
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>';
 foreach ($dates as $date) {
  echo '
      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">' .
   $date .
   "</th>";
 }
 echo '
     </tr>
    </thead>
    <tbody>';

 $allMechanics = [];
 foreach ($mechanicNames as $date => $mechanicIds) {
  foreach ($mechanicIds as $mechanicId) {
   $nameSql = "SELECT firstname, surname FROM mechanics WHERE id_mechanics = '$mechanicId'";
   $nameResult = mysqli_query($mysqli, $nameSql);
   if (mysqli_num_rows($nameResult) > 0) {
    while ($nameRow = mysqli_fetch_assoc($nameResult)) {
     $allMechanics[$mechanicId]["name"] =
      $nameRow["firstname"] . " " . $nameRow["surname"];
     $allMechanics[$mechanicId]["dates"][$date] = 1;
    }
   }
  }
 }

 foreach ($allMechanics as $mechanicId => $mechanicData) {
  echo '<tr>
    <td>
    <div class="d-flex px-2 py-1">
     <div>
      <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
     </div>
     <div class="d-flex flex-column justify-content-center">
      <h6 class="mb-0 text-sm">' .
   $mechanicData["name"] .
   '</h6>
     </div>
    </div>
   </td>';
  foreach ($dates as $date) {
   echo "<td>";
   echo isset($mechanicData["dates"][$date])
    ? '<span class="badge badge-sm badge-success">Online</span>'
    : '<span class="badge badge-sm badge-secondary">Offline</span>';
   echo "</td>";
  }
  echo "</tr>";
 }

 echo '</tbody>
  </table>
  </div>
  <div>
  </div>
  </div>
  </div>';
}
?>
