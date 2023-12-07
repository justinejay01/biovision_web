<?php
session_start();
if (isset($_SESSION["teacher"])) {
    echo $_SESSION["teacher"];
} else {
    //echo '<script>window.location.replace("auth.php");</script>';
}
?>