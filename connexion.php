<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Page de connexion à l'extranet GBAF</title>
</head>
<body>
    <?php include("header.php"); ?>
    <section class="page_connexion_inscription">
        <div class="h1_connexion_inscription">
            <h1>
                Formulaire de connexion à l'extranet GBAF
            </h1>
        </div>
        <div class="formulaire_connexion_inscription">
            <form action="connexion_post_php" method="post">
                <div class="formulaire_identifiant">
                <label for="identifiant">Identifiant : </label>
                <br>
                <input type="text" id="identifiant" name="username">
                </div>
                <br>
                <div class="pass">
                <label for="pass">Mot de passe : </label>
                <br>
                <input type="password" id="pass" name="password">
                </div>
                <br>
                <input type="submit" value="Se connecter" class="button_submit">
            </form>
        </div>
        <p>
            Vous avez oublié votre mot de passe? <a href="/mdp_oublie.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour le regénérer.
        </p>
        <p>
            Toujours pas inscrit? <a href="/inscription.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour créer votre compte à l'extranet GBAF.
        </p>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>