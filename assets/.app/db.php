<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $position = $_POST["position"];
    $exp_years = $_POST["exp_years"];
    $educ_level = $_POST["educ_level"];
    $availability = $_POST["availability"];
    $skills = $_POST["skills"];
    $skill = "";

    foreach ($skills as $value) {
        if (!empty($skill)) {
            $skill = $value;
        } else {
            $skill = $skill . ", " . $value;
        }
    }

    // SQL query to insert data into the survey table
    $sql = "INSERT INTO app_form (firstname, lastname, email, phone, address, position, exp_years, educ_level, availability, skills) VALUES ('$firstname', '$lastname', '$email', '$phone', '$address', '$position', '$exp_years', '$educ_level', '$availability', '$skill')";

    if ($conn->query($sql) === TRUE) {
        echo "Survey response saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
