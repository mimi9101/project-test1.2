<?php

// echo "<pre>";
// print_r($_POST); 
// echo "</pre>";

$message = "";
// Je verifie juste que $_POST N'est pas vide 
// Sans plus de controle, ceci n'est pas une bonne pratique
if (!empty($_POST)){


    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $age = trim($_POST["age"]);
    $permis = $_POST["permis"];
    $ville = trim($_POST["ville"]);
    $mail = trim($_POST["email"]);
    $mdpHache = password_hash(trim($_POST["mdp"]), PASSWORD_DEFAULT);

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

    // Je prepare ma requete
    $requetePrepare = $bdd->prepare("INSERT INTO conducteur (nom, prenom, age, permis, email, ville, mdp) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Puis j'execute ma requete
    $resultat = $requetePrepare->execute([
        $nom,
        $prenom,
        $age,
        $permis,
        $mail,
        $ville,
        $mdpHache
    ]);


    if ($resultat){
        echo "<p>Le conducteur $nom $prenom a bien été ajouté</p>";
    }else{
        echo "<p>Il y a eu un soucis avec l'enregistrement en base de donnée !</p>";
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
        <h1 class="text-center my-5">Ajouter un nouveau conducteur</h1>

        <?= $message; ?>


        <form action="" method="post" class="container">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Renault">
                <label for="nom">Nom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="prenom"  name="prenom" placeholder="Serie-A">
                <label for="prenom">Prenom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="age"  name="age" placeholder="7">
                <label for="age">Age</label>
            </div>
            
            <select class="form-select mb-3" aria-label="Selectionner le permis" name="permis">
                <option selected value="">Selectionner votre permis</option>
                <option value="permis-b">Permis B</option>
                <option value="permis-pl">Permis Poids Lourd (D)</option>
                <option value="permis-a">Permis Moto (A)</option>
                <option value="permis-bateau">Permis Bateau</option>
            </select>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ville"  name="ville" placeholder="Rouge">
                <label for="ville">Ville</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email"  name="email" placeholder="Rouge">
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="mdp"  name="mdp" placeholder="Rouge">
                <label for="mdp">Mot de passe</label>
            </div>

            <input type="submit" class="d-block mx-auto my-5">
        </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>
