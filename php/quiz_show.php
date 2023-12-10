<?php
require "../auth/conn.php";
session_start();

if (isset($_SESSION["teacher"])) {

    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $sql = "SELECT id, category, question, answer, choices_1, choices_2, choices_3, choices_4 FROM student_quizzes WHERE id = " . $id . " LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quiz = new stdClass();
                $quiz->id = $row["id"];
                $quiz->category = $row["category"];
                $quiz->question = $row["question"];
                $quiz->answer = $row["answer"];
                $quiz->choices_1 = $row["choices_1"];
                $quiz->choices_2 = $row["choices_2"];
                $quiz->choices_3 = $row["choices_3"];
                $quiz->choices_4 = $row["choices_4"];
                
                $json = json_encode($quiz);

                echo $json;
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    } else {
        $sql = "SELECT id, category, question FROM student_quizzes WHERE is_archived = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["category"] . "</td><td>" . $row["question"] . "</td><td>";
                echo '<div class="btn-group">';
                echo '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="openModalEdit(' . $row["id"] . ')">Edit</button>';
                echo '<button type="button" class="btn btn-sm btn-outline-danger" onclick="openModalDelete(' . $row["id"] . ')">Delete</button>';
                echo '</div></td></tr>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }
}
