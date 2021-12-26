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
        if (data != 0) {
            $('.menuAliments').html(data);
        }
    });

}

/**
 * Permet d'afficher les recettes contenant un type d'élément (et ses sous-catégories)
 * @param {*}
 */
function recettesContenant(){
    //var contenu = document.querySelector(".contenuPrincipal");
    $.post('recettes.php', {
        'aliments':  arguments
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
    $.post('panier/ajouterAuPanier.php', {
        'r_id': recette
    }, function (data) {
        document.querySelector(".nb_recettesF").innerText = data;
    });
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
 * Met en majuscule la première lettre d'un mot et le reste en minuscule
 * @param {*} string
 */
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

/**
 * Trie les recettes en fonction des éléments rentrés dans la barre de recherche
 */
function filtering(){
    var input = document.getElementsByClassName('instant-search__input')[0];
    var filter = input.value;
    filter = (capitalizeFirstLetter(filter));
    //var aliments = filter.split(' ');
    //var copieAliments = [];

    //for(var i = 0; i<aliments.length; i++){
      //  copieAliments.push(capitalizeFirstLetter(aliments[i]));
    //}
    
    recettesContenant(filter);
}


//AUTO-COMPLETION

/**
 * Gère l'auto-complétion dans la barre de recherche avec tous les aliments existants
 * @param {*} inp 
 * @param {*} arr 
 */
function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;

        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");

        this.parentNode.appendChild(a);
        
        for (i = 0; i < arr.length; i++) {
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            b = document.createElement("DIV");
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e) {
                inp.value = this.getElementsByTagName("input")[0].value;
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });

    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) { //down arrow
          currentFocus++;
          addActive(x);
        } else if (e.keyCode == 38) { //up arrow
          currentFocus--;
          addActive(x);
        } else if (e.keyCode == 13) { //enter
          e.preventDefault();
          if (currentFocus > -1) {
            if (x) x[currentFocus].click();
          }
        }
    });

    /**
     * Rend une classe active
     * @param {*} x 
     * @returns 
     */
    function addActive(x) {
      if (!x) return false;
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      x[currentFocus].classList.add("autocomplete-active");
    }

    /**
     * Supprime la classe active
     * @param {*} x 
     */
    function removeActive(x) {
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    /** 
     * Ferme la liste d'auto-complétion
     * @param {*} elmnt
    */
    function closeAllLists(elmnt) {
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
        }
    }
  }
  
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
  } 