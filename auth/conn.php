<?php
$servername = "161.97.96.188";
$username = "ausapanx_bio";
$password = "BioVision1234";
$db = "ausapanx_biovision";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>