<?php 
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Compte</title>
  <link rel="stylesheet" href="Accueil.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<?php
if (!isset($_SESSION['connecte'])) {
  header('Location: ../index.php');
  exit();
}

/* Si l'utilisateur est connecté on va récupérer toutes les infos */
if ($_SESSION['connecte'] == false) {
  exit();
}

$user_id = $_SESSION['user_id'];
$mdp;
$nom;
$prenom;
$sexe;
$adresse;
$ville;
$code_postal;
$email;
$phone;
$d_naissance;

/* Connexion à la base de donnée en local ou en ligne */
$surLeWeb = false; // mettre sur true lorsque on est sur le serveur

if ($surLeWeb) {
  $bdd = mysqli_connect('db5005953828.hosting-data.io', 'dbu1391417', 'Wa$Sr89K!', 'dbs4989374', 3306);
  if (mysqli_connect_errno()) {
    printf("Echec de la conexion : %s\n", mysqli_connect_error());
  }
} else {
  $bdd= mysqli_connect('127.0.0.1', 'root', '', 'BienBoire');
  if (mysqli_connect_errno()) {
    echo "Echec lors de la connexion à MySQL: ".mysqli_connect_error();
  }
}

$stmt = mysqli_prepare($bdd, "SELECT mdp, nom, prenom, sexe, adresse, ville, code_postal, email, phone, d_naissance FROM Utilisateurs WHERE user_id=?;");

if ($stmt) {
  mysqli_stmt_bind_param($stmt, "s", $user_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $mdp, $nom, $prenom, $sexe, $adresse, $ville, $code_postal, $email, $phone, $d_naissance);
  mysqli_stmt_fetch($stmt);
}

$taille = strlen($mdp);
$mdp = "";

for ($i = 0; $i < $taille; $i++) {
  $mdp = $mdp."*";
}

if ($sexe == 1) {
  $sexe = "Femme";
} else {
  $sexe = "Homme";
}

$date = explode("-", $d_naissance);
$d_naissance = $date[2].'/'.$date[1].'/'.$date[0];

mysqli_close($bdd);
?>

<div class="contenant_compte">
    <h1>Mon Compte</h1>
    <table class="infos_compte">
    <tr><td class="titre">Nom d'Utilisateur :</td><td class="valeur"><?php echo $user_id ?></td></tr>
    <tr><td class="titre">Mot de Passe :</td><td class="valeur"><?php echo $mdp ?></dtdiv></tr>
    <tr><td class="titre">Prenom :</td><td class="valeur"><?php echo $prenom ?></td></tr>
    <tr><td class="titre">Sexe :</td><td class="valeur"><?php echo $sexe ?></td></tr>
    <tr><td class="titre">Adresse :</td><td class="valeur"><?php echo $adresse ?></td></tr>
    <tr><td class="titre">ville :</td><td class="valeur"><?php echo strtoupper($ville) ?></td></tr>
    <tr><td class="titre">Code Postal :</td><td class="valeur"><?php echo $code_postal ?></td></tr>
    <tr><td class="titre">Email :</td><td class="valeur"><?php echo $email ?></td></tr>
    <tr><td class="titre">Téléphone :</td><td class="valeur"><?php echo $phone ?></td></tr>
    <tr><td class="titre">Date de Naissance :</td><td class="valeur"><?php echo $d_naissance ?></td></td>
    </table>
    <div class="bouton">Deconnexion</div>
  </div>

  <script>
    document.querySelector(".bouton").addEventListener("click", (event) => {
      window.location.href = "compte/deconnexion.php";
    });
  </script>
</html>