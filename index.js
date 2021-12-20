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