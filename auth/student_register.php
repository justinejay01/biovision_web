<?php
require "conn.php";

if (isset($_POST["id"]) && isset($_POST["t_code"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["department"]) && isset($_POST["year_lvl"]) && isset($_POST["section"]) && isset($_POST["strand"])) {
  $id = $_POST["id"];
  $t_code = $_POST["t_code"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $department = $_POST["department"];
  $year_lvl = $_POST["year_lvl"];
  $section = $_POST["section"];
  $strand = $_POST["strand"];

  $emailMaxLength = 254;
  $usernameMaxLength = 20;
  $usernameMinLength = 3;
  $passwordMaxLength = 19;
  $passwordMinLength = 5;
  $tcodeLength = 4;
  $errors = array();

  //Validate teacher code
  if(!is_numeric($t_code)) {
    $errors[] = "Teacher code must be numbers only";
  } else {
    if(strlen($t_code) != $tcodeLength) {
      $errors[] = "Teacher code must contain only 4 digits";
    }
  }

  //Validate email
  if (preg_match('/\s/', $email)) {
    $errors[] = "Email can't have spaces";
  } else {
    if (!validate_email_address($email)) {
      $errors[] = "Invalid email";
    } else {
      if (strlen($email) > $emailMaxLength) {
        $errors[] = "Email is too long, must be equal or under " . strval($emailMaxLength) . " characters";
      }
    }
  }

  //Validate username
  if (strlen($username) > $usernameMaxLength || strlen($username) < $usernameMinLength) {
    $errors[] = "Incorrect username length, must be between " . strval($usernameMinLength) . " and " . strval($usernameMaxLength) . " characters";
  } else {
    if (!ctype_alnum($username)) {
      $errors[] = "Username must be alphanumeric";
    }
  }

  //Validate password
  if (preg_match('/\s/', $password)) {
    $errors[] = "Password can't have spaces";
  } else {
    if (strlen($password) > $passwordMaxLength || strlen($password) < $passwordMinLength) {
      $errors[] = "Incorrect password length, must be between " . strval($passwordMinLength) . " and " . strval($passwordMaxLength) . " characters";
    } else {
      if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain atleast 1 letter and 1 number";
      }
    }
  }

  //Check if teacher code is existed in the admin accounts
  if (count($errors) == 0) {
    //Connect to database

    if ($stmt = $conn->prepare("SELECT count(t_code) FROM admin_acc WHERE t_code = ?")) {

      /* bind parameters for markers */
      $stmt->bind_param('i', $t_code);

      /* execute query */
      if ($stmt->execute()) {

        /* store result */
        $stmt->store_result();

        if ($stmt->num_rows > 0) {

          /* bind result variables */
          $stmt->bind_result($tcode);

          /* fetch value */
          $stmt->fetch();

          if ($tcode == 0) {
            $errors[] = "Teacher code does not exist";
          }
        }

        /* close statement */
        $stmt->close();
      } else {
        $errors[] = "Something went wrong, please try again.";
      }
    } else {
      $errors[] = "Something went wrong, please try again.";
    }
  }

  //Check if there is user already registered with the same email or username
  if (count($errors) == 0) {
    //Connect to database

    if ($stmt = $conn->prepare("SELECT username, email FROM student_acc WHERE email = ? OR username = ? LIMIT 1")) {

      /* bind parameters for markers */
      $stmt->bind_param('ss', $email, $username);

      /* execute query */
      if ($stmt->execute()) {

        /* store result */
        $stmt->store_result();

        if ($stmt->num_rows > 0) {

          /* bind result variables */
          $stmt->bind_result($username_tmp, $email_tmp);

          /* fetch value */
          $stmt->fetch();

          if ($email_tmp == $email) {
            $errors[] = "User with this email already exist.";
          } else if ($username_tmp == $username) {
            $errors[] = "User with this name already exist.";
          }
        }

        /* close statement */
        $stmt->close();
      } else {
        $errors[] = "Something went wrong, please try again.";
      }
    } else {
      $errors[] = "Something went wrong, please try again.";
    }
  }

  //Finalize registration
  if (count($errors) == 0) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    if ($stmt = $conn->prepare("INSERT INTO student_acc (id, t_code, firstname, lastname, department, year_lvl, section, strand, email, username, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

      /* bind parameters for markers */
      $stmt->bind_param('sisssisssss', $id, $t_code, $firstname, $lastname, $department, $year_lvl, $section, $strand, $email, $username, $hashedPassword);

      /* execute query */
      if ($stmt->execute()) {

        /* close statement */
        $stmt->close();
      } else {
        $errors[] = "Something went wrong, please try again.";
      }
    } else {
      $errors[] = "Something went wrong, please try again.";
    }
  }

  if (count($errors) > 0) {
    echo $errors[0];
  } else {
    echo $username;
  }

/*
  $sql = "INSERT INTO student_acc (id, username, password, firstname, lastname, email, department, year_lvl, section, strand)
  VALUES ('" . $id . "', '" . $username . "', '" . $password . "', '" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $department . "', '" . $year_lvl . "', '" . $section . "', '" . $strand . "')";

  if ($conn->query($sql) === TRUE) {
    echo "1";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
*/

  $conn->close();
} else {
  echo "Missing Data";
}

function validate_email_address($email)
{
  return preg_match('/^([a-z0-9!#$%&\'*+-\/=?^_`{|}~.]+@[a-z0-9.-]+\.[a-z0-9]+)$/i', $email);
}

?>