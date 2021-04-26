<?php

require_once(dirname(__FILE__) . '/database.php'); // Appelle le fichier permettant la connexion à la BDD.

//
//
// fonction permettant de supprimer la session
//
//

function kill_session()
{
// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

header('Location: /connexion.php');

}

//
//
// fonction permettant de se deconnecter et de supprimer la session
//
//

function disconnect()
{
    if (isset($_GET['disconnect']))
        {
            kill_session();
        }
}

//
//
// fonction permettant le fonctionnement du formulaire d'inscription à l'extranet
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
                        $reponse = $bdd->prepare('INSERT INTO user(nom, prenom, mail, username, password, question, reponse, url_img_avatar, active, usergroup, date_inscription) VALUES(upper(:nom), :prenom, :mail, :username, :password, :question, lower(:reponse), :url_img_avatar, 1, 1, NOW())'); // insére tous les informations du formulaire en base dans la table "user"
                        $reponse->execute(array(
                            'nom' => $_POST['nom'],
                            'prenom' => $_POST['prenom'],
                            'mail' => $_POST['mail'],
                            'username' => $_POST['username'],
                            'password' => $pass_hache,
                            'question' => $_POST['question'],
                            'reponse' => $_POST['reponse'],
                            'url_img_avatar' => ''

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
        $reponse = $bdd->prepare('SELECT * FROM user WHERE username = :username'); // va chercher dans la BDD la ligne correspondante au username entré dans le formulaire de connexion
        $reponse->execute(array(
            'username' => $_POST['username'],
        ));
        $donnees = $reponse->fetch();
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
        
        if ($donnees) // si il y a des données (crées lors de l'inscription), les mets en session le temps de la connexion à l'extranet
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
            $usergroup = $donnees['usergroup'];
            $_SESSION['usergroup'] = $usergroup;
            $active = $donnees['active'];
            $_SESSION['active'] = $active;

            $passcheck = password_verify($_POST['password'], $donnees['password']); // vérifie que le mot de passe saisie est le même que celui en base
            if ($donnees['active'] === '1') // vérifie que le compte n'a pas été désactivé par un administrateur
            {
                if ($passcheck) // si la vérification du mdp est ok
                {
                    header('Location: index.php'); // envoi vers l'accueil du front office de l'extranet
                }
                else // sinon message d'erreur
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
            else // sinon message d'erreur
            {
                ?> 
                <br>
                <br>
                <div class="msg_error"> <!-- message pour informer l'utilisateur que son compte est désactivé-->
                <p>Votre compte a été désactivé par un administrateur, merci de contacter ce dernier à <a href="mailto:admin@gbaf.fr">admin@gbaf.fr</a></p> 
                </div>
                <br>
                <?php
            }
        }
        else // sinon message d'erreur
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
        $reponse = $bdd->prepare('UPDATE user SET nom = upper(:nom), prenom = :prenom, mail = :mail WHERE username = :username'); // met à jour toutes les informations du formulaire en base dans la table "user"
        $reponse->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'mail' => $_POST['mail'],
            'username' => $_SESSION['username']
        ));
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 

        $reponse = $bdd->prepare('SELECT * FROM user WHERE username = :username'); // va chercher dans la BDD toutes les informations de la table user de la la ligne correspondant au username présent en session
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
        </div>
        <?php
        
        echo '<script language="Javascript">
        <!--
          document.location.replace("moncompte.php");
        // -->
        </script>';

        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
    }              
}

//
//
// fonction permettant la modification des informations de connexion sur la page mon compte.
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
                    
                    $passcheck = password_verify($_POST['actualpass'], $donnees['password']); // compare le mot de passe actuel avec celui en base

                if ($passcheck) // si la comparaison est ok
                {
                    if (($donnees == false) || ($donnees['username'] === $_SESSION['username'])) // si le "username" n'a pas été trouvé, il est donc libre || ou si le username entré et le même que celui en session
                    {
                        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
                        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT); // crée une clé de hachage pour le mot de passe
                        $reponse = $bdd->prepare('UPDATE user SET username = :username, password = :password WHERE id = :id_user'); // met à jour la table user avec le mot de passe et le username
                        $reponse->execute(array(
                            'username' => $_POST['username'],
                            'password' => $pass_hache,
                            'id_user' => $_SESSION['id_user']
                        ));
                        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
                        $reponse = $bdd->prepare('SELECT * FROM user WHERE id = :id_user'); // récupére les nouvelles données de la table user suite au précédent update
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
// fonction permettant la modification de la question secrète (et sa réponse) sur la page mon compte.
//
//

function modify_question_secrete()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.

    if (isset ($_POST['question']) && ($_POST['reponse'])) // vérifie si les variables sont déclarées et sont différentes de null.
    {
        $reponse = $bdd->prepare('UPDATE user SET question = :question, reponse = lower(:reponse) WHERE id = :id_user'); // met à jour la table user avec les nouvelles "question" et "réponse"
        $reponse->execute(array(
            'question' => $_POST['question'],
            'reponse' => $_POST['reponse'],
            'id_user' => $_SESSION['id_user']
        ));
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées 
        $reponse = $bdd->prepare('SELECT * FROM user WHERE id = :id_user'); // récupére les nouvelles données de la table user suite au précédent update
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
    $reponse = $bdd->prepare('SELECT url_img_avatar FROM user WHERE id = :id_user'); // récupére url de l'avatar selon l'id_user en session
    $reponse->execute(array(
        'id_user' => $_SESSION['id_user']
    ));
    $donnees = $reponse->fetch();

    if ($donnees['url_img_avatar'] == false) // si l'url de l'avatar en bdd n'est pas présente (ce qui veut dire que l'utilisateur n'a pas encore mis une image personnalisée)
    {
        $avatar_img = '../img/icon_user.png'; // alors mettre l'image par défaut
    }
    else
    {
        $avatar_img = '../img/avatar/'.$donnees['url_img_avatar']; // va chercher l'url de l'image déjà uploadé par l'utilisateur afin d'être affichée
    }
    $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées

   return $avatar_img; // retourne la valeur $avatar_img qui aura comme variable soit l'url de l'image par défaut soit l'url de l'image uploadé par l'utilisateur
}


//
//
// fonction permettant l'ajout ou la modification de l'avatar sur la page mon compte
//
//

function add_modify_img_avatar()
{
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) // contrôle que le fichier a bien été envoyé et qu'il n'y a pas d'erreur
    {
        if ($_FILES['avatar']['size'] <= 1000000) // contôle que le fichier fait moins de 1mo
        {
            $infosfichier = pathinfo($_FILES['avatar']['name']); // récupère le nom du fichier
            $extension_upload = $infosfichier['extension']; // récupère l'extension de l'image uploadée
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG');  // liste des extensions autorisées pour l'upload de l'image
            if (in_array($extension_upload, $extensions_autorisees)) // si l'extension du fichier fait partie des extensions autorisées.
            {
             $url_img_avatar = 'avatar_user_'.$_SESSION['id_user'].'.'.$extension_upload; // réécrit le nouveau nom de l'image du type : avatar_user_14.jpg                            
             move_uploaded_file($_FILES['avatar']['tmp_name'], 'img/avatar/' . basename($url_img_avatar));  // déplace le fichier vers le dossier img/avatar pour le stocker définitivement
             
             $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.

             $reponse = $bdd->prepare('UPDATE user SET url_img_avatar = :url_img_avatar WHERE id = :id_user'); // met à jour la table user avec l'url de l'image uploadée par l'utilisateur
             $reponse->execute(array(
                 'url_img_avatar' => $url_img_avatar,
                 'id_user' => $_SESSION['id_user']
             ));
             $_SESSION['url_img_avatar'] = $url_img_avatar; // mise en session de la nouvelle url de l'avatar
             ?>
             <br>
             <br>
             <div class="msg_success"><!-- message pour informer l'utilisateur que l'image a bien été uploadé-->
             <p>Votre image a été envoyé avec succès!</p>
             </div>
             <?php // script JS pour recharger la page courante afin d'afficher la nouvelle image

                echo '<script language="Javascript">
                <!--
                  document.location.replace("moncompte.php");
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


//
//
// fonction permettant de réduire la longueur d'un texte
//
//

function texte_short($texte, $nb){
    $txt_short=strip_tags($texte);
    if ( strlen($texte) <= $nb )
        return $txt_short;
    if ( ($pos_espace = strpos($txt_short,' ',$nb)) === FALSE ) 
        return $txt_short;
    $txt_short = substr($txt_short,0,$pos_espace);  
    return $txt_short;
}

//
//
// fonction permettant d'afficher la liste des article partenaire avec une pagoiation en bas de page
//
//

function select_actors_article()
{
    if(isset($_GET['page']) && !empty($_GET['page'])) // contrôle que les données envoyées via l'URL pour la pagination sont bien présentent
        {
            $current_page = $_GET['page']; // si oui, alors la page courante est celle défini dans l'URL
        }
    else
        {
            $current_page = 1; // sinon, la page courante est la première
        }
        $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
        $reponse = $bdd->query('SELECT COUNT(*) AS nb_fiches FROM actors'); // requête sql qui renvoie le nombre (de ligne) de fiches acteurs
        $donnees = $reponse->fetch();
        $nb_fiches_page = 5; // définit le le nombre de fiches à afficher par page
        $premiere_fiche_desc_limit = ($current_page * $nb_fiches_page) - $nb_fiches_page; // donne la premiere fiche de la page courante  - permet de renseigner le premier chiffre de la DESC LIMIT
        $nb_page_fiches = ceil($donnees['nb_fiches']/$nb_fiches_page); // calcule le nombre de page par fiche en divisant le nombre de fiche totale par le nombre de fiche par page     
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
    
    $reponse = $bdd->query('SELECT id, titre, texte, url_post, url_img_actors FROM actors ORDER BY id DESC LIMIT ' .$premiere_fiche_desc_limit.','.$nb_fiches_page); // va chercher toutes les données nécessaires à l'affichage des blocs résumé de fiches acteurs selon la page séletionnée dans  la pagination

    while ($donnees=$reponse->fetch()) // boucle d'affichage des blocs résumé de fiche acteur -  s'arrête une fois qu'il n'y a plus de données
    {
        ?>
        <div class="home_bloc_actors_container">
            <div class="home_logo_bloc_actors">
                    <img src="<?php echo $donnees['url_img_actors']?>" alt="logo <?php echo $donnees['titre']?>"> <!-- affiche image logo fiche acteur-->
            </div>
            <div class="home_text_bloc_actors">
                <h3>
                <?php echo $donnees['titre'] // affiche le titre de la fiche acteur
                ?>
                </h3>
                <p>
                <?php echo texte_short($donnees['texte'], 130); // affiche une portion du texte de la fiche acteur limitée à 130 carcatères via la fonction texte_short()
                ?> ...
                </p>
            </div>
            <div class="home_read_more_bloc_actors">
                <a href="actors.php?url_post=<?php echo $donnees['url_post']?>" target="_blank" rel="noopener noreferrer"><div class="home_read_more_bloc_actors_button">Lire la suite</div></a>   <!-- affiche un bouton qui amène vers la fiche acteur correspondante-->
            </div>
        </div>
    <?php  
    }
    ?>
    <div class="pagination"> 
    <?php 
        for ($page_fiches = 1; $page_fiches <= $nb_page_fiches; $page_fiches++) // boucle qui gènere les pages composants la pagination (1 page toutes les 5 fiches acteurs)
        {
            echo '<a href="index.php?page='.$page_fiches.'#pagination_go">page ' .$page_fiches .'</a> | '; // url des pages composants la pagination (1 page toutes les 5 fiches acteurs)
        }
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
    ?>
    </div>
    <?php
}

//
//
// fonction permettant d'afficher une fiche acteur
//
//

function view_actors_article()
{
    if (isset($_GET['url_post'])) // vérifie si les variables sont déclarées
    {
        $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
        $reponse = $bdd->prepare('SELECT id, titre, url_website, texte, url_post, url_img_actors, meta_description, meta_keywords, user_id_post, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') FROM actors WHERE url_post = :url_post'); // va chercher dans la table actors les données à afficher 
        $reponse->execute(array(
            'url_post' => $_GET['url_post']));
        $donnees_actors = $reponse->fetch();
        
        if ($_GET['url_post'] !== $donnees_actors['url_post']) // compare l'url envoyé par le navigateur à celle en base
        {
            header('Location: /index.php'); // si pas identique, retour à l'accueil
        }
        else // si identique laisse passer le flux et affiche les données de la fiche acteur
        {
            return $donnees_actors; // retourne les données de la fiche acteur
            $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
        }
    }
    else
    {
        header('Location: /index.php'); // si pas déclarées, retour à l'accueil
    }
}


//
//
// fonction permettant d'afficher le nombre de commentaire par fiche
//
//

function nbr_comment()
{
    $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
    $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellemnt en cours de visualisation
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT COUNT(*) AS nb_comment FROM comment WHERE actors_id = :actors_id'); // récupère le nombre (de ligne) de commentaires pour la fiche en cours de visualisation 
    $reponse->execute(array(
        'actors_id' => $actors_id
    ));
    $nb_comment = $reponse->fetch();
    if ($nb_comment === false) // si il n'y a pas de commentaire
    {
        $nb_comment=0; // alors la variable nb_comment vaut 0
    }
    return $nb_comment; // retourne le nombre de commmentaire de la fiche en cours de visualisation
    $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
}

//
//
// fonction permettant le contôle du nombre de commentaire par user et par fiche 
//
//

function nbr_comment_user()
{
    $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
    $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellemnt en cours de visualisation
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT COUNT(*) AS nb_comment_user FROM comment WHERE actors_id = :actors_id AND user_id_comment = :user_id_comment '); // récupère le nombre (de ligne) de commentaires par utilisateur pour la fiche en cours de visualisation 
    $reponse->execute(array(
        'actors_id' => $actors_id,
        'user_id_comment' => $_SESSION['id_user']
    ));
    $nb_comment_user = $reponse->fetch();
    if ($nb_comment_user === false) // si il n'y a pas de commentaire posté par l'utilisateur (actuellement loggué) sur la fiche en cours de visualisation
    {
        $nb_comment_user=0; // alrs la variable vaut 0
    }
    return $nb_comment_user; // retourne le nombre de commentaire posté par l'utilisateur (actuellement loggué) sur la fiche en cours de visualisation
    $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
}


//
//
// fonction permettant de soumettre un nouveau commentaire
//
//

function submit_comment()
{
    $nb_comment_user = nbr_comment_user(); // récupère le données issues de la fonction permettant le contôle du nombre de commentaire par user et par fiche 
    if (isset($_POST['commentaire'])) // vérifie si les variables sont déclarées
    {
        if ($nb_comment_user['nb_comment_user'] >= 1) // contrôle que l'utilisateur (actuellement loggué) a posté un ou plusieurs commentaire sur la fiche en cours de visualisation, si oui message d'erreur ci dessous
        {  
            ?> 
            <br>
            <br>
            <div class="msg_error"> <!-- message pour informer qu'il est impossible d'écrire plus d'un commentaite par fiche acteur-->
            <p>Impossible de commenter plus d'une fois la même fiche acteur</p>        
            </div>
            <br>
            <?php   
        }
        else
        {
            $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
            $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellement en cours de visualisation
            $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
            $reponse = $bdd->prepare('INSERT INTO comment(commentaire, date_commentaire, user_id_comment, actors_id) VALUES(:commentaire, NOW(), :user_id_comment, :actors_id)'); // insére le nouveau commentaire en BDD
            $reponse->execute(array(
                'commentaire' => $_POST['commentaire'],
                'user_id_comment' => $_SESSION['id_user'],
                'actors_id' => $actors_id
            ));
            $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
                // script JS pour recharger la page courante afin de voir la modification du compteur de like

                echo '<script language="Javascript">
                <!--
                  document.location.replace("actors.php?url_post='.$_GET['url_post'].'");
                // -->
                </script>';
        }
    }
}

//
//
// fonction permettant d'afficher les commentaires sur une fiche acteur ainsi que la pagination
//
//

function view_comments_actors()
{
    if(isset($_GET['page']) && !empty($_GET['page'])) // contrôle que les données envoyées via l'URL pour la pagination sont bien présentent
    {
        $current_page = $_GET['page']; // si oui, alors la page courante est celle défini dans l'URL
    }
    else
    {
        $current_page = 1; // sinon, la page courante est la première
    }
    $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
    $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellement en cours de visualisation
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT COUNT(*) AS nb_comments FROM comment WHERE actors_id = :actors_id'); // récupère le nombre (de ligne) de commentaires pour la fiche en cours de visualisation 
    $reponse->execute(array(
        'actors_id' => $actors_id
    ));
    $donnees = $reponse->fetch();
    $nb_comments_page = 5; // limite à 5 le nombre de commenaires par page
    $premier_comment_desc_limit = ($current_page * $nb_comments_page) - $nb_comments_page; // donne la position de la premiere fiche de la page courante  - permet de renseigner le premier chiffre de la DESC LIMIT
    $nb_page_comments = ceil($donnees['nb_comments']/$nb_comments_page); // calcule le nombre de page par fiche en divisant le nombre de fiche totale par le nombre de fiche par page     
    $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées

    $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
    $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellement en cours de visualisation

    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    // requète permettant de récupèrer des informations de la table comment et de la table user pour l'affichage des commentaires
    $reponse = $bdd->prepare('SELECT u.prenom, u.url_img_avatar , c.commentaire, DATE_FORMAT(c.date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire FROM comment c INNER JOIN user u ON c.user_id_comment=u.id WHERE actors_id = :actors_id ORDER BY c.id DESC LIMIT ' .$premier_comment_desc_limit.','.$nb_comments_page);
    $reponse->execute(array(
        'actors_id' => $actors_id
    ));
    while($donnees_commentaire = $reponse->fetch()) // boucle affichant les commentaires
    {
        ?>
        <div class="bloc_comment">
            <div class="bloc_comment_img">
                <img class="bloc_comment_img" src="/img/avatar/<?php echo $donnees_commentaire['url_img_avatar'] ?>" alt="Avatar utilisateur"> <!--  affiche l'image renvoyée par la fonction --->
            </div>
            <div class="bloc_comment_text" >
                <p><strong>Prénom : </strong><?php echo $donnees_commentaire['prenom']?></p>
                <p><strong>Date : </strong> <?php echo $donnees_commentaire['date_commentaire']?></p>
                <p><strong>Commentaire : </strong> <?php echo $donnees_commentaire['commentaire']?></p>
            </div>
        </div>
        <?php
    }
    $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées

    ?>
    <div class="pagination">
    <?php 
        for ($page_comments = 1; $page_comments <= $nb_page_comments; $page_comments++) // boucle qui gènere les pages composants la pagination (1 page toutes les 5 commentaires)
        {
            echo '<a href="actors.php?url_post='.$_GET['url_post'].'&page='.$page_comments.'#pagination_go">page ' .$page_comments .'</a> | '; // url des pages composants la pagination (1 page toutes les 5 commentaires)
        }
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
    ?>
    </div>
    <br>
    <br>
    <?php
}


//
//
// fonction permettant d'afficher le nombre de unlike
//
//

function view_unlike()
{
    $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
    $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellement en cours de visualisation
    
    $down=1; // attribue la valeur 1 à la variable
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT COUNT(*) AS nb_unlikes FROM like_unlike WHERE down = :down AND actors_id = :actors_id'); // requête qui permet de récupèrer le nombre de dislike (down vaut 1) pour la fiche
    $reponse->execute(array(
        'actors_id' => $actors_id,
        'down' => $down
    ));
    $nb_unlike = $reponse->fetch();
    $reponse->closeCursor();
    return $nb_unlike; // retourne le nombre de pouce baissé
}

//
//
// fonction permettant d'afficher le nombre de like
//
//

function view_like()
{
    $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
    $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellement en cours de visualisation

    $up=1; // attribue la valeur 1 à la variable
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT COUNT(*) AS nb_likes FROM like_unlike WHERE up = :up AND actors_id = :actors_id'); // requête qui permet de récupèrer le nombre de dislike (up vaut 1) pour la fiche 
    $reponse->execute(array(
        'actors_id' => $actors_id,
        'up' => $up
    ));
    $nb_like = $reponse->fetch();
    $reponse->closeCursor();
    return $nb_like; // retourne le nombre de pouce lévé
}




function control_like_unlike_user()
{
    $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
    $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellement en cours de visualisation

    $up=1; // attribue la valeur 1 à la variable
    $down=1; // attribue la valeur 1 à la variable
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT COUNT(*) AS nb_likes_user FROM like_unlike WHERE (up = :up OR down = :down) AND actors_id = :actors_id AND user_id_like = :user_id_like'); // requête qui permet de récupèrer le nombre de fois où l'utilisateur a liké pou disliké pour une même fiche 
    $reponse->execute(array(
        'actors_id' => $actors_id,
        'up' => $up,
        'down' => $down,
        'user_id_like' => $_SESSION['id_user']

    ));
    $nb_like_unlike_user = $reponse->fetch();
    $reponse->closeCursor();
    return $nb_like_unlike_user; // retourne le nombre de pouce lévé
}


//
//
// fonction permettant d'ajouter un like ou un unlike
//
//

function push_like()
{
    if (isset($_GET['up']))  // contrôle que les données envoyées via l'URL pour le like sont là
    {
        if (isset($_GET['down'])) // contrôle que les données envoyées via l'URL pour le dislike sont là
        {
            $nb_like_unlike_user=control_like_unlike_user();

            if ($nb_like_unlike_user['nb_likes_user'] >= 1) // si il y a 1 like ou 1 unlike dèja posté par un même utilisateur
            {  
                ?> 
                <br>
                <br>
                <div class="msg_error"> <!-- message pour informer qu'il est impossible de liker plus d'une fois pour un même utilisateur-->
                <p>impossible de liker plus d'une fois</p>        
                </div>
                <br>
                <?php   
            }
            else
            {
                $donnees_actors=view_actors_article(); // récupére les données issue de la fonction view_actors_article() permettant d'afficher une fiche acteur
                $actors_id=$donnees_actors['id']; // sélectionne spécifiquement l'id de la fiche qui est actuellement en cours de visualisation
                $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
                $reponse = $bdd->prepare('INSERT INTO like_unlike(up, down, actors_id, user_id_like) VALUES(:up, :down, :actors_id, :user_id_like)'); // insére tous les données relatives aux likes en base
                $reponse->execute(array(
                    'up' => $_GET['up'],
                    'down' => $_GET['down'],
                    'actors_id' => $actors_id,
                    'user_id_like' => $_SESSION['id_user']
                ));
                $reponse->closeCursor();

                // script JS pour recharger la page courante afin de voir la modification du compteur de like

                echo '<script language="Javascript">
                <!--
                  document.location.replace("actors.php?url_post='.$_GET['url_post'].'");
                // -->
                </script>';
            }
        }
    }
}