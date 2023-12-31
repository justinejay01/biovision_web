<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "ausapanx_biovision";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>