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

    function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}

    function subMenuAliments(){
        createCookie("fruitCookie",'Fruit', "1");
    }
    </script>
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

        $menuHTML = '<ul class="subCategories">';
        foreach($tabAliments as $value) {
            $menuHTML = $menuHTML.'<li><a href="#">'.$value.'<a></li>';
        }

        $menuHTML = $menuHTML.'</ul>';

        echo $menuHTML;
        ?>
    </nav>
    <nav>
    <?php

        $tabAliments2 = array(); 
        foreach ($Hierarchie as $key => $value) {
            foreach ($value as $k => $v) {
                //if ($k == 'super-categorie') {
                    foreach($v as $s => $c){
                        if($s == 'super-categorie' && $c == 'Fruit'){ //$_COOKIE["fruitCookie"]
                            $tabAliments2 = $key;
                        }
                    }
                //}
            }
        }

        $menuHTML = '<ul class="subCategories">';
        foreach($tabAliments2 as $value) {
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
        document.querySelector(".subCategories").addEventListener('click', (event) => {
                subMenuAliments();
        }, false);
    </script>
    <div class="contenuPrincipal">
        <section>
            <?php echo "<p>OKfff</p>"  ?>
        </section>
    </div>
</body>

</html>