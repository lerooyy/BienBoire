/**
 * Permet de supprimer un cookie contenant une recette favorite
 * @param {*} recette
 */
 function supprimerRecette(recette){
    document.cookie = recette + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    window.location.reload(); //On recharge la page pour prendre en compte la suppression du cookie
}