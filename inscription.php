<?php
session_start(); // On démarre la session pour récupérer les informations destinés au pré-remplissage de la page de connexuon (suite à la création du compte)
if (isset($_POST['username'])) // si le champ username du formulaire comprend des données alors,
{
    $_SESSION['username'] = $_POST['username']; // on ajoute à la session les données liées à l'identifiant récupérées via le formulaire
}
if (isset($_SESSION['id_user'])) // permet de contrôler si l'utlisteur est connecté en vérifiant si l'id_user est présent en session
{
    header('Location: accueil.php'); // si oui, redirige vers la page d'acceuil (inutile d'afficher la page d'inscription à un utilisateur connecté)
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Page d'inscription à l'extranet GBAF</title>
</head>
<?php require_once("core/functions.php"); ?> <!-- ajoute le fichier functions.php pour l'affichage du formulaire via la fonction register_user() -->
<body>
    <?php include("header.php"); ?> <!-- ajoute le header du site-->
    <section class="page_connexion_inscription">
        <div class="h1_connexion_inscription">
            <h1>
                Formulaire d'inscription à l'extranet GBAF
            </h1>
        </div>
       <?php   
        require_once("core/database.php"); //ajoute le fichier database.php pour la connexion à la BDD
        $bdd=get_bdd(); // initialise la fonction get_bdd() puis la stocke dans la variable $bdd
        ?>
        <div class="formulaire_connexion_inscription">
            <form action="inscription.php" method="post"> <!-- forumulaire d'inscription-->
                    <div class="formulaire_nom">
                        <label for="name">Nom : </label>
                        <br>
                        <input type="text" id="name" name="nom" value="<?php echo isset($_POST['nom'])? $_POST['nom'] : ''?>" autofocus required> <!-- champ pour le nom avec préremplissage du champ avec les informations déjà remplis (en cas de rechargement du formulaire)-->
                    </div>
                    <br>
                    <div class="formulaire_prenom">
                        <label for="surname">Prénom : </label>
                        <br>
                        <input type="text" id="surname" name="prenom" value="<?php echo isset($_POST['prenom'])? $_POST['prenom'] : ''?>" required> <!-- champ pour le prénom avec préremplissage du champ avec les informations déjà remplis (en cas de rechargement du formulaire)-->
                    </div>
                    <br>
                    <div class="formulaire_mail">
                        <label for="mail">Mail : </label>
                        <br>
                        <input type="email" id="mail" name="mail" value="<?php echo isset($_POST['mail'])? $_POST['mail'] : ''?>" oncopy="return false;" oncut="return false;" required> <!-- champ pour l'adresse mail avec l'interdiction de copier ou couper cette dernière-->
                    </div>
                    <br>
                    <div class="formulaire_mail">
                        <label for="remail">Retapez votre adresse mail : </label>
                        <br>
                        <input type="email" id="remail" name="remail" value="<?php echo isset($_POST['remail'])? $_POST['remail'] : ''?>" onpaste="return false;" required> <!-- champ de véfification de l'adresse mail avec l'interdiction de coller l'adresse directement-->
                    </div>
                    <br>
                    <div class="formulaire_identifiant">
                        <label for="identifiant">Identifiant : </label>
                        <br>
                        <input type="text" id="identifiant" name="username" value="<?php echo isset($_POST['username'])? $_POST['username'] : ''?>" required> <!-- champ pour l'identifiant avec préremplissage du champ avec les informations déjà remplis (en cas de rechargement du formulaire)-->
                    </div>
                    <br>
                    <div class="pass">
                        <label for="pass">Mot de passe (Minimum : 8 à 15 caractères, 1 majuscule, 1 miniscule, 1 chiffre, 1 caractère spécial ) : </label>
                        <br>
                        <input type="password" id="pass" name="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required> <!-- champ pour le mot de passe avec regex pour restriendre le choix à des conditions particlières -->
                    </div>
                    <br>
                    <div class="repass">
                        <label for="repass">Retapez votre mot de passe : </label>
                        <br>
                        <input type="password" id="repass" name="repassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required> <!-- champ pour la vérification du mot de passe avec regex pour restriendre le choix à des conditions particlières -->
                    </div>
                    <br>
                    <div class="question">
                    <label for="question">Choisissez une question secrète : </label> <!-- champ à choix multiples pour la gestion de question secrète (utile en cas de réucpération de mot de passe) -->
                        <select name="question" id="question" required>
                            <option value="Quelle est votre ville de naissance?" selected >Quelle est votre ville de naissance?</option>
                            <option value="Quel est votre chanteur/groupe préféré?">Quel est votre chanteur/groupe préféré?</option>
                            <option value="Dans quel pays aimeriez-vous voyager?">Dans quel pays aimeriez-vous voyager?</option>
                            <option value="Quelle est votre boisson préférée?">Quelle est votre boisson préférée?</option>
                        </select>
                    </div>
                    <br>
                    <div class="reponse">
                        <label for="reponse">Votre réponse : </label> <!-- champ pour la réponse à la question secrète -->
                        <br>
                        <input type="text" id="reponse" name="reponse" value="<?php echo isset($_POST['reponse'])? $_POST['reponse'] : ''?>" required>
                    </div>
                    <br>
                <input type="submit" value="S'inscrire" class="button_submit">
            </form>
        </div>
       <?php 
        register_user(); // va chercher la fonction qui controle le formulaire d'inscription dans core/functions.php
        ?>
        <p>
            Déjà inscrit? <a href="/connexion.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour vous connecter à l'extranet GBAF. <!-- lien vers la page de connexion -->
        </p>
    </section>
    <?php include("footer.php"); ?> <!-- ajoute le footer du site-->
</body>
</html>