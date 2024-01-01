<?php
$servername = "161.97.96.188"; //localhost
$username = "ausapanx_bio"; //root
$password = "BioVision1234"; //
$db = "ausapanx_biovision"; //biovision

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>