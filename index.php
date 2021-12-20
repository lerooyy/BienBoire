<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bien Boire</title>
  <link rel="stylesheet" href="Accueil.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript">
    function toggleMenuAliments() {
        var menu = document.querySelector(".menuAliments");
        if (menu.classList.contains("invisible")) {
            menu.classList.remove("invisible");
        } else {
            menu.classList.add("invisible");
        }

        var container = document.querySelector(".contenuPrincipal");
        if (container.classList.contains("menu-visible")) {
            container.classList.remove("menu-visible");
        } else {
            container.classList.add("menu-visible");
        }
    }

    </script>
  <script src="index.js"></script>
  <script>
  </script>
</head>
<body>
    <header>
        <h1>Bien Boire</h1>
        <nav class="menuPrincipal">
            <ul>
                <li><div class="boutons_menuP openMenu">Aliments</div></li>
                <li><div class="boutons_menuP b_recettes">Recettes</div></li>
                <li><div class="boutons_menuP b_panier">Panier</div></li>
                <li><div class="boutons_menuP b_compte">Compte</div></li>
            </ul>
        </nav>
    </header>
    <div class="menuAliments">
    <div class="parent"></div>
    </div>
    <script type="text/javascript">
        document.querySelector(".openMenu").addEventListener('click', (event) => {
            toggleAlimentSuivant("Aliment");
            toggleMenuAliments();
        }, false);
    </script>
    <section class="contenuPrincipal">
    </section>
    <script type="text/javascript">
        document.querySelector(".b_compte").addEventListener('click', (event) => {
            window.location.href = "compte/formulaireConnexion.html";
        }, false);
    </script>
</body>
</html>