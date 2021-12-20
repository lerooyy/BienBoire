<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bien Boire</title>
  <link rel="stylesheet" href="Accueil.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="index.js"></script>
  <script>
  </script>
</head>
<body>
    <header>
        <h1>Bien Boire</h1>
        <nav class="menuPrincipal">
            <ul>
                <li><div class="openMenu">Aliments</div></li>
                <li><a href="#">Recettes<a></li>
                <li><a href="#">Panier<a></li>
                <li><a href="#">Compte<a></li>
            </ul>
        </nav>
    </header>
    <div class="menuAliments">
        <div class="parent"></div>
        <nav class="menuAliments_nav">
        </nav>
    </div>
    <script type="text/javascript">
        document.querySelector(".openMenu").addEventListener('click', (event) => {
            toggleAlimentSuivant("Aliment");
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