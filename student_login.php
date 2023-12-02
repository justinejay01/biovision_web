<?php
require "conn.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $errors = array();

  if ($stmt = $conn->prepare("SELECT username, password FROM student_acc WHERE username = ? LIMIT 1")) {

    /* bind parameters for markers */
    $stmt->bind_param('s', $username);

    /* execute query */
    if ($stmt->execute()) {

      /* store result */
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
        /* bind result variables */
        $stmt->bind_result($username_tmp, $password_hash);

        /* fetch value */
        $stmt->fetch();

        if (password_verify($password, $password_hash)) {
          echo $username_tmp;

          return;
        } else {
          $errors[] = "Wrong email or password.";
        }
      } else {
        $errors[] = "Wrong email or password.";
      }

      /* close statement */
      $stmt->close();
    } else {
      $errors[] = "Something went wrong, please try again.";
    }
  } else {
    $errors[] = "Something went wrong, please try again.";
  }

  if (count($errors) > 0) {
    echo $errors[0];
  }
} else {
  echo "Missing data";
}
?>