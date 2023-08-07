<!-- admin-booking.php -->

<!DOCTYPE html>
<html>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
/* Custom styles for the datepicker */
.ui-datepicker {
 background-color: rgba(255, 255, 255, 0.9); /* Glass white panel background */
 border: none;
 border-radius: 15px; /* Curved edges */
 box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Box shadow */
 padding: 20px;
 font-size: 16px; /* Larger font size */
}

.ui-datepicker-header {
 background-color: transparent;
 border: none;
 display: flex;
 justify-content: space-between; /* Position prev and next buttons at ends */
 align-items: center;
}

.ui-datepicker-title {
 color: #333;
 font-weight: bold;
 font-size: 20px; /* Larger title font size */
 flex-grow: 1; /* Allow title to grow and center buttons */
 text-align: center;
}

.ui-datepicker-prev,
.ui-datepicker-next {
 background-color: transparent;
 color: #333; /* Light black arrow color */
 border: none;
 padding: 5px 10px;
 font-size: 18px;
 cursor: pointer;
 transition: color 0.3s ease-in-out;
}

.ui-datepicker-prev:hover,
.ui-datepicker-next:hover {
 color: #000; /* Hovered arrow color */
}

.ui-datepicker-prev:before,
.ui-datepicker-next:before {
 content: "\25C0"; /* Unicode character for left arrow */
 font-size: 20px;
}

.ui-datepicker-next:before {
 content: "\25B6"; /* Unicode character for right arrow */
}

.ui-datepicker-calendar {
 background-color: transparent;
 border: none;
}

.ui-datepicker-calendar th,
.ui-datepicker-calendar td {
 border: none;
 text-align: center;
 padding: 10px;
}

.ui-datepicker-calendar .ui-state-default {
 background-color: transparent;
 border: none;
 color: #333;
}

.ui-datepicker-calendar .ui-state-hover,
.ui-datepicker-calendar .ui-state-focus,
.ui-datepicker-calendar .ui-datepicker-current-day {
 background-color: #f0f0f0;
 position: relative;
}

.ui-datepicker-calendar .ui-state-active {
 background-color: #007bff;
 color: #fff;
 box-shadow: 0 0 15px rgba(0, 0, 0, 0.3), 0 0 30px rgba(0, 123, 255, 0.7);
 border-radius: 50%; /* Oval-shaped shadow */
}
 </style>
</head>

<body>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
 <div class="container-fluid py-1 px-3">
  <nav aria-label="breadcrumb">
   <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Bookings</li>
   </ol>
   <h6 class="font-weight-bolder mb-0">Bookings</h6>
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
 <div class="mx-4 my-4 mb-2"> <input type="text" id="datepicker" class="form-control datepicker w-auto" placeholder="Please select date">
</div>
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
