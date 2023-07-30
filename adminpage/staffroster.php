<?php
require '../userpages/connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<head>
    <title>Hafta Seçimi</title>
</head>
<body>
    <label for="datepicker">Hafta seçiniz:</label>
    <input type="text" id="datepicker" readonly>
    <button onclick="getSelectedWeek()">Haftayı Göster</button>
    <link rel="stylesheet" href="stylestaffroster.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="staffroster.js"></script>
</body>






<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="admincss/stylestaffroster.css" rel="stylesheet">
</head>
<body>
<!--   <script src="staffroster.js"></script> -->
  <div id="week-schedule">
    <div class="schedule-day">
      <h1>Mon</h1>
    </div>
    <div class="schedule-day">
      <h1>Tue</h1>
    </div>
    <div class="schedule-day">
      <h1>Wed</h1>
    </div>
    <div class="schedule-day">
      <h1>Thu</h1>
    </div>
    <div class="schedule-day">
      <h1>Fri</h1>
    </div>
    <div class="schedule-day">
      <h1>Sat</h1>
    </div>
    <div class="schedule-day">
      <h1>Sun</h1>
    </div>
    
    <!--MONDAY SHIFTS-->
    <!--EMPLOYEE 1-->
    <div id="all-shifts-mon" class="all-shifts">
      <div class="employee-shift red">
        <h2>Roman</h2>
       
      </div>
      <!--EMPLOYEE 2-->
      <div class="employee-shift orange">
        <h2>Claude</h2>

      </div>
      <!--EMPLOYEE 3-->
      <div class="employee-shift purple">
        <h2>Spencer</h2>
    
      </div>
      <!--EMPLOYEE 4-->
      <div class="employee-shift blue">
        <h2>Gaetan</h2>
      
      </div>
    </div>
    <!--TUESDAY SHIFTS-->
    <!--EMPLOYEE 1-->
    <div id="all-shifts-tue" class="all-shifts">
      <div class="employee-shift red">
        <h2>Roman</h2>
      
      </div>
      <!--EMPLOYEE 2-->
      <div class="employee-shift orange">
        <h2>Claude</h2>
   
      </div>
      <!--EMPLOYEE 3-->
      <!--EMPLOYEE 4-->
    </div>
    <!--WEDNESDAY SHIFTS-->
    <!--EMPLOYEE 1-->
    <div id="all-shifts-wed" class="all-shifts">
      <div class="employee-shift red">
        <h2>Roman</h2>
     
      </div>
      <!--EMPLOYEE 2-->
      <div class="employee-shift orange">
        <h2>Claude</h2>
 
      </div>
      <!--EMPLOYEE 3-->
      <div class="employee-shift green">
        <h2>Tayina</h2>

      </div>
      <!--EMPLOYEE 4-->
    </div>
    <!--THURSDAY SHIFTS-->
    <!--EMPLOYEE 1-->
    <div id="all-shifts-thu" class="all-shifts">
      <div class="employee-shift red">
        <h2>Roman</h2>
   
      </div>
      <!--EMPLOYEE 2-->

    </div>
    <!--FRIDAY SHIFTS-->
    <!--EMPLOYEE 1-->
    <div id="all-shifts-fri" class="all-shifts">
      <div class="employee-shift red">
        <h2>Roman</h2>
  
      </div>
      <!--EMPLOYEE 2-->
      <div class="employee-shift green">
        <h2>Tayina</h2>
  
      </div>
    </div>
    <!--SATURDAY SHIFTS-->
    <div class="all-shifts">
      <div class="employee-shift empty">
        <h2>No Shifts</h2>
       
      </div>
    </div>
    <!--SUNDAY SHIFTS-->
    <div class="all-shifts">
      <div class="employee-shift empty">
        <h2>No Shifts</h2>
      
      </div>
    </div>
  </div>
</body>
</html>
