
function montrerErreur(input, message) {
    var formCrtl = input.parentElement;
    formCrtl.className = "input error";
    var erreur = formCrtl.querySelector("small");
    erreur.innerText = message;
    return false;
}

function montrerSucces(input) {
    var formCrtl = input.parentElement;
    formCrtl.className = "input success";
    return true;
}

function checkRequis(tabInput) {
    tabInput.forEach(function (input) {
        if (input.value.trim() === "") {
            return montrerErreur(input, `${getNomChamp(input)} est requis.`);
        } else {
            return montrerSucces(input);
        }
    });
    return false;
}

function getNomChamp(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

function checkTaille(input, min, max) {
    if (input.value.length < min) {
        return montrerErreur(input, `${getNomChamp(input)} doit faire au moins ${min} caractères.`);
    } else if (input.value.length > max) {
        return montrerErreur(input, `${getNomChamp(input)} doit faire moins de ${max} caractères.`);
    } else {
        return montrerSucces(input);
    }
    return false;
}

function checkEmail(input) {
    const re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    var valid = input.value.toLowerCase().match(re);

    if (valid) {
        return montrerSucces(input);
    } else {
        return montrerErreur(input, "Email non valide");
    }
    return false;
}

function checkMDPcorrespond(input1, input2) {
    if (input1.value !== input2.value) {
        return montrerErreur(input2, "Les mots de passe ne correspondent pas.");
    }
    return true;
}