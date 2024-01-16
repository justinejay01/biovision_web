<?php
$servername = "192.168.1.227"; //161.97.96.188
$username = "root"; //ausapanx_bio
$password = ""; //BioVision1234
$db = "biovision"; //ausapanx_biovision

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>