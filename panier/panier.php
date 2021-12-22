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
        <?php //récupérer recettes dans les cookies
            //echo $_COOKIE['recette'];
            $recette;
            foreach($_COOKIE as $key => $value){
                $recetteFavorite = str_replace("_"," ", $value);
                $recette = $recette.'<div class="recetteFavorite">';
                $recette = $recette.'<button onclick=supprimerRecette("'.$key.'")>Supprimer du panier</button>';
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