/**
 * Affiche une erreur
 * @param {*} input 
 * @param {*} message 
 */
function montrerErreur(input, message) {
    var formCrtl = input.parentElement;
    formCrtl.className = "input error";
    var erreur = formCrtl.querySelector("small");
    erreur.innerText = message;
}

/**
 * Affiche visuellement lorsque les champs sont validé
 * @param {*} input 
 */
function montrerSucces(input) {
    var formCrtl = input.parentElement;
    formCrtl.className = "input success";
}

/**
 * Fias un check de tous les champs nécessaire
 * @param {*} tabInput 
 * @returns 
 */
function checkRequis(tabInput) {
    var bool = true;
    tabInput.forEach(function (input) {
        if (input.value.trim() === "") {
            montrerErreur(input, `${getNomChamp(input)} est requis.`);
            bool = false;
        } else {
            montrerSucces(input);
        }
    });

    return bool;
}

/**
 * Retourne l'id d'un champ
 * @param {*} input 
 * @returns 
 */
function getNomChamp(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

/**
 * Check la taille d'un champ
 * @param {*} input 
 * @param {*} min 
 * @param {*} max 
 * @returns 
 */
function checkTaille(input, min, max) {
    var bool = true;
    if (input.value.length < min) {
        montrerErreur(input, `${getNomChamp(input)} doit faire au moins ${min} caractères.`);
        bool = false;
    } else if (input.value.length > max) {
        montrerErreur(input, `${getNomChamp(input)} doit faire moins de ${max} caractères.`);
        bool = false;
    } else {
        montrerSucces(input);
    }
    return bool;
}

/**
 * Check la validité d'un email
 * @param {*} input 
 * @returns 
 */
function checkEmail(input) {
    var bool = true;
    const re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var valid = input.value.toLowerCase().match(re);

    if (valid) {
        montrerSucces(input);
    } else {
        montrerErreur(input, "Email non valide");
        bool = false;
    }
    return bool;
}

/**
 * Check si les mots de passes sont correspondants
 * @param {*} input1 
 * @param {*} input2 
 * @returns 
 */
function checkMDPcorrespond(input1, input2) {
    var bool = true;

    if (input1.value !== input2.value) {
        montrerErreur(input2, "Les mots de passe ne correspondent pas.");
        bool = false;
    }

    return bool;
}

/**
 * Check la validité du code postal
 * @param {*} input 
 * @returns 
 */
function checkCodeP(input) {
    const re = /[0-9]{5}/i;
    var valid = input.value.match(re);
    var bool = true;

    if (valid) {
        montrerSucess(input);
    } else {
        montrerErreur(input, `${getNomChamp(input)} doit être composé de 5 chiffres.`)
        bool = false;
    }

    return bool;
}

function postFormulaire() {
    var user_id = document.querySelector("#user_id");
    var nom = document.querySelector("#nom");
    var prenom = document.querySelector("#prenom");
    var nom = document.querySelector("#nom");
    var sexe = document.querySelector(".radio_b:checked");
    var d_naissance = document.querySelector("#d_naissance");
    var adresse = document.querySelector("#adresse");
    var code_postal = document.querySelector("#code_postal");
    var ville = document.querySelector("#ville");
    var phone = document.querySelector("#phone");
    var email = document.querySelector("#email");
    var mdp = document.querySelector("#mdp");

    console.log("Envoie du post");

    $.post('confirmationCreerCompte.php', {
        'user_id': user_id.value,
        'nom': nom.value,
        'prenom': prenom.value,
        'sexe': sexe.value,
        'd_naissance': d_naissance.value,
        'adresse': adresse.value,
        'code_postal': code_postal.value,
        'ville': ville.value,
        'phone': phone.value,
        'email': email.value,
        'mdp': mdp.value
    }, function(data) {
        if (data.includes("0", 0)) {
            document.querySelector(".erreurPrincipal").innerText = "Erreur Création compte. Changez username."
            document.querySelector(".erreurPrincipal").classList.add("erreur");
        } else if (data.includes("1", 0)) {
            document.querySelector(".erreurPrincipal").classList.add("success");
            document.location.href = "formulaireConnexion.html";
        } else {
            document.querySelector(".erreurPrincipal").innerText = "Erreur Création compte."
            document.querySelector(".erreurPrincipal").classList.add("erreur");
        }
    });
}