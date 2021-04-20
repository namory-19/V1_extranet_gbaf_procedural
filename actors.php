<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
require_once('core/functions.php');  // appelle le fichier permettant l'accès aux fonctions dont la connexion à la BDD.
$donnees_actors=view_actors_article();
$nb_comment=nbr_comment();
$nb_unlike=view_unlike();
$nb_like=view_like();
if ((!isset($_SESSION['id_user'])) || ($_SESSION['active'] ==='0')) // On contrôle si la session est démarré en vérifiant qu'elle contient l'id_user (récupéré à la connexion)
{
    kill_session();
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
    <?php include("header.php"); ?>
    <section class="page_actors">
    <div class="logo_page_actors">
            <img src="<?php echo $donnees_actors['url_img_actors'] ?>" alt="<?php echo $donnees_actors['titre']?>">
        </div>
        <div class="text_page_actors">
            <h2>
            <?php echo $donnees_actors['titre']?>
            </h2>
            <div class ="url_website"><p>
            <strong>Site web :</strong> <?php echo $donnees_actors['url_website'] ? '<a href="'.$donnees_actors['url_website'].'" target="_blank" rel="noopener noreferrer">' : '' ?><?php echo $donnees_actors['url_website'] ? $donnees_actors['url_website']: 'Aucun site web' ?></a>
            </div></p>
            <div class="texte_actors"><p>
            <?php echo $donnees_actors['texte']?></p>
            </div>
        </div>
    </section>
    <section class="commentaire">
        <div class="commentaire_container">
            <div class="bloc_header_comment">
                <div class="nb_comment">
                    <h2 id="pagination_go">
                    <?php echo $nb_comment['nb_comment']?> commentaire(s)
                    </h2>
                </div>
                <div class="new_comment">
                <a href="#submit_comment"><div class="comment_button">Nouveau commentaire</div></a>   
                </div>
                <div class="counterlike_button">
                    <div class="like">
                    <p><?php echo $nb_like['nb_likes'] ?></p> 
                    <a href="actors.php?url_post=<?php echo $_GET['url_post']?>&amp;up=1&amp;down=0"><img src="img/up.png" alt="logo like">
                    </div>
                    <div class="unlike">
                    <p><?php echo $nb_unlike['nb_unlikes'] ?></p>
                    <a href="actors.php?url_post=<?php echo $_GET['url_post']?>&amp;up=0&amp;down=1"><img src="img/down.png" alt="logo unlike"></a>
                    </div>
                    <?php push_like();?>
                </div>
            </div>
            <?php view_comments_actors()?>
            <div class="bloc_submit_comment">
                <form action="actors.php?url_post=<?php echo $_GET['url_post']?>" method="POST">
                <div>
                <label for="commentaire"><strong>Votre commentaire : </strong></label>
                <br>
                <textarea name="commentaire" id="commentaire" rows="10" cols="50" required></textarea>       
                <br>
                </div>
                <div id="submit_comment">
                <a href="#submit_comment"><input type="submit" value="Envoyer" class="button_submit"></a>
                </div>
                <br>
                <?php submit_comment()?>
                </form>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>