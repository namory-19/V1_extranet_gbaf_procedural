<?php
require_once(dirname(__FILE__) . '/database.php');  // appelle le fichier permettant la connexion à la BDD.

//
//
// fonction permettant de récupérer l'id group pour l'affichage des éléments admin
//
//

function verif_group_admin()
{
    if (isset($_SESSION['usergroup'])) // On contrôle si la session est démarré en vérifiant qu'elle contient l'usergroup (récupéré à la connexion)
    {
        if ($_SESSION['usergroup'] !== '2')
        {
            header('Location: /index.php'); // sinon retour à la page de connexion
        }
    }
    else
    {
        header('Location: /connexion.php'); // sinon retour à la page de connexion
    }
}

//
//
// remplace plusieurs espaces à la suite par un seul - et remplacera aussi les ' par des -.
//
//

function valideChaine($chaineNonValide)
{
  $chaineNonValide = preg_replace('`\s+`', '-', trim($chaineNonValide));
  $chaineNonValide = str_replace("'", "-", $chaineNonValide);
  $chaineNonValide = str_replace(",", "-", $chaineNonValide);
  $chaineNonValide = str_replace("&", "-", $chaineNonValide);
  $chaineNonValide = preg_replace("`_+`", '-', trim($chaineNonValide));
  $chaineValide=strtr($chaineNonValide,
"ÀÁÂàÄÅàáâàäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏ" .
"ìíîïÙÚÛÜùúûüÿÑñ",
"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
  return ($chaineValide);
}



//
//
// fonction permettant la création des fiches actors
//
//

function create_actors_article()
{
    if (isset ($_POST['titre']) && ($_POST['texte']))
    {
        $url_img_actors = '/img/no_image.png'; // si l'utilisateur n'ajoute pas d'image

        $urlpostdirty=$_POST['titre'];
        $urlpostclean = valideChaine( $urlpostdirty );
        $url_post = $urlpostclean.'.html';
        
        $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
        $reponse = $bdd->prepare('INSERT INTO actors(titre, url_website, texte, url_post, url_img_actors, meta_description, meta_keywords, user_id_post, date_post) VALUES(:titre, :url_website, :texte, :url_post, :url_img_actors, :meta_description, :meta_keywords, :user_id_post, NOW())'); // insére tous les informations du formulaire en base dans la table "actors"
        $reponse->execute(array(
            'titre' => $_POST['titre'],
            'url_website' => $_POST['url_website'],
            'texte' => $_POST['texte'],
            'url_post' => $url_post,
            'url_img_actors' => $url_img_actors,
            'meta_description' => $_POST['meta_description'],
            'meta_keywords' => $_POST['meta_keywords'],
            'user_id_post' => $_SESSION['id_user']
        ));

        ?>
        <br>
        <br>
        <div class="msg_success">  <!-- message pour informer l'utilisateur que son compte a été créé-->
        <p>Votre fiche acteur a été créée avec succès! Vous pouvez re-créer une nouvelle fiche ou <a href="/admin/admin_actors.php" target="_blank" rel="noopener noreferrer">cliquez ici</a> pour vous revenir à l'espace "acteurs".</p>
        </div>
        <?php

        if (isset($_FILES['img_actors']) && $_FILES['img_actors']['error'] == 0) // si le fichier a bien été envoyé et s'il n'y a pas d'erreur
        { 
            if ($_FILES['img_actors']['size'] <= 1000000) // le fichier doit faire moins de 1mo
            {
                $infosfichier = pathinfo($_FILES['img_actors']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG');
                if (in_array($extension_upload, $extensions_autorisees)) // si l'extension est autorisée
                {
                $titledirty=$_POST['titre'];
                $titleclean= valideChaine( $titledirty );
                $url_img_actors = '/img/actors/'.$titleclean.'.'.$extension_upload;                                   
                move_uploaded_file($_FILES['img_actors']['tmp_name'], (dirname(__FILE__) .'/../img/actors/') . basename($url_img_actors));  // On peut valider le fichier et le stocker définitivement
                
                $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
                // $reponse = $bdd->prepare('UPDATE actors SET url_img_actors = :url_img_actors WHERE id = (SELECT MAX(id))');
                $reponse = $bdd->prepare('UPDATE actors SET url_img_actors = :url_img_actors ORDER BY id DESC LIMIT 1');
                $reponse->execute(array(
                    'url_img_actors' => $url_img_actors
                     ));
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
                <p>L'image envoyée est trop lourde, merci de renvoyer une image inférieure à 1mo.</p>
                </div>
                <br>
                <?php      
            }
        }   
    }
}