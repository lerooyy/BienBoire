<?php // Création de la base de données 

  function query($link,$requete)
  { 
    $resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
	  return($resultat);
  }

  include 'Donnees.inc.php';

  
$mysqli=mysqli_connect('127.0.0.1', 'root', '') or die("Erreur de connexion");
$base="BienBoire";
$Sql="
		DROP DATABASE IF EXISTS $base;
		CREATE DATABASE $base;
		USE $base;
		CREATE TABLE Utilisateurs (user_id VARCHAR(30) PRIMARY KEY,
        mdp VARCHAR(30) NOT NULL, 
        nom VARCHAR(30) NOT NULL, 
        prenom VARCHAR(30) NOT NULL, 
        sexe INT NOT NULL, 
        adresse VARCHAR(250), 
        ville VARCHAR(100), 
        code_postal VARCHAR(5), 
        email VARCHAR(250) UNIQUE NOT NULL, 
        phone VARCHAR(10),
        d_naissance VARCHAR(10) NOT NULL);

    CREATE TABLE Recettes (r_id INT PRIMARY KEY, 
        titre VARCHAR(300) NOT NULL, 
        ingredients VARCHAR(500) NOT NULL, 
        preparation VARCHAR(1000) NOT NULL, 
        r_index VARCHAR(500) NOT NULL);
    
    CREATE TABLE RecettesFavorites (user_id VARCHAR(30),
        r_id INT,
        PRIMARY KEY (user_id, r_id),
        FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id),
        FOREIGN KEY (r_id) REFERENCES Recettes(r_id))";

foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

$r_id = "";
$titre = "";
$ingredients = "";
$preparation = "";
$r_index = "";


foreach ($Recettes as $r_id => $recette) {
  foreach ($recette as $colone => $valeur) {
    if ($colone == 'titre') {
      $titre = $valeur;
    } else if ($colone == 'ingredients') {
      $ingredients = $valeur;
    } else if ($colone == 'preparation') {
      $preparation = $valeur;
    } else if ($colone == 'index') {
      $r_index = "";
      foreach ($valeur as $aliment) {
        if ($r_index == "") {
          $r_index = $aliment;
        } else {
          $r_index = $r_index.'|'.$aliment;
        }
      }
    }
  }

  $stmt = mysqli_prepare($mysqli, "INSERT INTO Recettes VALUES(?, ?, ?, ?, ?);");
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "issss", $r_id, $titre, $ingredients, $preparation, $r_index);
    mysqli_stmt_execute($stmt);
  }
}

mysqli_close($mysqli);
?>