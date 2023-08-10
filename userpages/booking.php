<?php include "header.php"; ?>

<?php 
session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
} else {
  //  if the user is not logged in or the session is expired

}

$successMessage = ""; // Initially, an empty success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the required form data
    $date = $_POST["date"];
    $serviceType = $_POST['service_type'];
    $service_description = $_POST['service_description'];
    
    // Construct a query to find the service ID
    $sql = "SELECT service_id FROM services WHERE service_name='$serviceType'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        // Service found, retrieve the ID
        $row = $result->fetch_assoc();
        $serviceId = $row['service_id'];

        echo "Service ID: " . $serviceId;
    } else {
        echo "NO SERVICE HAS BEEN FOUND.";
    }

    $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
      // Customer found, retrieve the ID
      $row = $result->fetch_assoc();
      $customerId = $row['idcustomers']; // Assign this ID to the required variable
    }

    $sql = "SELECT idvehicles FROM vehicles WHERE idcustomers='$customerId'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
      // Vehicle found, retrieve the ID
      $row = $result->fetch_assoc();
      $vehicleId = $row['idvehicles']; // Assign this ID to the required variable
    } 

    $idMechanic = 1;
    $status = 1;
    $sql = "INSERT INTO bookings (idcustomers, idvehicles, booking_date, service_id, customer_note, id_mechanics, status )
            VALUES ('$customerId', '$vehicleId', '$date' , '$serviceId', '$service_description', '$idMechanic', '$status' )";
  
    if ($mysqli->query($sql) === true) {
        echo "New reservation added successfully.";
    } else {
        echo "Error adding reservation: " . $mysqli->error;
    }
} 

// Construct a query to retrieve all rows from the services table
$sql = "SELECT service_id, service_name FROM services";
$list = $mysqli->query($sql);

$sql = "SELECT idcustomers FROM customers WHERE email='$email'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Customer found, retrieve the ID
    $row = $result->fetch_assoc();
    $customerId = $row['idcustomers']; // Assign this ID to the required variable
}

// Construct a query to retrieve all rows from the vehicles table for the specified customer
$sql = "SELECT * FROM vehicles WHERE idcustomers='$customerId'";
$licenses = $mysqli->query($sql);
?>




<section id="booking">
    <head>
        <link rel="stylesheet" type="text/css" href="userpagecss/stylebooking.css">
        <style>
        .custom-margin {
          margin-top: 200px; /* location arrangement  */
        } 
      </style>
    </head>

    
  <div class="container">
                <div class="row justify-content-center custom-margin"> <!-- bootstrap -->
                   
                    <div class="col-lg-6">
                        <div class="checkout-item">
                          <h2>Book Your Service or Repair</h2>
                          <div class="checkout-one">
                            <!-- Display error messages here -->
                            <?php if (!empty($errors)) : ?>
              <div class="alert alert-danger">
                <ul>
                  <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

                  <!-- Display success message here -->
            <?php if (!empty($successMessage)) : ?>
              <div class="alert alert-success">
                <?php echo $successMessage; ?>
              </div>
            <?php endif; ?>


    <form action="" method="post">
        <label for="vehicle_type">Choose Your Vehicle:</label>
        <div class="form-group">
        <select class="form-control" id="vehicle_type" name="vehicle_type" required>
            <?php
            if ($licenses->num_rows > 0) {
                while ($row = $licenses->fetch_assoc()) {
                    echo "<option value=\"" . $row['license'] . "\">" . $row['license'] . "</option>";
                }
            } else {
                echo "No services available";
            }
            ?>
        </select>
        </div>
        
        <label for="service_type">Service Type:</label>
        <div class="form-group">
        <select class="form-control" id="service_type" name="service_type" required>
            <?php
            if ($list->num_rows > 0) {
                while ($row = $list->fetch_assoc()) {
                    echo "<option value=\"" . $row['service_name'] . "\">" . $row['service_name'] . "</option>";
                }
            } else {
                echo "No services available";
            }
            ?>
        </select>
        </div>
        <label for="date">Choose Date:</label>
        <div class="form-group">
        <input class="form-control" type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
       
        <script>
            document.getElementById("date").addEventListener("change", function() {
                var selectedDate = new Date(this.value);
                var dayOfWeek = selectedDate.getDay(); // Returns a value between 0 (Sunday) and 6 (Saturday)

                if (dayOfWeek == 0) {
                    this.value = ""; // Clear the selected date
                    alert("Oops! Ger's Garage is not open on Sundays");
                }
            });
        </script>
       </div>
        <label for="service_description">Service Description:</label>
         <div class="form-group">
        <textarea class="form-control" id="service_description" name="service_description"></textarea>
        <script>
            document.querySelector("form").addEventListener("submit", function(event) {
                var serviceDescription = document.getElementById("service_description").value;

                if (serviceDescription.trim() === "") {
                    event.preventDefault(); // Prevent form submission
                    alert("Please fill up the description part");
                }
            });
        </script>
        </div>
        <input type="submit" value="Submit">
    </form>

                             </div>
                          </div>
                        </div>
                    </div>
               </div>
</section>


<?php include "footer.php"; ?>
