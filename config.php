<?php
error_reporting(0);
ini_set('display_errors', 0);

$servername = "localhost";
$username = "root";
$password = "Root"; // change if you use different MySQL password
$dbname = "rfid_attendance";

// Create MySQLi connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
