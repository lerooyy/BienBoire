<?php 
session_start();
if (!isset($_SESSION['connecte'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['connecte'] == true) {
    header('Location: ../index.php');
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="formulaireConnexion.css">
  <link href='https://css.gg/close.css' rel='stylesheet'>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="formulaireConnexion.js"></script>
</head>
<body>
    <div class="contenant">
        <i class="gg-close"></i>
        <h1>Connexion</h1>
        <form action="" id="form" class="form">
            <div class="input">
                <label form="user_id">Nom d'Utilisateur</label>
                <input type="text" name="user_id" id="user_id" placeholder="Nom d'Utilisateur" autocomplete="off" />
                <small>Message Erreur</small>
            </div>
            <div class="input">
                <label for="mdp">Mot de Passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="Mot De Passe" />
                <small>Message Erreur</small>
            </div>
            <strong class="erreur_co">Connexion impossible : Identifiant ou Mot de Passe Incorrect</strong>
            <div class="boutons">
                <button id="connexion">Connexion</button>
                <button id="creer_compte">Créer un compte</button>
            </div>
        </form>
    </div>
    <script>
        document.querySelector("#form").addEventListener("submit", (event) => {
            event.preventDefault();
        });

        document.querySelector("#creer_compte").addEventListener("click", (event) => {
            window.location.href = "formulaireCreerCompte.php";
        });

        document.querySelector(".gg-close").addEventListener("click", (event) => {
            window.location.href = "../index.php";
        });

        document.querySelector("#connexion").addEventListener("click", (event) => {
            verifierConnexion();
        });
    </script>
</body>
</html>