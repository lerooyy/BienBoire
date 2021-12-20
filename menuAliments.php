<?php
include 'Donnees.inc.php';

$aliment = $_POST['aliment'];

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
$scriptJs = '<script type="text/javascript">';
$menuHTML = '<ul>';
foreach($tabAliments as $value) {
    $value_sans_espace = str_replace(" ", "_", $value);
    $value_sans_espace = str_replace("'", "_", $value_sans_espace);
    $menuHTML = $menuHTML.'<li><div id="'.$value_sans_espace.'">'.$value.'</div></li>';
    $scriptJs = $scriptJs.'document.querySelector("#'.$value_sans_espace.'").addEventListener("click", (event) => {
        toggleAlimentSuivant("'.$value.'");
    }, false);';
}

$menuHTML = $menuHTML.'</ul>';
$scriptJs = $scriptJs.'</script>';

echo $menuHTML;
echo $scriptJs;
?>