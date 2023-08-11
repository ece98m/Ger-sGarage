<?php
include "header.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page or show an error message
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Retrieve necessary form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $serviceType = $_POST['service_type'];
    $service_description = $_POST['service_description'];

    // Fetch service_id and credit from services table
    $sql = "SELECT service_id, credit FROM services WHERE service_name='$serviceType'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $serviceId = $row['service_id'];
        $credit = $row['credit']; // Retrieve credit for this service

        // Fetch customer ID
        $sql = "SELECT idcustomers FROM customers WHERE email='$email'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customerId = $row['idcustomers']; // Assign this ID to the required variable

            // Fetch vehicle ID for the customer
            $sql = "SELECT idvehicles FROM vehicles WHERE idcustomers='$customerId'";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $vehicleId = $row['idvehicles']; // Assign this ID to the required variable

                // Calculate total credit used for the day's reservations
                $sql = "SELECT SUM(s.credit) AS total_credit_used
                        FROM bookings b
                        INNER JOIN services s ON b.service_id = s.service_id
                        WHERE DATE(b.booking_date) = '$date'";

                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalCreditUsed = $row['total_credit_used'];
                }

                // Calculate new reservation's credit
                $newReservationCredit = $credit; // Modify based on the form data

                // Check if new reservation can be added
                if (($totalCreditUsed + $newReservationCredit) <= 16) {
                    $idMechanic = 1;
                    $status = 1;
                    $sql = "INSERT INTO bookings (idcustomers, idvehicles, booking_date, service_id, customer_note, id_mechanics, status)
                            VALUES ('$customerId', '$vehicleId', '$date', '$serviceId', '$service_description', '$idMechanic', '$status')";

                    if ($mysqli->query($sql) === true) {
                        $successMessage = "New reservation added successfully.";
                    } else {
                        $errorMessage = "Error adding reservation: " . $mysqli->error;
                    }
                } else {
                    $errorMessage = "The day you selected is already full. Please choose another day.";
                }
            } else {
                $errorMessage = "No vehicles found for this customer.";
            }
        } else {
            $errorMessage = "Customer not found.";
        }
    } else {
        $errorMessage = "NO SERVICE HAS BEEN FOUND.";
    }
}
// Construct a query to retrieve all rows from the services table
$sql = "SELECT service_id, service_name, credit FROM services";
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
                margin-top: 200px; /* Location arrangement */
            } 
        </style>
    </head>
    
    <div class="container">
        <div class="row justify-content-center custom-margin"> <!-- Bootstrap -->
            <div class="col-lg-6">
                <div class="checkout-item">
                    <h2>Book Your Service or Repair</h2>
                    <div class="checkout-one">
                

                        <!-- Display error messages here -->
                       <!--  <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error) : ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?> -->

                        <!-- Display success message here -->
                        <?php if (!empty($successMessage)) : ?>
                            <div class="alert alert-success">
                                <?php echo $successMessage; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($errorMessage)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                        <form action="" method="post">
                            
                            <label for="vehicle_type">Choose Your Vehicle:</label>
<div class="form-group">
    <select class="form-control" id="vehicle_type" name="vehicle_type" required>
        <option value="" disabled selected>Select a vehicle</option> <!-- Default option -->
        <?php
        if ($licenses->num_rows > 0) {
            while ($row = $licenses->fetch_assoc()) {
                echo "<option value=\"" . $row['license'] . "\">" . $row['license'] . "</option>";
            }
        } else {
            echo "No vehicles available";
        }
        ?>
    </select>
</div>

                            
<label for="service_type">Service Type:</label>
<div class="form-group">
    <select class="form-control" id="service_type" name="service_type" required>
        <option value="" disabled selected>Select a service</option> <!-- Default option -->
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
                            </div>

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
                            <div>
    <p>Toplam Günlük Kredi Kullanımı: <?php echo $totalCreditUsed; ?></p>
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
