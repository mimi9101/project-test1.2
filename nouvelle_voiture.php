<?php

echo "<pre>";
print_r($_POST); 
echo "</pre>";

$message = "";

if (isset($_POST["marque"]) && !empty($_POST["marque"])
    && isset($_POST["modele"]) && !empty($_POST["modele"])
    && isset($_POST["puissance"]) && !empty($_POST["puissance"])
    && isset($_POST["annee"]) && !empty($_POST["annee"])
    && isset($_POST["couleur"]) && !empty($_POST["couleur"])
    ){

        $marque = ucfirst(trim($_POST["marque"])); // Avec trim et ucfirst, je m'assure qu'il n'y ai pas d'espacements inutiles, et que la première lettre est en majuscule
        $modele = $_POST["modele"];
        $puissance = $_POST["puissance"];
        $annee = $_POST["annee"];
        $couleur = $_POST["couleur"];


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


        $requetePrepare = $bdd->prepare("INSERT INTO voiture (marque, modele, puissance, annee, couleur) VALUES (?, ?, ?, ?, ?)");

        $resultat = $requetePrepare->execute([
            $marque,
            $modele,
            $puissance,
            $annee,
            $couleur
        ]);

        if ($resultat){
            $message = "<div class=\"alert alert-success\" role=\"alert\">
            Bravo, votre $marque a bien été ajouté à la base de donnée !
          </div>";
        }else{
            $message = "<div class=\"alert alert-danger\" role=\"alert\">
            Oups ! Quelque chose ne s'est pas déroulé correctement ! 
          </div>";
        }
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
        <title>Nouvelle voiture</title>
        <link rel="icon" href="images/smiley-tire-la-langue.jpg" type="image/gif" sizes="16x16">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css" /> 
    </head>

    <body>
        <h1 class="text-center my-5">Ajouter une nouvelle voiture</h1>

        <?= $message; ?>


        <form action="" method="post" class="container">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="marque" name="marque" placeholder="Renault">
                <label for="marque">Marque</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="modele"  name="modele" placeholder="Serie-A">
                <label for="modele">Modèle</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="puissance"  name="puissance" placeholder="7">
                <label for="puissance">Puissance en chevaux</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="annee"  name="annee" placeholder="2015">
                <label for="annee">Année</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="couleur"  name="couleur" placeholder="Rouge">
                <label for="couleur">Couleur</label>
            </div>
            <input type="submit" class="d-block mx-auto my-5">
        </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
