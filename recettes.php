<?php
include 'Donnees.inc.php';

$aliment = $_POST['aliment'];
$typeIngredient = $_POST['typeIngredient']; //inutile pour le moment

$tabIngredientsConcernés = array();


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

$tabRecettes = array();
$tabRecettesPartie = array();
foreach($Recettes as $key => $value){
    foreach($value as $k => $v){
        if($k != 'index'){
            $foo = false;
            $recetteComplete = "";
            foreach($tabRecettesNum as $num){
                if($key == $num){
                    foreach($tabRecettesPartie as $recette){
                        if($recette == $v){
                            $foo = true;
                        }
                    }
                    if(!$foo){
                        $recetteComplete = $recetteComplete.$v;
                        array_push($tabRecettesPartie, $v);
                        //array_push($tabRecettes, $v);
                    }
                }
            }
            array_push($tabRecettes, $recetteComplete);
        }
    }
}

$scriptJs = '<script type="text/javascript">';
$menuHTML = '<ul>';
$cpt = 0;
foreach($tabRecettes as $value) {
    if($value != null && $value != ""){
    if($cpt == 0){
        $menuHTML = $menuHTML.'<div class="recette">';
    }
    $menuHTML = $menuHTML.'<li><div>'.$value.'</div></li>';
    $cpt++;
    if($cpt == 3){
        $cpt=0;
        $menuHTML = $menuHTML.'</div>';
    }
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