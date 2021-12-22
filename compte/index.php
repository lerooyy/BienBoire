<?php
  session_start();
  if (!isset($_SESSION['connecte'])) {
    header('Location: ../index.php');
  } else {
    header('Location: formulaireConnexion.php');
  }
  exit();
?>