<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'gersgarage';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
session_start(); 
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

error_reporting(0);

?>