<?php include "header.php"; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if the user is logged in
if (!isset($_SESSION['email'])) {
  // Redirect the user to the login page or show an error message
  header("Location: login.php");
  exit();
}

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // get the customer id
  $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // customer has been found, now use the customer id
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; // assign the customer id to a variable

    // get the vehicle licenses belong to the specific customer account
    $sql = "SELECT * FROM vehicles WHERE idcustomers='$customerId'";
    $vehicles = $mysqli->query($sql);

    $Status = "Select your license detail to see your vehicle's status";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $license = $_POST['license'];

      // fetch the status by using license details with this query
   $statusQuery = "SELECT bs.Status_Name
   FROM bookings b
   JOIN booking_statuses bs ON b.status = bs.Status_ID
   JOIN vehicles v ON b.idvehicles = v.idvehicles
   WHERE v.license = '$license'";

$statusResult = $mysqli->query($statusQuery);

if ($statusResult && $statusResult->num_rows > 0) {
$statusRow = $statusResult->fetch_assoc();
$Status = $statusRow['Status_Name'];
} else {
$Status = "Status not found";
}
}
}}
?>

<body>
  <section id="tracking-form">
    <head>
      <link rel="stylesheet" type="text/css" href="userpagecss/stylebooking.css">
      <style>
        .custom-margin {
          margin-top: 200px;
        }
        .center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 22vh; /* Bu, ekran yüksekliği kadar alan kaplayacak şekilde ayarlanmıştır */
  }
      </style>
    </head>
    <div class="container">
      <div class="row justify-content-center custom-margin"> <!-- bootstrap -->
        <div class="col-lg-6">
          <div class="checkout-item">
            <h2>Choose your vehicle</h2>
            <div class="checkout-one">
              <form action="" method="POST">
                <div class="form-group">
                  <label for="license">License</label>
                  <select class="form-control" id="license" name="license" required>
                  <option value="" disabled selected>Select a license</option>
                    <?php
                    if (isset($vehicles) && $vehicles->num_rows > 0) {
                      while ($row = $vehicles->fetch_assoc()) {
                        echo "<option value=\"" . $row['license'] . "\">" . $row['license'] . "</option>";
                      }
                    } else {
                      echo "<option value=\"\">No licenses available</option>";
                    }
                    ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Check Vehicle Status</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="center">
  <h1>STATUS : <?php echo $Status; ?></h1>
  </div>
</body>

<?php include "footer.php"; ?>
