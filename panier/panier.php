<?php
if (!isset($_SESSION['connecte'])) {
    header('Location: ../index.php');
    exit();
  }
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="panier.css">
  <link href='https://css.gg/close.css' rel='stylesheet'>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="panier.js"></script>
</head>
<body>
<h1>Mes recettes</h1>
    <div class="contenant">
        <?php 
            /**
             * Code html pour afficher les recettes favorites dans le panier
             */
            $recette;
            foreach($_COOKIE as $key => $value){
                $recetteFavorite = str_replace("_"," ", $value);
                $recette = $recette.'<div class="recetteFavorite">';
                $recette = $recette.'<button onclick=supprimerRecette("'.$key.'") id="supprimerFavoris">Supprimer du panier</button>';
                $recette = $recette.$recetteFavorite;
                $recette = $recette.'</div>';
                $recette = $recette.'<br>';
            }
            echo $recette;
        ?>
    </div>
    <script>
    </script>
</body>
</html>