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
            if($k = 'sous-categorie'){
                foreach($v as $i => $ing){
                    array_push($tabIngredientsConcernés, $ing);
                }
            }
        }
    }
}

/*foreach($Hierarchie as $key => $value){
    foreach($tabIngredientsConcernés as $ingre){
        if($key == $ingre){
            foreach($value as $k => $v){
                if($k = 'sous-categorie'){
                    foreach($v as $i => $ing){
                        array_push($tabIngredientsConcernés, $ing);
                    }
                }   
            }
        }
    }
}*/

$tabRecettesNum = array();
foreach ($Recettes as $key => $value) {
    foreach ($value as $k => $v) {
        if ($k == 'index') {
            //$menuHTML = $menuHTML.'<li><div id="zz">'.$v.'</div></li>';
            foreach($v as $i => $ing){
                //$menuHTML = $menuHTML.'<li><div id="zz">'.$ing.'</div></li>';
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
            foreach($tabRecettesNum as $num){
                if($key == $num){
                    array_push($tabRecettes, $v);
                }
            }
        }
    }
}

$scriptJs = '<script type="text/javascript">';
$menuHTML = '<ul>';
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