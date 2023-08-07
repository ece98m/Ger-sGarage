<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'gersgarage';
define("URL","http://localhost/garage/userpages/");
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start(); //to prevent session complexity . Solved the session error using this
}

if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

 error_reporting(0); 

?>