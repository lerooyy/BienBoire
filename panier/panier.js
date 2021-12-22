/**
 * Permet de supprimer un cookie contenant une recette favorite
 * @param {*} recette
 */
 function supprimerRecette(recette){
    
    document.cookie = recette + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    
    window.location.reload();
    //document.cookie = recette + "=" + "something" + "expires=Mon, 02 Oct 2000 01:00:00 GMT" + "; domain=localhost";
    /*
    var exp=new Date();
	exp.setTime (exp.getTime() - 100000000);
	var cval=GetCookie (recette);
	document.cookie=recette+"="+cval+"; expires="+exp.toGMTString() +"; domain=localhost";
    */
}