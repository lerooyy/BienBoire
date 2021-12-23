<?php
session_start();

if (!isset($_SESSION['connecte'])) {
    header('Location: "../index.php');
    exit();
}

$r_id = $_POST['r_id'];

/**
 * Si un utilisateur est connecté on ajoute alors toutes les recettes favoris dans la bdd
 * Sinon on les ajoutes juste dans une variable session
 */

if ($_SESSION['connecte'] == true) {    

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

    /* On regarde si la recette fait  déja parties des favoris */
    $ajouterAuFavoris = true;

    $stmt = mysqli_prepare($bdd, "SELECT * RecettesFavorites WHERE user_id=? AND r_id=?;");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user_id'], $r_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $col1, $col2);
        mysqli_stmt_fetch($stmt);

        if ($col1 == $user_id || $col2 == $r_id) {
            $ajouterAuFavoris = false;
        }
    }

    /* On va insérer une nouvelle recette favorite dans le tableau correspondant */
    if ($ajouterAuFavoris) {
        $stmt = mysqli_prepare($bdd, "INSERT INTO RecettesFavorites VALUES(?, ?);");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user_id'], $r_id);
            mysqli_stmt_execute($stmt);
        }
    }

    mysqli_close($bdd);
}

/* Que l'utilisateur soit connecté ou pas on ajoute la recette au panier */
array_push($_SESSION['panier'], $r_id);
?>