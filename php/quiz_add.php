<?php
require "../auth/conn.php";
session_start();

if (isset($_SESSION["teacher"]) && isset($_POST["quizCat"]) && isset($_POST["quizQuestion"]) && isset($_POST["quizChoices1"]) && isset($_POST["quizChoices2"]) && isset($_POST["quizChoices3"]) && isset($_POST["quizChoices4"]) && isset($_POST["quizAnswer"])) {
    $t_code = $_SESSION["teacher"];
    $category = $_POST["quizCat"];
    $question = $_POST["quizQuestion"];
    $choices_1 = $_POST["quizChoices1"];
    $choices_2 = $_POST["quizChoices2"];
    $choices_3 = $_POST["quizChoices3"];
    $choices_4 = $_POST["quizChoices4"];
    $answer = $_POST["quizAnswer"];

    $errors = array();

    // //Check if there is question already in the database
    // if (count($errors) == 0) {
    //     //Connect to database

    //     if ($stmt = $conn->prepare("SELECT question FROM student_quizzes WHERE question = ? LIMIT 1")) {

    //         /* bind parameters for markers */
    //         $stmt->bind_param('s', $question);

    //         /* execute query */
    //         if ($stmt->execute()) {

    //             /* store result */
    //             $stmt->store_result();

    //             if ($stmt->num_rows > 0) {

    //                 /* bind result variables */
    //                 $stmt->bind_result($question_tmp);

    //                 /* fetch value */
    //                 $stmt->fetch();

    //                 if ($question_tmp == $question) {
    //                     $errors[] = "Question already exist.";
    //                 }
    //             }

    //             /* close statement */
    //             $stmt->close();
    //         } else {
    //             $errors[] = "Something went wrong, please try again.";
    //         }
    //     } else {
    //         $errors[] = "Something went wrong, please try again.";
    //     }
    // }

    //Finalize registration
    if (count($errors) == 0) {
        if ($stmt = $conn->prepare("INSERT INTO student_quizzes (t_code, category, question, answer, choices_1, choices_2, choices_3, choices_4) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")) {

            /* bind parameters for markers */
            $stmt->bind_param('ississss', $t_code, $category, $question, $answer, $choices_1, $choices_2, $choices_3, $choices_4);

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
