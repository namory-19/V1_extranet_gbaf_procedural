<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Mot de passe oublié pour l'accès à l'extranet GBAF</title>
</head>
<body>
    <?php include("header.php"); ?>
    <section class="page_connexion_inscription">
        <div class="h1_connexion_inscription">
            <h1>
                Mot de passe oublié
            </h1>
        </div>
        <?php
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root'); // connexion à la BDD
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); // affichage des erreurs SQL
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage()); // message d'erreur si problème connexion BDD
        }
        $reponse = $bdd->query('SELECT username, question, reponse FROM user');
        $donnees = $reponse->fetch();
        ?>
        <div class="formulaire_connexion_inscription">
            <form action="inscription_post_php" method="post">
                    <div class="formulaire_identifiant">
                        <label for="identifiant">Identifiant : </label>
                        <br>
                        <input type="text" id="identifiant" name="username" required>
                    </div>
                    <br>
                    <div class="pass">
                        <label for="pass">Mot de passe : </label>
                        <br>
                        <input type="password" id="pass" name="password" required>
                    </div>
                    <br>
                    <div class="repass">
                        <label for="repass">Retapez votre mot de passe : </label>
                        <br>
                        <input type="password" id="repass" name="repassword" required>
                    </div>
                    <br>
                    <div class="question">



                    <br>
                    <div class="reponse">
                        <label for="reponse">Votre réponse : </label>
                        <br>
                        <input type="text" id="reponse" name="reponse" required>
                    </div>
                    <br>
                <input type="submit" value="S'inscrire" class="button_submit">
            </form>
        </div>
        <p>
            Déjà inscrit? <a href="/connexion.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour vous connecter à l'extranet GBAF.
        </p>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>