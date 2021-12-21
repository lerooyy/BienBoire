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
            foreach($_COOKIE as $key => $value){
                $recette = str_replace("_"," ", $value);
                echo $recette;
                echo "<br>";
            }
        ?>
    </div>
    <script>
    </script>
</body>
</html>