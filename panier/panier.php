<?php
session_start();
if (!isset($_SESSION['connecte'])) {
    header('Location: ../index.php');
    exit();
}

$codeHtml = "";

if (count($_SESSION['panier']) == 0) {
    $codeHtml = '<div class="recettes">Vous n\'avez aucune recettes favorites ! </br> Vous pouvez les ajouter directement à l\'aide de la liste des recettes !</div>';
} else {

    // Connexion à la base de donnée en local ou en ligne
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

    $nb_recettes = count($_SESSION['panier']);
    // On va récupérer les recettes préférées de l'utilisateur

    $r_id = "";
    $titre = "";
    $ingredients = "";
    $preparation = "";
    $r_index = "";

    for ($i = 0; $i < $nb_recettes; $i++) {
        $r_id = "";
        $titre = "";
        $ingredients = "";
        $preparation = "";
        $r_index = "";

        $stmt = mysqli_prepare($bdd, "SELECT r_id, titre, ingredients, preparation, r_index FROM Recettes WHERE r_id=?;");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['panier'][$i]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $r_id, $titre, $ingredients, $preparation, $r_index);
            mysqli_stmt_fetch($stmt);
        }

        mysqli_stmt_close($stmt);

        // On met chaque recette en forme html
        $tabIngredients = explode("|", $ingredients);

        $codeHtml = $codeHtml.'<div class="recette" id="'.$r_id.'">';
        $codeHtml = $codeHtml.'<h2 class="titre">'.$titre.'</h2>';
        $codeHtml = $codeHtml.'<ul class="ingredients">';
        foreach ($tabIngredients as $ingredient) {
            $codeHtml = $codeHtml.'<li>'.$ingredient.'</li>';
        }
        $codeHtml = $codeHtml.'</ul>';
        $codeHtml = $codeHtml.'<div class="preparation">'.$preparation.'</div>';
        $codeHtml = $codeHtml.'</div>';

    }
}

    mysqli_close($bdd);
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="panier.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="panier.js"></script>
</head>
<body>
<h1>Mes recettes</h1>
<div class="contenant">
    <?php echo $codeHtml; ?>
</div>
    <script></script>
</body>
</html>