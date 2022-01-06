<?php

// Connexion à la BDD

$dsn = 'mysql:dbname=php-pdo;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $bdd = new PDO($dsn, $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

// J'utilise la methode exec de la class PDO en lui passant ma requete en argument


$requete = "INSERT INTO voiture (marque, modele, puissance, annee, couleur) VALUES ('bmw', 'z4', 5, 2015, 'white')";


// On utilise la methode exec pour executer une requete
// La methode exec nous renvoie le nombre de ligne  affecté par la requete
// Si le nombre de ligne affecté est superieur a 0 et not false, alors on envoie un message de succes
// Sinon, on envoie un message d'erreur
if ($bdd->exec($requete)){
    echo "<p>La voiture a bien été ajouté en base de donnée !</p>";
}else{
    echo "<p>Erreur : La base de donnée n'a pas été affectée</p>";
}

$marque = "Mercedes";
$modele = "Classe-A";
$puissance = 7;
$annee = 2018;
$couleur = "";
$couleur = "<script>alert(\"SPAM\");</script>";

// On vois que utilisée seul, la méthode exec n'est pas sécurisé
// Elle est susceptible d'être attaqué en utilisant des failles sql, ou des failles XXS
// On utilisera exec uniquement pour des requetes simples qui n'impliquent pas d'inputs utilisateurs

$requete = "INSERT INTO voiture (marque, modele, puissance, annee, couleur) VALUES ('$marque', '$modele', '$puissance', '$annee', '$couleur')";

if ($bdd->exec($requete)){
    echo "<p>La voiture a bien été ajouté en base de donnée !</p>";
}else{
    echo "<p>Erreur : La base de donnée n'a pas été affectée</p>";
}


// La méthode de la préparation de requetes, pour plus de securités

/* On a vu qu'on utilise la methode prepare() pour preparer une requete

    Ensuite, il y a 2 façon de lier les parametres
        Avec BindParam
            ou 
        En argument de execute

    Puis on utilise la méthode execute() pour executer la requete préparer
    Execute nous renvoie true si tout a bien fonctionné, false sinon

    Voir détail de la documentation -> https://www.php.net/manual/fr/pdo.prepared-statements.php

*/


$marque = "Tesla";
$modele = "X";
$puissance = 8;
$annee = 2020;
$couleur = "Noir";


$requetePrepare = $bdd->prepare("INSERT INTO voiture (marque, modele, puissance, annee, couleur) VALUES (?, ?, ?, ?, ?)");

// Si execute s'execute correctement, alors il renvoie true
// Sinon, il renvoie false
$resultat = $requetePrepare->execute([
    $marque,
    $modele,
    $puissance,
    $annee,
    $couleur
]);

if ($resultat){
    echo "<p>La $marque a bien été ajouté</p>";
}else{
    echo "<p>Il y a eu un soucis avec l'enregistrement en base de donnée !</p>";
}


?>






<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="description" content="Web tutorials"><!--description de la page-->
        <meta name="keywords" content="HTML,CSS,JavaScript"> <!--Mot clef de la page-->
        <meta name="author" content="Naggara Samir"><!--Auteur du site-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Base d'une page</title>
        <link rel="icon" href="images/smiley-tire-la-langue.jpg" type="image/gif" sizes="16x16">
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/style.css" /> 
    </head>

    <body>
        <?php  
            echo "<p>Hello World ! </p>";  
        ?>
    </body>

</html>
