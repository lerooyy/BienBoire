<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bien Boire</title>
  <link rel="stylesheet" href="Accueil.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="index.js"></script>
  <?php include 'Donnees.inc.php' ?>
</head>
<body>
    <header>
        <h1>Bien Boire</h1>
        <nav class="menuPrincipal">
            <ul>
                <li><div class="openMenu"> Aliments </div></li>
                <li><a href="#"> Recettes <a></li>
                <li><a href="#"> Panier <a></li>
                <li><a href="#"> Compte <a></li>
            </ul>
        </nav>
    </header>
    <nav class="menuAliments">
        <?php
        $tabAliments = array(); 
        foreach ($Hierarchie as $key => $value) {
            if ($key == 'Aliment') {
                foreach ($value as $k => $v) {
                    if ($k == 'sous-categorie') {
                        $tabAliments = $v;
                    }
                }
            }
        }

        $menuHTML = '<ul>';
        foreach($tabAliments as $value) {
            $menuHTML = $menuHTML.'<li><a href="#">'.$value.'<a></li>';
        }

        $menuHTML = $menuHTML.'</ul>';

        echo $menuHTML;
        ?>
    </nav>
    <script type="text/javascript">
        document.querySelector(".openMenu").addEventListener('click', (event) => {
                toggleMenuAliments();
        }, false);
    </script>
    <div class="contenuPrincipal">
        <section>
            <?php echo "<p>OKfff</p>"  ?>
        </section>
    </div>
</body>

</html>