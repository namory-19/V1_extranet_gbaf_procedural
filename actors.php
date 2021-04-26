<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
require_once('core/functions.php');  // appelle le fichier permettant l'accès aux fonctions.
$donnees_actors=view_actors_article(); // charge la fonction permettant d'afficher une fiche acteur
$nb_comment=nbr_comment(); // charge la fonction permettant d'afficher le nombre de commentaire par fiche
$nb_unlike=view_unlike(); // charge la fonction fonction permettant d'afficher le nombre de unlike
$nb_like=view_like(); // charge la fonction fonction permettant d'afficher le nombre de like
if ((!isset($_SESSION['id_user'])) || ($_SESSION['active'] ==='0')) // On contrôle si la session est démarrée en vérifiant qu'elle contient l'id_user (récupéré à la connexion) et que ce dernier n'a pas été désactivé par un administrateur.
{
    kill_session(); // Sinon on fait appel la fonction kill_session pour vider par sécurité la totalité des données de session puis retour à la page de connexion
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $donnees_actors['titre'] ?></title>
</head>
<body>
    <?php include("header.php"); ?>    <!--  Charge le header -->
    <section class="page_actors">
    <div class="logo_page_actors">
            <img src="<?php echo $donnees_actors['url_img_actors'] ?>" alt="<?php echo $donnees_actors['titre']?>">  <!--  affiche le logo de l'acteur  --->
        </div>
        <div class="text_page_actors">
            <h2>
            <?php echo $donnees_actors['titre']?>  <!--  affiche le titre de la fiche l'acteur  --->
            </h2>
            <div class ="url_website"><p>
            <strong>Site web :</strong> <?php echo $donnees_actors['url_website'] ? '<a href="'.$donnees_actors['url_website'].'" target="_blank" rel="noopener noreferrer">' : '' ?><?php echo $donnees_actors['url_website'] ? $donnees_actors['url_website']: 'Aucun site web' ?></a> <!--  affiche l'URL di site web si il y en a , sinon affiche la mention 'aucun site'  --->
            </div></p>
            <div class="texte_actors"><p>
            <?php echo $donnees_actors['texte']?></p> <!--  affiche le texte de la fiche l'acteur  --->
            </div>
        </div>
    </section>
    <section class="commentaire">
        <div class="commentaire_container">
            <div class="bloc_header_comment">
                <div class="nb_comment">
                    <h2 id="pagination_go">
                    <?php echo $nb_comment['nb_comment']?> commentaire(s) <!--  affiche le nombre de commentaire sur la fiche  --->
                    </h2>
                </div>
                <div class="new_comment">
                <a href="#submit_comment"><div class="comment_button">Nouveau commentaire</div></a>   <!--  bouton renvoyant vers la zone de texte du commentaire  --->
                </div>
                <div class="counterlike_button">
                    <div class="like">
                    <p><?php echo $nb_like['nb_likes']?></p><!--  affiche le nombre de like de la fiche l'acteur  --->
                    <a href="actors.php?url_post=<?php echo $_GET['url_post']?>&amp;up=1&amp;down=0"><img src="img/up.png" alt="logo like"></a>
                    </div>
                    <div class="unlike">
                    <p><?php echo $nb_unlike['nb_unlikes']?></p><!--  affiche le nombre de unlike de la fiche l'acteur  --->
                    <a href="actors.php?url_post=<?php echo $_GET['url_post']?>&amp;up=0&amp;down=1"><img src="img/down.png" alt="logo unlike"></a>
                    </div>
                    <?php push_like();?> <!-- fonction permettant d'ajouter un like ou un unlike  --->
                </div>
            </div>
            <?php view_comments_actors()?> <!-- fonction permettant d'afficher les commentaires sur une fiche acteur ainsi que la pagination  --->
            <div class="bloc_submit_comment">
                <form action="actors.php?url_post=<?php echo $_GET['url_post']?>" method="POST">
                <div>
                <label for="commentaire"><strong>Votre commentaire : </strong></label>
                <br>
                <textarea class="text_area" name="commentaire" id="commentaire" rows="10" cols="50" required></textarea>       
                <br>
                </div>
                <div id="submit_comment">
                <a href="#submit_comment"><input type="submit" value="Envoyer" class="button_submit"></a>
                </div>
                <br>
                <?php submit_comment()?> <!-- fonction permettant de soumettre un nouveau commentaire  --->
                </form>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>  <!--  Charge le footer --->
</body>
</html>