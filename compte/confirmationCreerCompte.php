<?php
$confirmation = true;

$user_id = $_POST['user_id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$sexe = $_POST['sexe'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$code_postal = $_POST['code_postal'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$phone = $_POST['phone'];
$d_naissance = $_POST['d_naissance'];

/* Connexion à la base de donnée en local ou en ligne */
$surLeWeb = false; // mettre sur true lorsque on est sur le serveur

if ($surLeWeb) {
    $bdd = mysqli_connect('db5005953828.hosting-data.io', 'dbu1391417', 'Wa$Sr89K!', 'dbs4989374', 3306);
    if (mysqli_connect_errno()) {
        printf("Echec de la conexion : %s\n", mysqli_connect_error());
        $confirmation = false;
    }
} else {
    $bdd= mysqli_connect('127.0.0.1', 'root', '', 'BienBoire');
	if (mysqli_connect_errno()) {
		echo "Echec lors de la connexion à MySQL: ".mysqli_connect_error();
        $confirmation = false;
	}
}

/* Check user_id */
if (empty($user_id)) {
    $confirmation = false;
} else if (strlen($user_id) < 3 || strlen($user_id) > 30) {
    $confirmation = false;
} else {
    /* On check dans la base de donnée si l'utilisateur existe */
    $stmt = mysqli_prepare($bdd, "SELECT user_id FROM Utilisateurs WHERE user_id=?;");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $resultat);
        mysqli_stmt_fetch($stmt);


        if (!empty($resultat)) {
            $confirmation = false;
        }
    }
}

/* Check nom */
if (empty($nom)) {
    $confirmation = false;
} else if (strlen($nom) < 3 || strlen($nom) > 30) {
    $confirmation = false;
}

/* Check prénom */
if (empty($prenom)) {
    $confirmation = false;
} else if (strlen($prenom) < 3 || strlen($prenom) > 30) {
    $confirmation = false;
}

/* Check sexe */
if (empty($sexe)) {
    $confirmation = false;
} else {
    /* On code le sexe sous la forme d'un int pour facilité homme = 0, femme = 1*/
    if ($sexe == "homme") {
        $sexe = 0;
    } else {
        $sexe = 1;
    }
}

/* Check adresse */
if (!empty($adresse)) {
    if (strlen($adresse) > 250) {
        $confirmation = false;
    }
}


/* Check ville */
if (!empty($ville)) {
    if (strlen($ville) > 100) {
        $confirmation = false;
    }
}


/* Check code_postal */
if (!empty($code_postal)) {
    if (!preg_match("/^[0-9]{5}$/", $code_postal)) {
        $confirmation = false;
    }
}


/* Check email */
$paternEmail = "/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i";
if (empty($email)) {
    $confirmation = false;
} else if (!preg_match($paternEmail, $email)) {
    $confirmation = false;
}

/*Check mdp */
if (empty($mdp)) {
    $confirmation = false;
} else if (strlen($mdp) < 4 || strlen($mdp) > 30) {
    $confirmation = false;
}

/* Check phone */
if (!empty($phone)) {
    if (!preg_match("/[0-9]{10}/", $phone)) {
        $confirmation = false;
    }
}

/* Si tout est bon on ajoute l'utilisateur à la base de donnée */
if ($confirmation) {

    $stmt = mysqli_prepare($bdd, "INSERT INTO Utilisateurs VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssissisis", $user_id, $mdp, $nom, $prenom, $sexe, 
        $adresse, $ville, $code_postal, $email, $phone, $d_naissance);
        $ret = mysqli_stmt_execute($stmt);
        echo "$ret";
    } else {
        $confirmation = false;
    }

}

printf("%d\n", $confirmation);

?>