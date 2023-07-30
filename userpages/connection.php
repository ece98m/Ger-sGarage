<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'gersgarage';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Diğer kodlarınız burada yer alır

if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

error_reporting(0);

?>