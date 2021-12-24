/**
 * Permet de supprimer un cookie contenant une recette favorite
 * @param {*} recette
 */
 function supprimerRecette(numRecette){
    $.post('supprimerRecetteFavorite.php', {
        'r_id':  numRecette
    }, function(data) {
        window.location.reload();
    });
}