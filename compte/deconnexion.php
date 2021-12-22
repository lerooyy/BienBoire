<?php
session_start();

if (!isset($_SESSION['connecte'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['connecte'] == false) {
    header('Location: ../index.php');
    exit();
} else {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>