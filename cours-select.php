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


// Notre objectif est d'afficher le résultat d'une requete

$resultatRequete = $bdd->query("SELECT * FROM voiture");

// On constate que $resultatRequete ne contient pas directement tout le resultat de la requete, mais qu'il contient un objet

// echo "<pre>";
// print_r($resultatRequete);
// echo "</pre>";

// La méthode fetch nous permet de recuperer une ligne sous forme d'un tableau
// ATTENTION, il permet de recupérer uniquement la première ligne
// $uneLigne = $resultatRequete->fetch(PDO::FETCH_ASSOC);


// PDO::FETCH_ASSOC;    Permet d'avoir les noms de colonne comme index
// PDO::FETCH_NUM;      Permet d'avoir une liste numeroté dans l'ordre
// PDO::FETCH_BOTH;     Permet d'avoir les deux

// echo "<pre>";
// print_r($uneLigne);
// echo "</pre>";

// POUR RECUPERER TOUTES LES LIGNES, JE PEUX FAIRE UN FETCH_ALL

$toutesLesLignes = $resultatRequete->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($toutesLesLignes);
// echo "</pre>";












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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css" /> 
    </head>

    <body>
        <h1 class="text-center my-5">Liste des voitures</h1>
        <table class="table table-striped container w-75 mx-auto mt-5">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Puissance</th>
                    <th scope="col">Année</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Parcours toutes les lignes
                    foreach($toutesLesLignes as $ligne => $listeLigne){
                        ?>
                        <tr>
                            <th scope="row"><?= $listeLigne["id"]; ?></th>
                            <td><?= $listeLigne["marque"]; ?></td>
                            <td><?= $listeLigne["modele"]; ?></td>
                            <td><?= $listeLigne["puissance"]; ?> chv</td>
                            <td><?= $listeLigne["annee"]; ?></td>
                            <td><a href="detail-voiture.php?id=<?= $listeLigne["id"]; ?>" class="btn btn-primary">Detail</a></td>
                        <tr>

                        <?php

                    }
                ?>
                
            </tbody>
        </table>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
