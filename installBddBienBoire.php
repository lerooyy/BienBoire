<?php // Création de la base de données 

  function query($link,$requete)
  { 
    $resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
	  return($resultat);
  }

  
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
         code_postal INT, 
         email VARCHAR(250) UNIQUE NOT NULL, 
         phone INT,
         d_naissance VARCHAR(10) NOT NULL)";

foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

mysqli_close($mysqli);
?>