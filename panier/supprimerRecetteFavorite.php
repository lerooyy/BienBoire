<?php
session_start();

if (!isset($_SESSION['connecte'])) {
    header('Location: ../index.php');
    exit();
}

$r_id = $_POST['r_id'];


//Si un utilisateur est connecté on retire la racette de la table concernée
if ($_SESSION['connecte'] == true) {    

    // Connexion à la base de donnée en local ou en ligne 
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

    // On regarde si la recette fait  déja parties des favoris
    $retirerDesFavorites = true;

    $stmt = mysqli_prepare($bdd, "SELECT * RecettesFavorites WHERE user_id=? AND r_id=?;");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user_id'], $r_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $col1, $col2);
        mysqli_stmt_fetch($stmt);

        if ($col1 == $user_id || $col2 == $r_id) {
            $retirerDesFavorites = false;
        }
    }

    // On va retirer la recette des favorites
    if ($retirerDesFavorites) {
        $stmt = mysqli_prepare($bdd, "DELETE FROM RecettesFavorites WHERE user_id=? AND r_id=?;");
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $_SESSION['user_id'], $r_id);
            mysqli_stmt_execute($stmt);
        }
    }

    mysqli_close($bdd);
}

$tab = array();
// Que l'utilisateur soit connecté ou pas on retire la recette du panier
if (in_array($r_id, $_SESSION['panier'])) {
    foreach($_SESSION['panier'] as $value) {
        
        if ($value != $r_id) {
            array_push($tab, $value);
            echo $value;
        }
    }

    unset($_SESSION['panier']);
    $_SESSION['panier'] = array();

    foreach($tab as $value) {
        array_push($_SESSION['panier'], $value);
    }
}

?>