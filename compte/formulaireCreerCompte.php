<?php 
session_start();
if (!isset($_SESSION['connecte'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['connecte'] == true) {
    header('Location: ../index.php');
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="formulaireCreerCompte.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="formulaireCreerCompte.js"></script>
  <link href='https://css.gg/close.css' rel='stylesheet'>
</head>
<body>
    <div class="contenant">
        <i class="gg-close"></i>
        <h1>Créer Un Compte</h1>
        <form action="" id="form" class="form">
            <div class="input">
                <label for="user_id">Nom d'Utilisateur : </label>
                <input type="text" name="user_id" id="user_id" placeholder="ex : JohnDoe1000" autocomplete="off" />
                <small>Message Erreur</small>
            </div>
            <div class="input">
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom" placeholder="Doe" autocomplete="off" />
                <small>Message Erreur</small>
            </div>
            <div class="input">
                <label for="prenom">Prénom : </label>
                <input type="text" name="prenom" id="prenom" placeholder="John" autocomplete="off" />
                <small>Message Erreur</small>
            </div>
            <div class="inpu">
                <label for="sexe">Sexe : </label>
                <div class="sexe">
                    <div>
                    <input type="radio" class="radio_b" name="sexe" id="r_homme" value="homme" checked/>
                    <label for="r_homme">Homme</label>
                    </div>
                    <div>
                    <input type="radio" class="radio_b" name="sexe" id="r_femme" value="femme"/>
                    <label for="r_femme">Femme</label>
                </div>
                </div>
            </div>
            <div class="input">
                <label for="d_naissance">Date de Naissance : </label>
                <input type="date" name="d_naissance" id="d_naissance" />
            </div>
            <div class="input" >
                <label for="adresse">Adresse : </label>
                <input type="text" name="adresse" id="adresse" placeholder="ex : 3 Rue Général Leclerc" autocomplete="true" />
                <small>Message Erreur</small>
            </div>
            <div class="input ville_cp" >
                <div class="code_postal">
                    <label for="code_postal">Code Postal : </label>
                    <input type="text" name="code_postal" id="code_postal" placeholder="ex : 54000" autocomplete="off" />
                    <small>Message Erreur</small>
                </div>
                <div class="ville">
                    <label for="ville">Ville : </label>
                    <input type="text" name="ville" id="ville" placeholder="ex : Nancy" autocomplete="off" />
                    <small>Message Erreur</small>
                </div>
            </div>
            <div class="input" >
                <label for="phone">Téléphone : </label>
                <input type="tel" name="phone" id="phone" pattern="[0-9]{10}"/>
                <small>Message Erreur</small>
            </div>
            <div class="input" >
                <label for="Email">Email</label>
                <input type="text" name="Email" id="email" placeholder="ex : johndoe@gmail.com" autocomplete="off" />
                <small>Message Erreur</small>
            </div>
            <div class="input">
                <label for="mdp">Mot de Passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="Mot De Passe" />
                <small>Message Erreur</small>
            </div>
            <div class="input">
                <label for="c-mdp">Confirmer Mot De Passe</label>
                <input type="password" name="c-mdp" id="c-mdp" placeholder="Confirmer Mot de Passe" />
                <small>Message Erreur</small>
            </div>
                <small class="erreurPrincipal">Message Erreur</small>
            <button>Créer Compte</button>
        </form>
    </div>
    <script>
        form.addEventListener("submit", (event) => {
            event.preventDefault();
            var form = document.querySelector("#form");
            var user_id = document.querySelector("#user_id");
            var email = document.querySelector("#email");
            var mdp = document.querySelector("#mdp");
            var c_mdp = document.querySelector("#c-mdp");
            var nom = document.querySelector("#nom");
            var prenom = document.querySelector("#prenom");
    
            if (checkRequis([user_id, email, mdp, c_mdp, nom, prenom]) &&
            checkTaille(user_id, 3, 30) && checkTaille(mdp, 4, 30) &&
            checkTaille(nom, 3, 30) && checkEmail(email) &&
            checkTaille(prenom, 3, 30) && checkMDPcorrespond(mdp, c_mdp)) {
                console.log("Formulaire Accepté");
                postFormulaire();
            } else {
            }
        });
    
        document.querySelector(".gg-close").addEventListener("click", (event) => {
            window.location.href = "formulaireConnexion.php";
        });
        
        var date = new Date();
        var dd = String(date.getDate()).padStart(2, '0');
        var mm = String(date.getMonth() + 1).padStart(2, '0');
        var yyyy = date.getFullYear()
        date = yyyy+"-"+mm+"-"+dd;
        document.querySelector("#d_naissance").value = date;
        document.querySelector("#d_naissance").max = date;
    </script>
</body>
</html>