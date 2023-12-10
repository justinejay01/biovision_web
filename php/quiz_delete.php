<?php
require "../auth/conn.php";
session_start();

if (isset($_SESSION["teacher"]) && isset($_POST["quizID"])) {
    $id = $_POST["quizID"];

    $errors = array();

    //Delete
    if (count($errors) == 0) {
        if ($stmt = $conn->prepare("UPDATE student_quizzes SET is_archived = 1 WHERE id = ?")) {

            /* bind parameters for markers */
            $stmt->bind_param('i', $id);

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
        echo $id;
    }

    $conn->close();
} else {
    echo "Missing Data";
}
