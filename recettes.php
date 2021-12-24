<?php
session_start();
if (!isset($_SESSION['connecte'])) {
    header('Location: index.php');
    exit();
  }
include 'Donnees.inc.php';

$aliments = $_POST['aliments'];
$typeIngredient = $_POST['typeIngredient']; //inutile pour le moment

$tabIngredientsConcernés = array();


/**
 * On place les sous-ingrédients directs de l'aliment donné en paramètre
 */

foreach($aliments as $aliment){
    $ingredient = $aliment;
    array_push($tabIngredientsConcernés, $aliment);
    foreach($Hierarchie as $key => $value){
        if($key == $ingredient){
            foreach($value as $k => $v){
                if($k == 'sous-categorie'){
                    foreach($v as $i => $ing){
                        array_push($tabIngredientsConcernés, $ing);
                    }
                }
            }
        }
    }
}

/**
 * On place tous les sous-ingrédients des sous-ingrédients récupérés au dessus 
 */
foreach($Hierarchie as $key => $value){
    foreach($tabIngredientsConcernés as $ingre){
        if($key == $ingre){
            foreach($value as $k => $v){
                if($k == 'sous-categorie'){
                    $foo = false; //Elime les doublons
                    foreach($v as $i => $ing){
                        foreach($tabIngredientsConcernés as $ingred){
                            if($ingred == $ing){
                                $foo = true;
                            }
                        }
                        if(!$foo){
                            array_push($tabIngredientsConcernés, $ing);
                        }
                    }
                }
            }
        }
    }
}

/**
 * On récupère les numéros des recettes concernées (recettes contenant les ingrédients donnés)
 */
$tabRecettesNum = array();
foreach ($Recettes as $key => $value) {
    foreach ($value as $k => $v) {
        if ($k == 'index') {
            foreach($v as $i => $ing){
                foreach($tabIngredientsConcernés as $ingre){
                    if($ing == $ingre){
                        array_push($tabRecettesNum, $key);
                    }
                }
            }
        }
    }
}

/**
 * On place dans tabRecettes les recettes complètes (récupérées grâce à leur clé) 
 */
$numRecettes = array();
$tabRecettes = array();
$tabRecettesPartie = array();
foreach($Recettes as $key => $value){
    $i = 0;
    foreach($value as $k => $v){
        if($k != 'index'){
            $foo = false;
            $recetteComplete = "";
            foreach($tabRecettesNum as $num){
                if($key == $num){
                    foreach($tabRecettesPartie as $partie){
                        if($partie == $v && !str_contains($partie, "bacardi")){ //solution temporaire, puisque les 2 recettes "Bacardi" ont la même liste d'ingrédient
                            $foo = true;
                        }
                    }
                    if(!$foo){
                        $recetteComplete = $recetteComplete.$v;
                        array_push($tabRecettesPartie, $v);
                    }
                }
            }
            if ($recetteComplete != "" && $recetteComplete != NULL) {
                array_push($tabRecettes, $recetteComplete);
                if ($i == 0) {
                    array_push($numRecettes, $key);
                }
     
            }  
        }
        $i++;
    }
}

$imageBoisson;

/**
 * On affiche les recettes et les images (si elles existent pour la boisson donnée)
 */
$scriptJs = '<script type="text/javascript">';
$menuHTML = '<ul>';
$cpt = 0;
$cle = 0;
foreach($tabRecettes as $value) {
    if($cpt == 0){
        $menuHTML = $menuHTML.'<div class="recette">';
    }

    if($cpt == 0){ //titre
        $menuHTML = $menuHTML.'<li><div class="titreRecette">'.$value.'</div></li>';

        $recetteFavorite = str_replace(" ", "_", $value);
        $recetteFavorite = str_replace("...","_",$recetteFavorite);
        $menuHTML = $menuHTML.'<button onclick=ajouterRecette("'.$numRecettes[$cle].'") id="ajouterFavoris">Ajouter au panier</button>';
        $cle++;

        $imageBoisson = str_replace(" ", "_", $value);
        $imageBoisson = 'Photos/'.$imageBoisson.'.jpg';
        if(is_file($imageBoisson)){
            $menuHTML = $menuHTML.'<img class="imageBoisson" src='.$imageBoisson.' />';
        }
    }else if($cpt == 1){ //liste des ingrédients
        $ingredients = explode("|", $value);
        $menuHTML = $menuHTML.'<ul class="listeIngredients">';
        foreach($ingredients as $ingredient){
            $menuHTML = $menuHTML.'<li><div>-'.$ingredient.'</div></li>';
        }
        $menuHTML = $menuHTML.'</ul>';
    }else{
        $menuHTML = $menuHTML.'<li><div>'.$value.'</div></li>';
    }

    $cpt++;
    if($cpt == 3){
        $cpt=0;
        $menuHTML = $menuHTML.'</div>';
    }
    /*$scriptJs = $scriptJs.'document.querySelector("#'.$value.'").addEventListener("click", (event) => {
        recettesContenant("'.$value.'");
    }, false);';*/
}
$menuHTML = $menuHTML.'</ul>';
$scriptJs = $scriptJs.'</script>';

echo $menuHTML;
echo $scriptJs;
?>