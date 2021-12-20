<?php
include 'Donnees.inc.php';

$aliment = $_POST['aliment'];

//$menuHTML = '<ul>';

$tabRecettesNum = array();
foreach ($Recettes as $key => $value) {
    foreach ($value as $k => $v) {
        if ($k == 'index') {
            //$menuHTML = $menuHTML.'<li><div id="zz">'.$v.'</div></li>';
            foreach($v as $i => $ing){
                //$menuHTML = $menuHTML.'<li><div id="zz">'.$ing.'</div></li>';
                if($ing == $aliment){ //aliment donné en paramètre de recettesContenant
                    array_push($tabRecettesNum, $key);
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