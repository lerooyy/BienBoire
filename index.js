/**
 * Procédure qui permet d'afficher ou de cacher le menu des aliments
 */
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

/**
 * Cette fonction va permettre d'affiché les sous aliments d'un aliment passé en 
 * paramètre dans le menu des aliments
 * @param {*} aliment 
 */
function toggleAlimentSuivant(aliment) {

    var textHtmlParent = document.querySelector(".parent");
    textHtmlParent.innerHTML = textHtmlParent.innerHTML + '<em>'+aliment+' > </em>';
    //console.log(textHtmlParent);

    $.post('menuAliments.php', {
        'aliment':  aliment
    }, function(data) {
        $('.menuAliments_nav').html(data);
    });
}