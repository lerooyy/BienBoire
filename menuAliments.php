<?php
include 'Donnees.inc.php';

$aliment = $_POST['aliment'];
$parents = $_POST['parents'];
$elements = $_POST['elements'];

$interBaliseParent = "";
$scriptJs = '<script type="text/javascript">';

/**
 * Ici on met en place le code Html pour afficher les parents de la
 * catégorie
 */
if ($parents == NULL || $parents == "") {
    $aliment_se = str_replace(" ", "_", $aliment);
    $aliment_se = str_replace("'", "_", $aliment_se);
    $parents = '<em id="p_'.$aliment_se.'">'.$aliment.'</em>';;
    $interBaliseParent = $parents;
} else if (str_contains($parents, $aliment."<")) {
    /* On supprime la suite du code HTML dans les parents */
    $aliment_se = str_replace(" ", "_", $aliment);
    $aliment_se = str_replace("'", "_", $aliment_se);
    $pos = strpos($parents, '<em id="p_'.$aliment_se.'">'.$aliment.'</em>');
    $parents = substr($parents, 0, $pos);
    $parents = $parents.'<em id="p_'.$aliment_se.'">'.$aliment.'</em>';
    $interBaliseParent = $parents;

    /* Pareil dans elements */
    if (strlen($elements) > 7) {
        $pos = strpos($elements, ' > '.$aliment);
        $elements = substr($elements, 0, $pos);
    }

} else {
    $aliment_se = str_replace(" ", "_", $aliment);
    $aliment_se = str_replace("'", "_", $aliment_se);
    $parents = $parents.' > <em id="p_'.$aliment_se.'">'.$aliment.'</em>';
    $interBaliseParent = $parents;
}

/**
 * On met en place une fonction sur le click de chaque élément
 * parents pour pouvoir revenir en arrière
 */
if ($elements == NULL || $elements == "") {
    $scriptJs = $scriptJs.'document.querySelector("#p_Aliment").addEventListener("click", (event) => {
        toggleAlimentSuivant("Aliment");
    }, false);';

} else if ($elements == "Aliment") {
    $scriptJs = $scriptJs.'document.querySelector("#p_Aliment").addEventListener("click", (event) => {
        toggleAlimentSuivant("Aliment");
    }, false);';

} else {
    $tabE = explode(" > ", $elements);
    foreach($tabE as $value) {
        $value_sans_espace = str_replace(" ", "_", $value);
        $value_sans_espace = str_replace("'", "_", $value_sans_espace);
        $scriptJs = $scriptJs.'document.querySelector("#p_'.$value_sans_espace.'").addEventListener("click", (event) => {
            toggleAlimentSuivant("'.$value.'");
        }, false);';
    }

    $aliment_se = str_replace(" ", "_", $aliment);
    $aliment_se = str_replace("'", "_", $aliment_se);
    $scriptJs = $scriptJs.'document.querySelector("#p_'.$aliment_se.'").addEventListener("click", (event) => {
        toggleAlimentSuivant("'.$aliment.'");
    }, false);';
}


$menuHTML = '<div class="parent">'.$interBaliseParent.'</div>';

/**
 * On récupère le tableau sous-catégorie de 
 * l'aliment qui correspond
 */
$tabAliments = array(); 
foreach ($Hierarchie as $key => $value) {
    if ($key == $aliment) {
        foreach ($value as $k => $v) {
            if ($k == 'sous-categorie') {
                $tabAliments = $v;
            }
        }
    }
}

/**
 * On produit le code HTML pour afficher tous les sous-aliments
 * de l'aliment et on associe à chaque sous-aliment une fonction pour
 * accéder à ses sous-aliments
 */
$menuHTML = $menuHTML.'<nav>';
foreach($tabAliments as $value) {
    $value_sans_espace = str_replace(" ", "_", $value);
    $value_sans_espace = str_replace("'", "_", $value_sans_espace);
    $menuHTML = $menuHTML.'<div id="'.$value_sans_espace.'">'.$value.'</div>';
    $scriptJs = $scriptJs.'document.querySelector("#'.$value_sans_espace.'").addEventListener("click", (event) => {
        toggleAlimentSuivant("'.$value.'");
    }, false);';

    $scriptJs = $scriptJs.'document.querySelector("#'.$value_sans_espace.'").addEventListener("click", (event) => {
        recettesContenant("'.$value.'"); 
    }, false);';
}

$menuHTML = $menuHTML.'</nav>';
$scriptJs = $scriptJs.'</script>';

echo $menuHTML;
echo $scriptJs;
?>