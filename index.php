<?php 
/* Ne pas ounlier de mettre compte.php, confirmationCreerCompte.php, connexion.php
 * et ajouterAuPanier.php, panier sur true */
session_start();
if (!isset($_SESSION['connecte'])) {
    $_SESSION['connecte'] = false;
}
if (!$_SESSION['connecte'] == true) {
    $_SESSION['panier'] = array();
}

$_SESSION['firstToggle'] = 'Aliment';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bien Boire</title>
  <link rel="stylesheet" href="Accueil.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    <header class="baniere">
        <h1>Bien Boire</h1>
        <?php
            if (isset($_SESSION['connecte'])) {
                if ($_SESSION['connecte'] == true) {
                    if (isset($_SESSION['user_id'])) {
                        echo '<div class="utilisateur_co">Bonjour <strong>'.$_SESSION['user_id'].'</strong> !</div>';
                    }
                }
            }
        ?>
        <nav class="menuPrincipal">
            <div class="boutons_menuP openMenu">Aliments</div>
            <div class="boutons_menuP b_recettes">Recettes</div>
            <div class="boutons_menuP b_panier">Panier - <em class="nb_recettesF"><?php echo count($_SESSION['panier']);?></em></div>
            <div class="boutons_menuP b_compte">Compte</div>
        </nav>
    </header>
    <div class="menuAliments">
    <div class="parent"></div>
    </div>
    <script type="text/javascript">
        document.querySelector(".openMenu").addEventListener('click', (event) => {
            toggleAlimentSuivant("");
            toggleMenuAliments();
        }, false);

        document.querySelector(".openMenu").addEventListener('click', (event) => {
            recettesContenant("Aliment","");
        }, false);

        document.querySelector(".b_recettes").addEventListener('click', (event) => {
            recettesContenant("Aliment","");
        }, false);
    </script>

    <div class="instant-search">
    <div class="instant-search__input-container">
        <input type="text" class="instant-search__input" onkeyup=filtering() placeholder="Rechercher..">
        <i class="material-icons instant-search__icon">search</i>
    </div> 
    </div>

    <section class="contenuPrincipal">
    </section>
    <script type="text/javascript">
        <?php 
        if (isset($_SESSION['connecte'])) {

            if ($_SESSION['connecte'] == true) {
                echo 'document.querySelector(".b_compte").addEventListener("click", (event) => {
                    hideMenuAliment();
                    chargerCompte();
                }, false);';
                
            } else {
                echo 'document.querySelector(".b_compte").addEventListener("click", (event) => {
                    window.location.href = "compte/formulaireConnexion.php";
                }, false);';
            }

        } else {
            echo 'document.querySelector(".b_compte").addEventListener("click", (event) => {
                window.location.href = "compte/formulaireConnexion.php";
            }, false);';
        }
        ?>
        document.querySelector(".b_panier").addEventListener('click', (event) => {
            window.location.href = "panier/panier.php";
        }, false);
    </script>
</body>
</html>