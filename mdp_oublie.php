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
    <?php include("header.php"); ?> <!--  Charge le header -->
    <section class="page_connexion_inscription">
        <div class="h1_connexion_inscription">
            <h1>
                Mot de passe oublié
            </h1>
        </div>
        <div class="formulaire_connexion_inscription">
            <form action="mdp_oublie.php" method="post">
                    <div class="formulaire_identifiant">
                        <label for="identifiant">Identifiant : </label>
                        <br>
                        <input type="text" id="identifiant" name="username" value="<?php echo isset($_POST['username'])? $_POST['username'] : ''?>" autofocus required> <!-- champ pour l'identifiant avec préremplissage du champ avec les informations déjà remplis (en cas de rechargement du formulaire)-->
                    </div>
                    <br>
                    <?php
                    if (isset($_POST['username'])) // vérifie si la variable est déclarée et est différente de null.
                    {
                        require_once("core/database.php"); //Charge le fichier permettant la connexion à la BDD
                        $bdd=get_bdd(); // Fonction permettant l'accès à la BDD
                        $reponse = $bdd->prepare('SELECT username, question, reponse, password FROM user WHERE username = :username'); // va chercher dans la BDD la ligne corresponsant au username entré dans le formulaire de connexion
                        $reponse->execute(array(
                            'username' => $_POST['username'],
                        ));
                        $donnees = $reponse->fetch();

                        if ($donnees) // si l'username correspond alors il affiche la question correspondante
                        { 
                            ?>
                            <div class="question">
                                <p>
                                    Répondez à la question suivante et saisissez votre nouveau mot de passe : <br><?php echo ($donnees['question']) ?>
                                </p>
                            </div>
                            <br>
                            <div class="reponse">
                                <label for="reponse">Votre réponse : </label>
                                <br>
                                <input type="text" id="reponse" name="reponse" required>
                            </div>
                            <br>
                            <br>
                            <div class="pass">
                                <label for="pass">Votre nouveau mot de passe (Minimum : 8 à 15 caractères, 1 majuscule, 1 miniscule, 1 chiffre, 1 caractère spécial ) : </label>
                                <br>
                                <input type="password" id="pass" name="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required> <!-- champ pour le mot de passe avec regex pour restriendre le choix à des conditions particlières -->

                            </div>
                            <br>
                            <br>
                            <div class="repass">
                                <label for="repass">Retapez votre nouveau mot de passe : </label>
                                <br>
                                <input type="password" id="repass" name="repassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" required> <!-- champ pour le mot de passe avec regex pour restriendre le choix à des conditions particlières -->

                            </div>
                            <br>
                            <?php
                            if (isset($_POST['reponse'])) // si la réponse est présente
                            {
                                $reponse_user = strtolower($_POST['reponse']); // passe la chaine de caractère (réponse) en minuscule
                                if ($reponse_user === $donnees['reponse']) // si la réponse saisie est identique à la réponse stockée en base
                                {
                                    if ($_POST['password'] === $_POST['repassword']) // vérifie si les mots de passe entrés dans les deux champs sont identiques.
                                    {
                                        $password = $_POST['password']; 
                                        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $password)) // vérifie si le mot de passe respecte la régle imposée : 8 à 15 caractères, 1 majuscule minimum, 1 miniscule minimum, 1 chiffre minimum, 1 caractère spécial.
                                        {
                                            $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT); // crée une clé de hachage pour le mot de passe
                                            $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
                                            $reponse = $bdd->prepare('UPDATE user SET password = :password WHERE username = :username'); // insère le nouveau mot de passe en base dans la table "user"
                                            $reponse->execute(array(
                                                'password' => $pass_hache,
                                                'username' => $_POST['username']
                                            ));
                                            ?> 
                                            <div class="msg_success">  <!-- message pour informer l'utilisateur que son mot de passe a été changé-->
                                            <p>Félicitation, votre mot de passe a été changé avec succès! <a href="/connexion.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour vous connecter à l'extranet GBAF.</p>
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            ?> 
                                            <div class="msg_error"> <!-- message pour informer l'utilisateur que le mot de passe ne respecte pas la régle-->
                                            <p>Votre mot de passe ne respecte pas la régle imposée : 8 à 15 caractères, 1 majuscule minimum, 1 miniscule minimum, 1 chiffre minimum, 1 caractère spécial.</p>
                                            </div>
                                            <br>
                                            <?php  
                                        }
                                    }
                                    else
                                    {
                                        ?> 
                                        <div class="msg_error"> <!-- message pour informer l'utilisateur que les mots de passe saisis ne sont pas identiques-->
                                        <p>Vos mots de passe ne sont pas identiques, merci de corriger votre saisie.</p>
                                        </div>
                                        <br>
                                        <?php     
                                    }
                                }
                                else
                                {
                                    ?> 
                                    <div class="msg_error"> <!-- message pour informer que la réponse à la question n'est pas bonne-->
                                    <p>La réponse à la question n'est pas bonne, merci de corriger votre saisie.</p>
                                    </div>
                                    <br>
                                    <?php     
                                }
                            }
                        }
                        else
                        {
                            ?>
                            <br>
                            <div class="msg_error"> <!-- message pour informer l'utilisateur que l'identifiant n'est pas bon-->
                            <p>Votre identfiant n'est pas bon, merci de corriger votre saisie.</p>
                            </div>
                            <br>
                            <?php    
                        }
                    }
                    ?> 
                <input type="submit" value="Envoyer" class="button_submit">
            </form>
        </div>
        <p>
            Déjà inscrit? <a href="/connexion.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour vous connecter à l'extranet GBAF.
        </p>
    </section>
    <?php include("footer.php"); ?> <!--  Charge le footer -->
</body>
</html>