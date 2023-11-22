<?php
 include "conn.php";

 $id = $_POST["id"];
 $username = $_POST["username"];
 $password = $_POST["password"];
 $firstname = $_POST["firstname"];
 $lastname = $_POST["lastname"];
 $email = $_POST["email"];
 $department = $_POST["department"];

 $sql = "INSERT INTO b_admin (id, username, password, firstname, lastname, email, department)
 VALUES ('" .$id."', '" .$username. "', '" .$password. "', '" .$firstname. "', '" .$lastname. "', '" .$email. "', '" .$department. "')";
 
 if ($conn->query($sql) === TRUE) {
   echo "1";
 } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
 }
 
 $conn->close();
 
?>