<?php
require "../userpages/connection.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Delete part
 if (isset($_POST["action"]) && $_POST["action"] == "delete") {
  $part_id = $_POST["part_id"];
  echo $part_id;

  // Query to delete a part from the 'parts' table
  $sql = "DELETE FROM parts WHERE part_id = ?";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("i", $part_id); // "i" means integer

  if ($stmt->execute()) {
  } else {
   echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
 }

 // Add part
 if (isset($_POST["action"]) && $_POST["action"] == "add") {
  $part_name = $_POST["part_name"];
  $price = $_POST["price"];

  // Query to add a new part to the 'parts' table
  $sql = "INSERT INTO parts (part_name, price) VALUES (?, ?)";

  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("sd", $part_name, $price); // "sd" means string and double

  if ($stmt->execute()) {
  } else {
   echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
 }
}
// Update price
if (isset($_POST["action"]) && $_POST["action"] == "update") {
 $part_id = $_POST["part_id"];
 $price = $_POST["price"];

 // Query to update the price in the 'parts' table
 $sql = "UPDATE parts SET price = ? WHERE part_id = ?";

 $stmt = $mysqli->prepare($sql);
 $stmt->bind_param("di", $price, $part_id); // "di" means double and integer

 if ($stmt->execute()) {
 } else {
  echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
}

// Query to retrieve data from the 'parts' table
$sql = "SELECT part_id, part_name, price FROM parts";

// Execute the query
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Parts List</title>
  <!-- Add any additional CSS or JavaScript here -->
</head>
<body>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
 <div class="container-fluid py-1 px-3">
  <nav aria-label="breadcrumb">
   <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Vehicle Products</li>
   </ol>
   <h6 class="font-weight-bolder mb-0">Vehicle Products</h6>
  </nav>
  <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
     <div class="ms-md-auto pe-md-3 d-flex align-items-center">
      <div class="input-group">
       <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
       <input type="text" class="form-control" placeholder="Type here...">
      </div>
     </div>
     <ul class="navbar-nav  justify-content-end">
      <li class="nav-item d-flex align-items-center">
       <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
        <i class="fa fa-user me-sm-1"></i>
        <span class="d-sm-inline d-none">Sign In</span>
       </a>
      </li>
      <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
       <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
        <div class="sidenav-toggler-inner">
         <i class="sidenav-toggler-line"></i>
         <i class="sidenav-toggler-line"></i>
         <i class="sidenav-toggler-line"></i>
        </div>
       </a>
      </li>
      <li class="nav-item px-3 d-flex align-items-center">
       <a href="javascript:;" class="nav-link text-body p-0">
        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
       </a>
      </li>
      <li class="nav-item dropdown pe-2 d-flex align-items-center">
       <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell cursor-pointer"></i>
       </a>
       <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
        <li class="mb-2">
         <a class="dropdown-item border-radius-md" href="javascript:;">
          <div class="d-flex py-1">
           <div class="my-auto">
            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
           </div>
           <div class="d-flex flex-column justify-content-center">
            <h6 class="text-sm font-weight-normal mb-1">
             <span class="font-weight-bold">New message</span> from Laur
            </h6>
            <p class="text-xs text-secondary mb-0 ">
             <i class="fa fa-clock me-1"></i>
             13 minutes ago
            </p>
           </div>
          </div>
         </a>
        </li>
        <li>
         <a class="dropdown-item border-radius-md" href="javascript:;">
          <div class="d-flex py-1">
           <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
             <title>credit-card</title>
             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
               <g transform="translate(1716.000000, 291.000000)">
                <g transform="translate(453.000000, 454.000000)">
                 <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                 <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                </g>
               </g>
              </g>
             </g>
            </svg>
           </div>
           <div class="d-flex flex-column justify-content-center">
            <h6 class="text-sm font-weight-normal mb-1">
             Payment successfully completed
            </h6>
            <p class="text-xs text-secondary mb-0 ">
             <i class="fa fa-clock me-1"></i>
             2 days
            </p>
           </div>
          </div>
         </a>
        </li>
       </ul>
      </li>
     </ul>
  </div>
 </div>
</nav>

<div class="container-fluid py-4">
   <div class="row">
    <div class="col-12">
     <div class="card mb-4">
      <div class="card-header pb-0">
       <h6>Products</h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
       <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
         <thead>
          <tr>
           <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
           <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
           <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
          </tr>
         </thead>
         <tbody>
         <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
           <td>
            <div class="d-flex px-2 py-1">
             <div class="d-flex flex-column justify-content-center">
              <h6 class="mb-0 text-sm"><?= $row["part_id"] ?></h6>
             </div>
            </div>
           </td>
           <td>
            <p class="text-xs font-weight-bold mb-0"><?= $row[
             "part_name"
            ] ?></p>
           </td>
           <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">$<?= $row[
             "price"
            ] ?></span>
           </td>
          </tr>
          <?php endwhile; ?>
    <?php else: ?>
      <tr>
      <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">No parts found.</span>
           </td>
      </tr>
    <?php endif; ?>
         </tbody>
        </table>
       </div>
      </div>
     </div>
    </div>
   </div>
</div>

<div class="container-fluid py-4">
 <div class="row">
  <div class="col-md-6 mb-lg-0 mb-4">
   <form method="post" id="addForm">
    <div class="card mt-4">
     <div class="card-header pb-0 p-3">
      <div class="row">
       <div class="col-6 d-flex align-items-center">
        <h6 class="mb-0">Add</h6>
       </div>
       <div class="col-6 text-end">
        <button type="submit" value="Add" class="btn bg-gradient-dark mb-0"><i
          class="fas fa-plus"></i>&nbsp;&nbsp;Add New Part</button>
       </div>
      </div>
     </div>
     <div class="card-body p-3">
      <div class="row">
       <div class="col-md-6 mb-md-0 mb-4">
        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
         <input type="hidden" name="action" value="add">
         <input type="text" id="part_name" name="part_name" class="form-control" placeholder="Name"><br>
        </div>
       </div>
       <div class="col-md-6">
        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
         <input type="text" id="price" name="price" class="form-control" placeholder="Price"><br>
        </div>
       </div>
      </div>
     </div>
    </div>
   </form>
  </div>

  <div class="col-md-6 mb-lg-0 mb-4">
  <form method="post" id="updateForm">
    <div class="card mt-4">
     <div class="card-header pb-0 p-3">
      <div class="row">
       <div class="col-6 d-flex align-items-center">
        <h6 class="mb-0">Update</h6>
       </div>
       <div class="col-6 text-end">
        <button type="submit" value="Update" class="btn bg-gradient-success mb-0"><i
          class="fas fa-edit"></i>&nbsp;&nbsp;Update Part</button>
       </div>
      </div>
     </div>
     <div class="card-body p-3">
      <div class="row">
       <div class="col-md-6 mb-md-0 mb-4">
        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
         <input type="hidden" name="action" value="update">
         <input type="text" id="part_id" name="part_id" class="form-control" placeholder="Id"><br>
        </div>
       </div>
       <div class="col-md-6">
        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
         <input type="text" id="price" name="price" class="form-control" placeholder="Price"><br>
        </div>
       </div>
      </div>
     </div>
    </div>
   </form>
  </div>


  <div class="col-md-6 mb-lg-0 mb-4">
   <form method="post" id="deleteForm">
    <div class="card mt-4">
     <div class="card-header pb-0 p-3">
      <div class="row">
       <div class="col-6 d-flex align-items-center">
        <h6 class="mb-0">Delete</h6>
       </div>
       <div class="col-6 text-end">
        <button type="submit" value="Delete" class="btn bg-gradient-danger mb-0"><i
          class="fas fa-trash"></i>&nbsp;&nbsp;Delete Part</button>
       </div>
      </div>
     </div>
     <div class="card-body p-3">
      <div class="row">
       <div class="col-md-6 mb-md-0 mb-4">
        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
         <input type="hidden" name="action" value="delete">
         <input type="text" id="part_id" name="part_id" class="form-control" placeholder="Id"><br>
        </div>
       </div>
      </div>
     </div>
    </div>
   </form>
  </div>
 </div>
</div>

  <script>
    // Handle form submissions using AJAX
    $(document).ready(function() {
      $("#addForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo $_SERVER["PHP_SELF"]; ?>",
          data: $(this).serialize(),
          success: function(response) {
            // Handle success response here (e.g., show success message)
            console.log(response);
          },
          error: function(xhr, textStatus, errorThrown) {
            // Handle error response here (e.g., show error message)
            console.error(xhr.responseText);
          }
        });
      });
      $("#updateForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo $_SERVER["PHP_SELF"]; ?>",
          data: $(this).serialize(),
          success: function(response) {
            // Handle success response here (e.g., show success message)
            console.log(response);
          },
          error: function(xhr, textStatus, errorThrown) {
            // Handle error response here (e.g., show error message)
            console.error(xhr.responseText);
          }
        });
      });

      $("#deleteForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "<?php echo $_SERVER["PHP_SELF"]; ?>",
          data: $(this).serialize(),
          success: function(response) {
            // Handle success response here (e.g., show success message)
            console.log(response);
          },
          error: function(xhr, textStatus, errorThrown) {
            // Handle error response here (e.g., show error message)
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>

</body>
</html>

<?php // Close the connection
$mysqli->close();
?>
