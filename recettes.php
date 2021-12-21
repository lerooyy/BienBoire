<?php
include 'Donnees.inc.php';

$aliment = $_POST['aliment'];
$typeIngredient = $_POST['typeIngredient']; //inutile pour le moment

$tabIngredientsConcernés = array();

$menuHTML = '<ul>';

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
foreach($Recettes as $key => $value){
    foreach($value as $k => $v){
        if($k != 'index'){
            $foo = false;
            foreach($tabRecettesNum as $num){
                if($key == $num){
                    foreach($tabRecettes as $recette){
                        if($recette == $v){
                            $foo = true;
                        }
                    }
                    if(!$foo){
                        array_push($tabRecettes, $v);
                    }
                }
            }
        }
    }
}

$scriptJs = '<script type="text/javascript">';
//$menuHTML = '<ul>';
foreach($tabRecettes as $value) {
    $menuHTML = $menuHTML.'<li><div id="'.$value.'">'.$value.'</div></li>';
    /*$scriptJs = $scriptJs.'document.querySelector("#'.$value.'").addEventListener("click", (event) => {
        recettesContenant("'.$value.'");
    }, false);';*/
}
$menuHTML = $menuHTML.'</ul>';
$scriptJs = $scriptJs.'</script>';

echo $menuHTML;
echo $scriptJs;
?>