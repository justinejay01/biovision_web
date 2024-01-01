<?php
require "conn.php";

$quiz = new stdClass();

if (isset($_GET["username"])) {
    $id = $_GET["username"];

    $sql = "SELECT id, t_code, firstname, lastname FROM student_acc WHERE username = " . $username . " LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $quiz->id = $row["id"];
            $quiz->name = $row["firstname"] . $row["lastname"];
            
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
