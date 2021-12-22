/**
 * Procédure qui permet d'afficher ou de cacher le menu des aliments
 */
function toggleMenuAliments() {
    var menu = document.querySelector(".menuAliments");
    if (menu.classList.contains("visible")) {
        menu.classList.remove("visible");
    } else {
        menu.classList.add("visible");
    }

    var container = document.querySelector(".contenuPrincipal");
    if (container.classList.contains("menu-visible")) {
        container.classList.remove("menu-visible");
    } else {
        container.classList.add("menu-visible");
    }
}

/**
 * Cette fonction va permettre d'affiché les sous aliments d'un aliment passé en 
 * paramètre dans le menu des aliments
 * @param {*} aliment 
 */
function toggleAlimentSuivant(aliment) {

    $.post('menuAliments.php', {
        'aliment':  aliment,
        'parents': document.querySelector(".parent").innerHTML,
        'elements': document.querySelector(".parent").textContent
    }, function(data) {
        $('.menuAliments').html(data);
    });

}

/**
 * Permet d'afficher les recettes contenant un type d'élément (et ses sous-catégories)
 * @param {*} aliment 
 */
function recettesContenant(aliment, typeIngredient){
    //var contenu = document.querySelector(".contenuPrincipal");
    $.post('recettes.php', {
        'aliment':  aliment,
        'typeIngredient': typeIngredient
    }, function(data) {
        $('.contenuPrincipal').html(data);
    });
}


/**
 * Permet de créer un cookie
 * @param {*} nom
 * @param {*} valeur
 * @param {*} jours
 */
function createCookie(nom, valeur, jours) {
    var expires;

    if (jours) {
        var date = new Date();
        date.setTime(date.getTime() + (jours * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = nom + "=" + 
        valeur + expires + "; path=/";
}


/**
 * Permet d'ajouter une recette dans un cookie
 * @param {*} recette
 */
function ajouterRecette(recette){
    createCookie(recette, recette, 1);
}

function hideMenuAliment() {
    var menu = document.querySelector(".menuAliments");
    if (menu.classList.contains("visible")) {
        menu.classList.remove("visible");
    }

    var container = document.querySelector(".contenuPrincipal");
    if (container.classList.contains("menu-visible")) {
        container.classList.remove("menu-visible");
    }

}

function chargerCompte() {
    $(".contenuPrincipal").load("compte/compte.php");
}
/**
 * Trie les recettes en fonction des éléments rentrés dans la barre de recherche
 */
function filtering(){
    var input = document.getElementById('searchInput');
    var filter = input.value;
    
    recettesContenant(filter);
}