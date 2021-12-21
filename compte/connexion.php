<?php

$user_id = $_POST['user_id'];
$mdp = $_POST['mdp'];

$connexion = true;

/* Connexion à la base de donnée en local ou en ligne */
$surLeWeb = false; // mettre sur true lorsque on est sur le serveur

if ($surLeWeb) {
    $bdd = mysqli_connect('db5005953828.hosting-data.io', 'dbu1391417', 'Wa$Sr89K!', 'dbs4989374', 3306);
    if (mysqli_connect_errno()) {
        printf("Echec de la conexion : %s\n", mysqli_connect_error());
        $connexion = false;
    }
} else {
    $bdd= mysqli_connect('127.0.0.1', 'root', '', 'BienBoire');
	if (mysqli_connect_errno()) {
		echo "Echec lors de la connexion à MySQL: ".mysqli_connect_error();
        $connexion = false;
	}
}

/* On check l'utilisateur */
$stmt = mysqli_prepare($bdd, "SELECT user_id, mdp FROM Utilisateurs WHERE user_id=?;");

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $col1, $col2);
    mysqli_stmt_fetch($stmt);


    if (!empty($resultat)) {
        $connexion = false;
    }

    if ($col2 != $mdp) {
        $connexion = false;
    }
} else {
    $connexion = false;
}


printf("%d", $connexion);
?>