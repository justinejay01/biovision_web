<?php
 include "conn.php";

 $id = $_POST["id"];
 $username = $_POST["username"];
 $password = $_POST["password"];

 $sql = "INSERT INTO b_student (id, username, password, firstname, lastname, email, department)
 VALUES ('" .$id."', '" .$username. "', '" .$password. "', '" .$firstname. "', '" .$lastname. "', '" .$email. "', '" .$department. "')";
 
 if ($conn->query($sql) === TRUE) {
   echo "1";
 } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
 }
 
 $conn->close();
 
?>