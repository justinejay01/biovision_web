<?php
 include "conn.php";

 $id = $_POST["id"];
 $username = $_POST["username"];
 $password = $_POST["password"];
 $firstname = $_POST["firstname"];
 $lastname = $_POST["lastname"];
 $email = $_POST["email"];
 $department = $_POST["department"];
 $grade_lvl = $_POST["grade_lvl"];
 $section = $_POST["section"];
 $strand = $_POST["strand"];

 $sql = "INSERT INTO b_student (id, username, password, firstname, lastname, email, department, grade_lvl, section, strand)
 VALUES ('" .$id."', '" .$username. "', '" .$password. "', '" .$firstname. "', '" .$lastname. "', '" .$email. "', '" .$department. "', '" .$grade_lvl. "', '" .$section. "', '" .$strand. "',)";
 
 if ($conn->query($sql) === TRUE) {
   echo "1";
 } else {
   echo "Error: " . $sql . "<br>" . $conn->error;
 }
 
 $conn->close();
 
?>