<?php
session_start(); // On démarre la session pour récupérer les informations destinés au pré-remplissage de la page de connexion (suite à la création du compte)
if (isset($_SESSION['id_user'])) // permet de contrôler si l'utlisteur est connecté en vérifiant si l'id_user est présent en session
{
    header('Location: index.php'); // si oui, redirige vers la page d'acceuil (inutile d'afficher la page connexion à un utilisateur connecté)
}
if (isset($_POST['username']) && ($_POST['password'])) // si le champ username et password du formulaire comprend des données
{
    if (isset($_POST['remember_me'])) // si la check box remember me est cochée
    {
        setcookie('username', $_POST['username'], time() + 365*24*3600, null, null, false, true); // on ajoute la variable username récupéré dans le champ dédié du formulaire de connexion dans la variable username du cookie
        setcookie('password', $_POST['password'], time() + 365*24*3600, null, null, false, true); // on ajoute la variable password récupéré dans le champ dédié du formulaire de connexion dans la variable password du cookie
    }
    else // si elle n'est plus ou pas cochée
    {
        setcookie('username', $_POST['username'], time() -3600, null, null, false, true); // on supprime le cookie
        setcookie('password', $_POST['password'], time() -3600, null, null, false, true); // on supprime le cookie
    }
}  
?>
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
            <form action="connexion.php" method="post">
                <div class="formulaire_identifiant">
                <label for="identifiant">Identifiant : </label>
                <br>
                <input type="text" id="identifiant" name="username" value="<?php if (isset($_SESSION['username'])){echo $_SESSION['username'];}  elseif (isset($_COOKIE['username'])) {echo $_COOKIE['username'];}  else {echo '';}?>" autofocus required>
                </div>
                <br>
                <div class="pass">
                <label for="pass">Mot de passe : </label>
                <br>
                <input type="password" id="pass" name="password" value="<?php if (isset($_SESSION['password'])){echo $_SESSION['password'];}  elseif (isset($_COOKIE['password'])) {echo $_COOKIE['password'];}  else {echo '';}?>" required>
                </div>
                <br>
                <div class="remember">
                <label for="remember">Se souvenir de moi : </label>
                <input type="checkbox" id="remember" name="remember_me">
                </div>
                <br>
                <input type="submit" value="Se connecter" class="button_submit">
            </form>
        </div>
        <?php 
        require_once("core/functions.php"); // ajoute le fichier functions.php pour le traitement du formulaire de connexion via la fonction connexion_user()
        connexion_user(); // va chercher la fonction qui contole le formulaire de connexion dans core/functions.php
        ?>
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