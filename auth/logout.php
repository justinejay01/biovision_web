<?php
session_start();
if (isset($_SESSION["teacher"])) {
    session_unset();
    session_destroy();
}
echo '<script>window.location.replace("../auth.php");</script>';
