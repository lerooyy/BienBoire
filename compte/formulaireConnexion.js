function verifierConnexion() {
    var user_id = document.querySelector("#user_id");
    var mdp = document.querySelector("#mdp");

    $.post('connexion.php', {
        'user_id': user_id.value,
        'mdp': mdp.value
    }, function(data) {
        if (data == 1) {
            document.querySelector(".erreur_co").classList.remove("visible");
        } else {
            document.querySelector(".erreur_co").classList.add("visible");
        }
    });
}