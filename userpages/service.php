<?php include "header.php";
 ?>




<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ger's Garage - Services</title>
  <link rel="stylesheet" href="styleservice.css">

        <link rel="stylesheet" type="text/css" href="userpagecss/stylebooking.css"> 
        <style>
         .custom-margin {
         margin-top: 170px;
         }
</style>   
    
</head>
<body>


  <section id="services">
    <div class="container">
    <div class="row justify-content-center custom-margin">
    <h2>Our Services</h2>
    <div class="service">
      <h3>Annual Service</h3>
      <p>Regular maintenance checkup for your vehicle.</p>
      <button class="btn" onclick="showBookingForm('Annual Service')">Book Now</button>
    </div>
    <div class="service">
      <h3>Major Service</h3>
      <p>Comprehensive service package for your vehicle.</p>
      <button class="btn" onclick="showBookingForm('Major Service')">Book Now</button>
    </div>
    <div class="service">
      <h3>Repair / Fault</h3>
      <p>Repairs and fixes for vehicle issues and faults.</p>
      <button class="btn" onclick="showBookingForm('Repair / Fault')">Book Now</button>
    </div>
    <div class="service">
      <h3>Major Repair</h3>
      <p>Extensive repairs and major fixes for your vehicle.</p>
      <button class="btn" onclick="showBookingForm('Major Repair')">Book Now</button>
    </div>
    </div>
    </div>
  </section>

 

  

  <script src="scriptservice.js"></script>

  <script>
function showBookingForm(serviceType) {
    
    <?php
    if (isset($_SESSION['user_id'])) {
        //if session exist booking.php
        echo "window.location.href = 'booking.php?service=' + encodeURIComponent(serviceType);";
    } else {
        // id no session login.php
        echo "window.location.href = 'login.php';";
    }
    ?>
}
</script>

</body>




<?php include "footer.php"; ?>