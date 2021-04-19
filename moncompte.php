<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
if (!isset($_SESSION['id_user'])) // On contrôle si la session est démarré en vérifiant qu'elle contient l'id_user (récupéré à la connexion)
{
    header('Location: connexion.php'); // sinon retour à la page de connexion
}
require_once('core/functions.php')
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Paramètre du compte sur l'extranet GBAF</title>
</head>
<body>
    <?php include("header.php");?>
    <section class="informations_user">
    <div class="h1_moncompte_center">
            <h1>
                Mon compte à l'extranet GBAF
            </h1>
     </div>
    <p>
        Retrouvez sur cette page toutes vos informations personnelles (nom, prénom, mail, identifiant, ...), vos commentaires, vos likes et bien plus encore!
        C'est également ici que vous pourrez modifier vos données (mot de passe, avatar, identifiant, ...)
    </p>
    <div class="infos_perso">
        <h2>
            Mes informations personnelles
        </h2>
        <p>
            Vous trouverez ci-dessous vos informations personnelles. Ces dernières sont facilement modifiables.
        </p>
        <div class="formulaire_infos_perso">
            <form action="moncompte.php" method="post"> <!-- forumulaire de modification des informations personnelles-->
                    <div class="formulaire_nom">
                        <label for="name"><strong>Nom : </strong></label>
                        <br>
                        <input type="text" id="name" name="nom" value="<?php echo isset($_POST['nom'])? strtoupper($_POST['nom']) : $_SESSION['nom'];?>" autofocus required> <!-- champ pour le nom avec préremplissage du champ avec les informations déjà remplis (en cas de rechargement du formulaire)-->
                    </div>
                    <br>
                    <div class="formulaire_prenom">
                        <label for="surname"><strong>Prénom : </strong></label>
                        <br>
                        <input type="text" id="surname" name="prenom" value="<?php echo isset($_POST['prenom'])? $_POST['prenom'] : $_SESSION['prenom'];?>" required> <!-- champ pour le prénom avec préremplissage du champ avec les informations déjà remplis (en cas de rechargement du formulaire)-->
                    </div>
                    <br>
                    <div class="formulaire_mail">
                        <label for="mail"><strong>Mail : </strong></label>
                        <br>
                        <input type="email" id="mail" name="mail" value="<?php echo $_SESSION['mail'];?>" onpaste="return false;" required> <!-- champ pour l'adresse mail avec l'interdiction de coller une adresse mail dedans-->
                    </div>
                    <br>
                <input id="ancre_name" type="submit" value="Modifier" class="button_submit">
                <?php 
                modify_user(); // va chercher la fonction qui controle le formulaire d'inscription dans core/functions.php
                ?>
            </form>
        </div>
    </div>
    <div class="separator"></div>
    <div class="infos_perso">
        <h2>
            Mes informations de connexion
        </h2>
        <p>
            Vous trouverez ci-dessous vos informations de connexion. Il vous est possible de changer votre identifiant et votre mot de passe aisément.
        </p>
        <div class="formulaire_infos_perso">
            <form action="moncompte.php" method="post"> <!-- forumulaire de modification des informations personnelles-->
                    <div class="formulaire_identifiant">
                        <label for="identifiant"><strong>Identifiant :  </strong></label>
                        <br>
                        <input type="text" id="identifiant" name="username" value="<?php echo isset($_POST['username'])? $_POST['username'] : $_SESSION['username'];?>" required> <!-- champ pour l'identifiant avec préremplissage du champ avec les informations déjà remplis (en cas de rechargement du formulaire)-->
                    </div>
                    <br>
                    <div class="pass">
                        <label for="pass"><strong>Mot de passe actuel : </strong></label>
                        <br>
                        <input type="password" id="actualpass" name="actualpass" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required> <!-- champ pour le mot de passe avec regex pour restriendre le choix à des conditions particlières -->
                    </div>
                    <br>
                    <div class="pass">
                        <label for="pass"><strong>Nouveau mot de passe (Minimum : 8 à 15 caractères, 1 majuscule, 1 miniscule, 1 chiffre, 1 caractère spécial ) :  </strong></label>
                        <br>
                        <input type="password" id="pass" name="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required> <!-- champ pour le mot de passe avec regex pour restriendre le choix à des conditions particlières -->
                    </div>
                    <br>
                    <div class="repass">
                        <label for="repass"><strong>Retapez votre nouveau mot de passe :  </strong></label>
                        <br>
                        <input type="password" id="repass" name="repassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required> <!-- champ pour la vérification du mot de passe avec regex pour restriendre le choix à des conditions particlières -->
                    </div>
                    <br>
                <input type="submit" value="Modifier" class="button_submit">
                <?php 
                modify_connexion(); // va chercher la fonction qui controle le formulaire d'inscription dans core/functions.php
                ?>
            </form>
        </div>
    </div>
    <div class="separator"></div>
    <div class="infos_perso">
        <h2>
            Ma récupération de mot de passe
        </h2>
        <p>
            Vous trouverez ci-dessous un formulaire vous permettant de changer votre question secrète. Celle-ci est utilisée pour changer de mot de passe lorsque vous oubliez ce dernier.
        </p>
        <div class="formulaire_infos_perso">
            <form action="moncompte.php" method="post"> <!-- forumulaire de modification des informations personnelles-->
                    <p>
                        La question que vous avez choisi lors de votre inscription est : <strong><?php echo isset($_POST['question'])? $_POST['question'] : $_SESSION['question'];?></strong>
                    </p>
                    <div class="question">
                    <label for="question"><strong>Choisissez une question secrète :  </strong></label> <!-- champ à choix multiples pour la gestion de question secrète (utile en cas de réucpération de mot de passe) -->
                        <select name="question" id="question" required>
                            <option value="" >Choisissez dans la liste</option>
                            <option value="Quelle est votre ville de naissance?" >Quelle est votre ville de naissance?</option>
                            <option value="Quel est votre chanteur/groupe préféré?">Quel est votre chanteur/groupe préféré?</option>
                            <option value="Dans quel pays aimeriez-vous voyager?">Dans quel pays aimeriez-vous voyager?</option>
                            <option value="Quelle est votre boisson préférée?">Quelle est votre boisson préférée?</option>
                        </select>
                    </div>
                    <br>
                    <div class="reponse">
                        <label for="reponse"><strong>Votre réponse actuelle:  </strong></label> <!-- champ pour la réponse à la question secrète -->
                        <br>
                        <input type="text" id="reponse" name="reponse" value="<?php echo isset($_POST['reponse'])? $_POST['reponse'] : $_SESSION['reponse'];?>" required>
                    </div>
                    <br>
                <input type="submit" value="Modifier" class="button_submit">
                <?php 
                modify_question_secrete(); // va chercher la fonction qui controle la modification du formulaire de changement de question secrète dans core/functions.php
                ?>
            </form>
        </div>
    </div>
    <div class="separator"></div>
    <div class="infos_perso">
        <h2>
            Mon avatar
        </h2>
        <p>
            Vous trouverez ci-dessous votre image de profil actuelle. Il vous est possible de la changer autant de fois que vous désirez.
        </p>
            <div class="avatar_img">
            <p>
            <strong>Votre image de profil actuelle est : </strong>
            </p>
            <img id="ancre_avatar" src="<?php echo view_img_avatar() ?>" alt="image profil">
            <br>
            </div>
        <div class="formulaire_infos_perso">
            <form action="moncompte.php" method="post" enctype="multipart/form-data"> <!-- forumulaire d'envoie d'images'-->
                    <div class="send_image">
                        <label for="avatar"><strong>Envoyer une nouvelle image <br>(type autorisé : png, gif, jpg, jpeg et poids <= 1mo) :  </strong><br></label> <!-- champ pour la réponse à la question secrète -->
                        <br>
                        <input type="file" id="avatar" name="avatar" required>
                    </div>
                    <br>
                <input type="submit" value="Envoyer" class="button_submit">
                <?php 
                add_modify_img_avatar(); // va chercher la fonction qui controle l'ajout ou la modification d'image dans core/functions.php
                ?>
            </form>
        </div>
    </div>
    <div class="separator"></div>
    <div class="infos_perso">
        <h2>
            Mes avis
        </h2>
        <p>
            Vous trouverez ci-dessous vos commentaires et vos likes.
        </p>
    </div>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>