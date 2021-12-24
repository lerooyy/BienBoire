<?php
    session_start();
    if (!isset($_SESSION['connecte'])) {
        header('Location: ../index.php');
    } else {
        header('Location: panier.php');
    }
    exit();
?>