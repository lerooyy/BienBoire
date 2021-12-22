function verifierConnexion() {
    var user_id = document.querySelector("#user_id");
    var mdp = document.querySelector("#mdp");

    $.post('connexion.php', {
        'user_id': user_id.value,
        'mdp': mdp.value
    }, function(data) {
        console.log(data);
        if (data == 1) {
            document.querySelector(".erreur_co").classList.remove("visible");
            document.location.href = "../index.php";
        } else {
            document.querySelector(".erreur_co").classList.add("visible");
        }
    });
}