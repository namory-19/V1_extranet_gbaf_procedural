<?php
require_once("core/database.php"); // appelle le fichier permettant la connexion à la BDD.


//
//
// fonction permettant le fonctionnement du formulaire d'inscription à l'extranet coté utilisateur.
//
//

function register_user()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.

    if (isset ($_POST['nom']) && ($_POST['prenom'])  && ($_POST['mail']) && ($_POST['username']) && ($_POST['password']) && ($_POST['repassword']) && ($_POST['question']) && ($_POST['reponse'])) // vérifie si les variables sont déclarées et sont différentes de null.
    {
        if ($_POST['password'] === $_POST['repassword']) // vérifie si les mots de passe entrés dans les deux champs sont identiques.
        {
            $password = $_POST['password']; 
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $password)) // vérifie si le mot de passe respecte la régle imposée : 8 à 15 caractères, 1 majuscule minimum, 1 miniscule minimum, 1 chiffre minimum, 1 caractère spécial.
            {
                if ($_POST['mail'] === $_POST['remail']) // vérifie si ls mails entrés dans les deux champs sont identiques.
                {
                    $reponse = $bdd->prepare('SELECT username FROM user WHERE username = :username'); // va chercher dans la BDD si le "username" défini dans le formulaire est présent en base
                    $reponse->execute(array(
                        'username' => $_POST['username'],
                    ));
                    $donnees = $reponse->fetch();
                    if ($donnees == false) // si le "username" n'a pas été trouvé, il est donc libre, l'utilisateur peut poursuivre son inscription et prendre le "username" choisi
                    {
                        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
                        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT); // crée une clé de hachage pour le mot de passe
                        $reponse = $bdd->prepare('INSERT INTO user(nom, prenom, mail, username, password, question, reponse, active, usergroup, date_inscription) VALUES(upper(:nom), :prenom, :mail, :username, :password, :question, lower(:reponse), 1, 1, NOW())'); // insére tous les informations du formulaire en base dans la table "user"
                        $reponse->execute(array(
                            'nom' => $_POST['nom'],
                            'prenom' => $_POST['prenom'],
                            'mail' => $_POST['mail'],
                            'username' => $_POST['username'],
                            'password' => $pass_hache,
                            'question' => $_POST['question'],
                            'reponse' => $_POST['reponse']
                        ));
                        ?> 
                        <div class="msg_success">  <!-- message pour informer l'utilisateur que son compte a été créé-->
                        <p>Félicitation, votre compte a été créé avec succès! <a href="/connexion.php" target="_blank" rel="noopener noreferrer">Cliquez ici</a> pour vous connecter à l'extranet GBAF.</p>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <br>
                        <br>
                        <div class="msg_error"> <!-- message pour informer l'utilisateur que le "username" est déjà pris - présent en base-->
                        <p>Cet identifiant est déjà pris, merci d'en choisir un autre</p>
                        </div>
                        <br>
                        <?php    
                    }           
                }
                else
                {
                    ?>
                    <br>
                    <br>
                    <div class="msg_error"> <!-- message pour informer l'utilisateur que les adresses mails saisies ne sont pas identiques-->
                    <p>Vos adresses mail ne sont pas identiques, merci de corriger votre saisie.</p>
                    </div>
                    <br>
                    <?php    
                }
            }  
            else
            {
                ?> 
                <br>
                <br>
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
            <br>
            <br>
            <div class="msg_error"> <!-- message pour informer l'utilisateur que les mots de passe saisis ne sont pas identiques-->
            <p>Vos mots de passe ne sont pas identiques, merci de corriger votre saisie.</p>
            </div>
            <br>
            <?php      
        }
    }  
}
//
//
// fonction permettant le fonctionnement du formulaire de connexion à l'extranet coté utilisateur.
//
//

function connexion_user()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    if (isset ($_POST['username']) && ($_POST['password'])) // vérifie si les variables sont déclarées et sont différentes de null.
    {
        $reponse = $bdd->prepare('SELECT * FROM user WHERE username = :username'); // va chercher dans la BDD la ligne corresponsant au username entré dan sle formuliare de connexion
        $reponse->execute(array(
            'username' => $_POST['username'],
        ));
        $donnees = $reponse->fetch();
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
        
        if ($donnees)
        {
            $nom = $donnees['nom'];
            $_SESSION['nom'] = $nom;
            $prenom = $donnees['prenom'];
            $_SESSION['prenom'] = $prenom;
            $username = $donnees['username'];
            $_SESSION['username'] = $username;
            $id_user = $donnees['id'];
            $_SESSION['id_user'] = $id_user;
            $mail = $donnees['mail'];
            $_SESSION['mail'] = $mail;
            $remail = $donnees['mail'];
            $_SESSION['remail'] = $remail;
            $reponse = $donnees['reponse'];
            $_SESSION['reponse'] = $reponse;
            $question = $donnees['question'];
            $_SESSION['question'] = $question;

            $passcheck = password_verify($_POST['password'], $donnees['password']);

            if ($passcheck)
            {
                header('Location: accueil.php');
            }
            else
            {
                ?> 
                <br>
                <br>
                <div class="msg_error"> <!-- message pour informer l'utilisateur que le mot de passe n'est pas bon-->
                <p>Votre mot de passe n'est pas bon, merci de corriger votre saisie.</p>
                </div>
                <br>
                <?php  
            }
        }
        else
        {
            ?> 
            <br>
            <br>
            <div class="msg_error"> <!-- message pour informer l'utilisateur que l'identifiant n'est pas bon-->
            <p>Votre identfiant n'est pas bon, merci de corriger votre saisie.</p>
            </div>
            <br>
            <?php      
        }
    }
}

//
//
// fonction permettant la modification des informations personnelles sur la page mon compte coté utilisateur.
//
//

function modify_user()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.

    if (isset ($_POST['nom']) && ($_POST['prenom'])  && ($_POST['mail'])) // vérifie si les variables sont déclarées et sont différentes de null.
    {
        $reponse = $bdd->prepare('UPDATE user SET nom = upper(:nom), prenom = :prenom, mail = :mail WHERE username = :username'); // modifie toutes les informations du formulaire en base dans la table "user"
        $reponse->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'mail' => $_POST['mail'],
            'username' => $_SESSION['username']
        ));
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 

        $reponse = $bdd->prepare('SELECT * FROM user WHERE username = :username'); // va chercher dans la BDD la ligne corresponsant au username présent en session
        $reponse->execute(array(
            'username' => $_SESSION['username'],
        ));
        $donnees = $reponse->fetch();
        
        // met à jour la session avec les nouvelles variables (si l'utilisateur à fait des modifications dans ses infos perso)

        $nom = $donnees['nom'];
        $_SESSION['nom'] = $nom;
        $prenom = $donnees['prenom'];
        $_SESSION['prenom'] = $prenom;
        $mail = $donnees['mail'];
        $_SESSION['mail'] = $mail;
        $remail = $donnees['mail'];
        $_SESSION['remail'] = $remail;
        
        ?>
        <br>
        <br>
        <div class="msg_success"> <!-- message pour informer l'utilisateur que les informations de son compte ont été modifiée-->
        <p>Félicitation, vos informations ont été modifiées avec succès!</p>
        </div><?php
        header("Refresh: 2;url=moncompte.php"); // rafraichit la page pour la mise à jour des données dans le header
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
    }              
}

//
//
// fonction permettant la modification des informations de connexion sur la page mon compte coté utilisateur.
//
//


function modify_connexion()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.

    if (isset ($_POST['username']) && ($_POST['actualpass']) && ($_POST['password']) && ($_POST['repassword'])) // vérifie si les variables sont déclarées et sont différentes de null.
    {
        if ($_POST['password'] === $_POST['repassword']) // vérifie si les mots de passe entrés dans les deux champs sont identiques.
        {
            $password = $_POST['password']; 
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $password)) // vérifie si le mot de passe respecte la régle imposée : 8 à 15 caractères, 1 majuscule minimum, 1 miniscule minimum, 1 chiffre minimum, 1 caractère spécial.
            {
                $reponse = $bdd->prepare('SELECT username, password FROM user WHERE username = :username'); // va chercher dans la BDD si le "username" défini dans le formulaire est présent en base
                $reponse->execute(array(
                    'username' => $_POST['username'],
                ));
                    $donnees = $reponse->fetch();
                    
                    $passcheck = password_verify($_POST['actualpass'], $donnees['password']);

                if ($passcheck)
                {
                    if (($donnees == false) || ($donnees['username'] === $_SESSION['username'])) // si le "username" n'a pas été trouvé, il est donc libre || ou si le username entré et le même que celui en session
                    {
                        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
                        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT); // crée une clé de hachage pour le mot de passe
                        $reponse = $bdd->prepare('UPDATE user SET username = :username, password = :password WHERE id = :id_user');
                        $reponse->execute(array(
                            'username' => $_POST['username'],
                            'password' => $pass_hache,
                            'id_user' => $_SESSION['id_user']
                        ));
                        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
                        $reponse = $bdd->prepare('SELECT * FROM user WHERE id = :id_user'); // va chercher dans la BDD l'id_user en session
                        $reponse->execute(array(
                            'id_user' => $_SESSION['id_user']
                        ));
                        $donnees = $reponse->fetch();
                        // met à jour la session avec les nouvelles variables (si l'utilisateur à fait des modifications dans ses infos de connexion)

                        $username = $donnees['username'];
                        $_SESSION['username'] = $username;
                        
                        ?> 
                        <br>
                        <br>
                        <div class="msg_success">  <!-- message pour informer l'utilisateur que ses informations de connexion ont été modifié-->
                        <p>Les modifications ont été apportées avec succès!</p>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?> 
                        <br>
                        <br>
                        <div class="msg_error"> <!-- message pour informer l'utilisateur que le "username" est déjà pris - présent en base-->
                        <p>Cet identifiant est déjà pris, merci d'en choisir un autre</p>
                        </div>
                        <br>
                        <?php    
                    }   
                }
                else
                {
                    ?> 
                    <br>
                    <br>
                    <div class="msg_error"> <!-- message pour informer l'utilisateur que le mot de passe n'est pas bon-->
                    <p>Votre mot de passe actuel n'est pas bon, merci de corriger votre saisie.</p>
                    </div>
                    <br>
                    <?php  
                }        
            }  
            else
            {
                ?> 
                <br>
                <br>
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
            <br>
            <br>
            <div class="msg_error"> <!-- message pour informer l'utilisateur que les mots de passe saisis ne sont pas identiques-->
            <p>Vos mots de passe ne sont pas identiques, merci de corriger votre saisie.</p>
            </div>
            <br>
            <?php      
        }
    }  
}

//
//
// fonction permettant la modification de la question secrète (et sa réponse) sur la page mon compte coté utilisateur.
//
//

function modify_question_secrete()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.

    if (isset ($_POST['question']) && ($_POST['reponse'])) // vérifie si les variables sont déclarées et sont différentes de null.
    {
        $reponse = $bdd->prepare('UPDATE user SET question = :question, reponse = lower(:reponse) WHERE id = :id_user');
        $reponse->execute(array(
            'question' => $_POST['question'],
            'reponse' => $_POST['reponse'],
            'id_user' => $_SESSION['id_user']
        ));
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
        $reponse = $bdd->prepare('SELECT * FROM user WHERE id = :id_user'); // va chercher dans la BDD l'id_user en session
        $reponse->execute(array(
            'id_user' => $_SESSION['id_user']
        ));
        $donnees = $reponse->fetch();
        // met à jour la session avec les nouvelles variables (si l'utilisateur à fait des modifications dans ses infos de connexion)

        $question = $donnees['question'];
        $_SESSION['question'] = $question;
        $reponse = $donnees['reponse'];
        $_SESSION['reponse'] = $reponse;
        
        ?> 
        <br>
        <br>
        <div class="msg_success">  <!-- message pour informer l'utilisateur que ses informations concernant sa question secrète ont été modifié-->
        <p>Les modifications ont été apportées avec succès!</p>
        </div>
        <?php
    }  
}

//
//
// fonction permettant l'affichage de l'avatar sur la page mon compte et dans le header.
//
//

function view_img_avatar()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT url_img_avatar FROM user WHERE id = :id_user'); // va chercher dans la BDD l'id_user en session
    $reponse->execute(array(
        'id_user' => $_SESSION['id_user']
    ));
    $donnees = $reponse->fetch();

    if ($donnees['url_img_avatar'] == false) // si l'url de l'avatar en bdd n'est pas présente
    {
        $avatar_img = 'img/icon_user.png'; // mettre une image par défaut
    }
    else
    {
        $avatar_img = 'img/avatar/'.$donnees['url_img_avatar']; // va chercher l'url pour afficher l'image correspondante à l'utilisateur
    }
    $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
   return $avatar_img;
}


//
//
// fonction permettant l'ajout ou la modification de l'avatar sur la page mon compte
//
//

function add_modify_img_avatar()
{
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) // si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    {
        if ($_FILES['avatar']['size'] <= 1000000) // le fichier doit faire moins de 3mo
        {
            $infosfichier = pathinfo($_FILES['avatar']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG');
            if (in_array($extension_upload, $extensions_autorisees)) // si l'extension est autorisée
            {
             $url_img_avatar = 'avatar_user_'.$_SESSION['id_user'].'.'.$extension_upload;                                   
             move_uploaded_file($_FILES['avatar']['tmp_name'], 'img/avatar/' . basename($url_img_avatar));  // On peut valider le fichier et le stocker définitivement
             
             $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.

             $reponse = $bdd->prepare('UPDATE user SET url_img_avatar = :url_img_avatar WHERE id = :id_user');
             $reponse->execute(array(
                 'url_img_avatar' => $url_img_avatar,
                 'id_user' => $_SESSION['id_user']
             ));
             $_SESSION['url_img_avatar'] = $url_img_avatar;
             ?>
             <br>
             <br>
             <div class="msg_success"><!-- message pour informer l'utilisateur que l'image a bien été uploadé-->
             <p>Votre image a été envoyé avec succès!</p>
             </div><?php
            echo '<script language="Javascript">
            <!--
                  document.location.replace("moncompte.php#ancre_avatar");
            // -->
      </script>';
            }
            else
            {
                ?> 
                <br>
                <br>
                <div class="msg_error"> <!-- message pour informer l'utilisateur que l'image envoyée n'est pas du bon format-->
                <p>L'image envoyée n'est pas du bon format, merci de renvoyer une imag au format : jpg, jpeg, gif ou png .</p>
                </div>
                <br>
                <?php      
            }
        }
        else
        {
            ?> 
            <br>
            <br>
            <div class="msg_error"> <!-- message pour informer l'utilisateur que l'image envoyée est trop lourde-->
            <p>L'image envoyée est trop lourde, merci de renvoyer une image inférieure à 3mo.</p>
            </div>
            <br>
            <?php      
        }
    }
}