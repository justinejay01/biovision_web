<?php
require "../auth/conn.php";
session_start();

if (isset($_SESSION["teacher"]) && isset($_POST["quizID"]) && isset($_POST["quizCat"]) && isset($_POST["quizQuestion"]) && isset($_POST["quizChoices1"]) && isset($_POST["quizChoices2"]) && isset($_POST["quizChoices3"]) && isset($_POST["quizChoices4"]) && isset($_POST["quizAnswer"])) {
    $id = $_POST["quizID"];
    $category = $_POST["quizCat"];
    $question = $_POST["quizQuestion"];
    $choices_1 = $_POST["quizChoices1"];
    $choices_2 = $_POST["quizChoices2"];
    $choices_3 = $_POST["quizChoices3"];
    $choices_4 = $_POST["quizChoices4"];
    $answer = $_POST["quizAnswer"];

    $errors = array();

    //Update
    if (count($errors) == 0) {
        if ($stmt = $conn->prepare("UPDATE student_quizzes SET category = ?, question = ?, answer = ?, choices_1 = ?, choices_2 = ?, choices_3 = ?, choices_4 = ? WHERE id = ?")) {

            /* bind parameters for markers */
            $stmt->bind_param('ssissssi', $category, $question, $answer, $choices_1, $choices_2, $choices_3, $choices_4, $id);

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
        echo $question;
    }

    $conn->close();
} else {
    echo "Missing Data";
}
