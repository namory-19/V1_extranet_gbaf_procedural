<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Page d'inscription à l'extranet GBAF</title>
</head>
<?php require_once("core/functions.php"); ?>
<body>
    <?php include("header.php"); ?>
    <section class="page_connexion_inscription">
        <div class="h1_connexion_inscription">
            <h1>
                Formulaire d'inscription à l'extranet GBAF
            </h1>
        </div>
       <?php   
        require_once("core/database.php");
        $bdd=get_bdd();
        ?>
        <div class="formulaire_connexion_inscription">
            <form action="inscription.php" method="post">
                    <div class="formulaire_nom">
                        <label for="name">Nom : </label>
                        <br>
                        <input type="text" id="name" name="nom" value="<?php echo isset($_POST['nom'])? $_POST['nom'] : ''?>" autofocus required>
                    </div>
                    <br>
                    <div class="formulaire_prenom">
                        <label for="surname">Prénom : </label>
                        <br>
                        <input type="text" id="surname" name="prenom" value="<?php echo isset($_POST['prenom'])? $_POST['prenom'] : ''?>" required>
                    </div>
                    <br>
                    <div class="formulaire_mail">
                        <label for="mail">Mail : </label>
                        <br>
                        <input type="email" id="mail" name="mail" value="<?php echo isset($_POST['mail'])? $_POST['mail'] : ''?>" oncopy="return false;" oncut="return false;" required>
                    </div>
                    <br>
                    <div class="formulaire_mail">
                        <label for="remail">Retapez votre adresse mail : </label>
                        <br>
                        <input type="email" id="remail" name="remail" value="<?php echo isset($_POST['remail'])? $_POST['remail'] : ''?>" onpaste="return false;" required>
                    </div>
                    <br>
                    <div class="formulaire_identifiant">
                        <label for="identifiant">Identifiant : </label>
                        <br>
                        <input type="text" id="identifiant" name="username" value="<?php echo isset($_POST['username'])? $_POST['username'] : ''?>" required>
                    </div>
                    <br>
                    <div class="pass">
                        <label for="pass">Mot de passe (Minimum : 8 à 15 caractères, 1 majuscule, 1 miniscule, 1 chiffre, 1 caractère spécial ) : </label>
                        <br>
                        <input type="password" id="pass" name="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required>
                    </div>
                    <br>
                    <div class="repass">
                        <label for="repass">Retapez votre mot de passe : </label>
                        <br>
                        <input type="password" id="repass" name="repassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required>
                    </div>
                    <br>
                    <div class="question">
                    <label for="question">Choisissez une question secrète : </label>
                        <select name="question" id="question" required>
                            <option value="Quelle est votre ville de naissance?" selected >Quelle est votre ville de naissance?</option>
                            <option value="Quel est votre chanteur/groupe préféré?">Quel est votre chanteur/groupe préféré?</option>
                            <option value="Dans quel pays aimeriez-vous voyager?">Dans quel pays aimeriez-vous voyager?</option>
                            <option value="Quelle est votre boisson préférée?">Quelle est votre boisson préférée?</option>
                        </select>
                    </div>
                    <br>
                    <div class="reponse">
                        <label for="reponse">Votre réponse : </label>
                        <br>
                        <input type="text" id="reponse" name="reponse" value="<?php echo isset($_POST['reponse'])? $_POST['reponse'] : ''?>" required>
                    </div>
                    <br>
                <input type="submit" value="S'inscrire" class="button_submit">
            </form>
        </div>
       <?php 
        register_user();
        ?>
        <p>
            Déjà inscrit? <a href="/connexion.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour vous connecter à l'extranet GBAF.
        </p>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>