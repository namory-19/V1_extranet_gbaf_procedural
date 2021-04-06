<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Page d'inscription à l'extranet GBAF</title>
</head>
<body>
    <?php include("header.php"); ?>
    <section class="page_connexion_inscription">
        <div class="h1_connexion_inscription">
            <h1>
                Formulaire d'inscription à l'extranet GBAF
            </h1>
        </div>
        <div class="formulaire_connexion_inscription">
            <form action="inscription_post_php" method="post">
                <div class="formulaire_nom">
                <label for="name">Nom : </label>
                <br>
                <input type="text" id="name" name="nom">
                </div>
                <br>
                <div class="formulaire_prenom">
                <label for="surname">Prénom : </label>
                <br>
                <input type="text" id="surname" name="prenom">
                </div>
                <br>
                <div class="formulaire_identifiant">
                <label for="identifiant">Identifiant : </label>
                <br>
                <input type="text" id="identifiant" name="usernane">
                </div>
                <br>
                <div class="pass">
                <label for="pass">Mot de passe : </label>
                <br>
                <input type="password" id="pass" name="password">
                </div>
                <br>
                <div class="pass">
                <label for="repass">Retapez votre mot de passe : </label>
                <br>
                <input type="password" id="repass" name="password">
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