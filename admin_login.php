<?php
 include "conn.php";

 $id = $_POST["id"];
 $username = $_POST["username"];
 $password = $_POST["password"];

 $sql = "SELECT id, username, password FROM b_admin WHERE password = '" .$password. "' AND (id = '" .$id. "' OR username = '" .$username. "');";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>