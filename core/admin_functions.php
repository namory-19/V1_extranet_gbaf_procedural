<?php
require_once(dirname(__FILE__) . '/database.php');  // appelle le fichier permettant la connexion à la BDD.

//
//
// fonction permettant de récupérer l'id group pour l'affichage des éléments admin et d'autoriser ou non l'affichage
//
//

function verif_group_admin()
{
    if (isset($_SESSION['usergroup'])) // On contrôle si la session est démarré en vérifiant qu'elle contient l'usergroup (récupéré à la connexion)
    {
        if ($_SESSION['usergroup'] !== '2') // si l'utilisateur n'est pas un administrateur
        {
            header('Location: /index.php'); // retour à la page d'accueil coté front office
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
    if (isset ($_POST['titre']) && ($_POST['texte'])) // vérifie si les variables sont déclarées et sont différentes de null.
    {
        $url_img_actors = '/img/no_image.png'; // si l'utilisateur n'ajoute pas d'image

        $urlpostdirty=$_POST['titre']; // récupère le titre brut (pour s'en servir come URL et le passe dans une variable urlpostdirty
        $urlpostclean = valideChaine( $urlpostdirty ); // passe le titre brut (urlpostdirty) dans la fonction valideChaine ( qui nettoie le titre afin qu'il puisse correspondre à un format d'URL ) puis récupère le tout sous forme de variable urlpostclean
        $url_post = $urlpostclean.'.html'; // Créé la variable url_post en utilsant la variable urlpostclean (url nettoyée ) avec l'extension .html
        
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
        <p>Votre fiche acteur a été créée avec succès! Vous pouvez re-créer une nouvelle fiche ou <a href="/admin/index.php" target="_blank" rel="noopener noreferrer">cliquez ici</a> pour vous revenir à l'espace "acteurs".</p>
        </div>
        <?php

        if (isset($_FILES['img_actors']) && $_FILES['img_actors']['error'] == 0) // si le fichier a bien été envoyé et s'il n'y a pas d'erreur
        { 
            if ($_FILES['img_actors']['size'] <= 1000000) // le fichier doit faire moins de 1mo
            {
                $infosfichier = pathinfo($_FILES['img_actors']['name']); // récupère le nom du fichier uploadé
                $extension_upload = $infosfichier['extension']; // récupère l'extenion du fichier uploadé
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG'); // création d'un tableau avec les extensions autorisées
                if (in_array($extension_upload, $extensions_autorisees)) // si l'extension du fichier uploadé se rtrouve dans le tableau avec les extensions autorisées
                {
                $titledirty=$_POST['titre']; // récupère le titre brut (pour s'en servir comme nom de fichier image et le passe dans une variable titledirty
                $titleclean= valideChaine( $titledirty ); // passe le titre brut (titledirty) dans la fonction valideChaine ( qui nettoie le titre afin qu'il puisse correspondre à un format acceptable de titre de fichier ) puis récupère le tout sous forme de variable titleclean
                $url_img_actors = '/img/actors/'.$titleclean.'.'.$extension_upload; //créé la variable url_img_actors (qui donne le chemin du chier image)                            
                move_uploaded_file($_FILES['img_actors']['tmp_name'], (dirname(__FILE__) .'/../img/actors/') . basename($url_img_actors));  // On peut valider le fichier et le stocker définitivement
                
                $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
                // $reponse = $bdd->prepare('UPDATE actors SET url_img_actors = :url_img_actors WHERE id = (SELECT MAX(id))');
                $reponse = $bdd->prepare('UPDATE actors SET url_img_actors = :url_img_actors ORDER BY id DESC LIMIT 1'); // récupère la dernière entrée dans la table et met à jour le chemin vers l'image
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

//
//
// fonction permettant de récupérer les articles partenaire
//
//

function actors_article()
{
    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
    $reponse = $bdd->prepare('SELECT id, titre, url_website, texte, url_post, url_img_actors, meta_description, meta_keywords FROM actors WHERE url_post=:url_post'); // requête pour récupérer les données de la fiche acteur courante
    $reponse->execute(array(
        'url_post' => $_GET['url_post']
    ));
    $donnees=$reponse->fetch();
    $actors_article=$donnees;
    return $actors_article; // retourne un tableau avec les données de la fiche acteur courante
}



//
//
// fonction permettant d'afficher la totalité de la liste des article partenaire avec une pagination en bas de page ainsi que des liens pour supprimer ou modfier les fiches.
//
//

function select_actors_article_admin()
{
    if(isset($_GET['page']) && !empty($_GET['page'])) // si un numéro de page est passé dans l'URL
        {
            $current_page = $_GET['page']; // alors la page courrnat correspond à ce numéro
        }
        else
        {
            $current_page = 1; // sinon la page courante est la première (1)
        }
        $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
        $reponse = $bdd->query('SELECT COUNT(*) AS nb_fiches FROM actors'); // requête qui compte le nombre de fiche acteur
        $donnees = $reponse->fetch();
        $nb_fiches_page = 5; // création d'une variable qui défini le nombre de fiche par page à 5
        $premiere_fiche_desc_limit = ($current_page * $nb_fiches_page) - $nb_fiches_page; // donne le numéro de premiere fiche de la page courante - permet de renseigner le premier chiffre de la DESC LIMIT
        $nb_page_fiches = ceil($donnees['nb_fiches']/$nb_fiches_page); // calcule le nombre de page par fiche en divisant le nombre de fiche totale par le nombre de fiche par page     
        $reponse->closeCursor(); // libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées
    
    $reponse = $bdd->query('SELECT id, titre, texte, url_post, url_img_actors FROM actors ORDER BY id DESC LIMIT ' .$premiere_fiche_desc_limit.','.$nb_fiches_page); // requête qui récupère les données des fiches acteurs selon la page de la pagination surlaquelle on est.

    while ($donnees=$reponse->fetch())// boucle d'affichage des blocs résumé de fiche acteur (limité à 5 fiches par page)
    {
        ?>
        <div class="bloc_actors_container_admin">
            <div class="home_logo_bloc_actors">
                    <img src="<?php echo $donnees['url_img_actors']?>" alt="logo <?php echo $donnees['titre']?>"> <!--  affiche l'image de la fiche acteur et remplis la balise alt avec le titre de la fiche' -->
            </div>
            <div class="home_text_bloc_actors">
                <h3>
                <?php echo $donnees['titre'] // affiche le titre de la fiche 
                ?>
                </h3>
                <p>
                <?php echo texte_short($donnees['texte'], 130); // affiche une partie du texte de la fiche limitée aux 130 premiers caractères
                ?> ...
                </p>
            </div>
            <div class="home_read_more_bloc_actors">
                <a href="/actors.php?url_post=<?php echo $donnees['url_post']?>" target="_blank" rel="noopener noreferrer"><div class="home_read_more_bloc_actors_button">Lire la suite</div></a>   <!--  lien qui amène vers la fiche acteur correspondante -->
            </div>
         </div>
         <div class="bloc_modify_delete_admin">  <!--  affiche un bloc qui permet d'accèder à une page permettant de modifier la fiche ou alors de la suppriler au clic -->
        <a href="/admin/admin_actors_modify.php?url_post=<?php echo $donnees['url_post'] ?>" target="_blank" rel="noopener noreferrer">Modifier</a> | <a href="/admin/index.php?url_post=<?php echo $donnees['url_post']?>&delete" target="_blank" rel="noopener noreferrer">Supprimer</a>
        <?php delete_actors_article();?> <!--   appelle la fonction permettant de supprimer des fiches acteurs  -->
        </div>
    <?php 
    }
    ?>
    <div class="pagination">
    <?php 
        for ($page_fiches = 1; $page_fiches <= $nb_page_fiches; $page_fiches++)
        {
            echo '<a href="index.php?page='.$page_fiches.'#pagination_go">page ' .$page_fiches .'</a> | ';
        }
        $reponse->closeCursor();
    ?>
    </div>
    <?php
}

//
//
// fonction permettant de supprimer des fiches actors
//
//

function delete_actors_article()
{
    if (isset($_GET['url_post']) && isset($_GET['delete'])) // vérifie la présnece de l'url de la fiche et du mot delete
        {
            $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
            $reponse = $bdd->prepare('DELETE FROM actors WHERE url_post = :url_post'); // requête qui permet de supprimer la ligne de la fiche acteur correspondante à la fiche courante
            $reponse->execute(array(
                'url_post' => $_GET['url_post']
            ));
            echo '<script language="Javascript">  
            <!--
                  document.location.replace("/admin/index.php");
            // -->
      </script>';     
        }
}


//
//
// fonction permettant la modifications des fiches actors
//
//

function modify_actors_article()
{
    if (isset ($_POST['titre']) && ($_POST['texte'])) // contrôle la présence des données dans les champs titre et texte de la fiche
    {
        if (isset($_FILES['img_actors']) && $_FILES['img_actors']['error'] == 0) // si le fichier a bien été envoyé et s'il n'y a pas d'erreur
        { 
            if ($_FILES['img_actors']['size'] <= 1000000) // le fichier doit faire moins de 1mo
            {
                $infosfichier = pathinfo($_FILES['img_actors']['name']); // récupère le nom du fichier uploadé
                $extension_upload = $infosfichier['extension']; // récupère l'extenion du fichier uploadé
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG'); // création d'un tableau avec les extensions autorisées
                    if (in_array($extension_upload, $extensions_autorisees)) // si l'extension est autorisée
                    {
                    $titledirty=$_POST['titre']; // récupère le titre brut (pour s'en servir comme nom de fichier image et le passe dans une variable titledirty
                    $titleclean= valideChaine( $titledirty ); // passe le titre brut (titledirty) dans la fonction valideChaine ( qui nettoie le titre afin qu'il puisse correspondre à un format acceptable de titre de fichier ) puis récupère le tout sous forme de variable titleclean
                    $url_img_actors = '/img/actors/'.$titleclean.'.'.$extension_upload; //créé la variable url_img_actors (qui donne le chemin du chier image)                            
                    move_uploaded_file($_FILES['img_actors']['tmp_name'], (dirname(__FILE__) .'/../img/actors/') . basename($url_img_actors));  // On peut valider le fichier et le stocker définitivement
                    
                    $actors_article=actors_article(); // récupère le tableau avec les données de la fiche acteur
                    $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
                    $reponse = $bdd->prepare('UPDATE actors SET url_img_actors = :url_img_actors WHERE id = :id');  // met à jour le chemin de l'image avec les nouvelles informations
                    $reponse->execute(array(
                        'url_img_actors' => $url_img_actors,
                        'id' => $actors_article['id']
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
        $urlpostdirty=$_POST['titre']; // récupère le titre brut (pour s'en servir come URL et le passe dans une variable urlpostdirty
        $urlpostclean = valideChaine( $urlpostdirty ); // passe le titre brut (urlpostdirty) dans la fonction valideChaine ( qui nettoie le titre afin qu'il puisse correspondre à un format d'URL ) puis récupère le tout sous forme de variable urlpostclean
        $url_post = $urlpostclean.'.html'; // Créé la variable url_post en utilsant la variable urlpostclean (url nettoyée ) avec l'extension .html
        
        $actors_article=actors_article(); // récupère le tableau avec les données de la fiche acteur
        $bdd=get_bdd(); // appelle la fonction de connexion à la BDD.
        $reponse = $bdd->prepare('UPDATE actors SET titre = :titre, url_website = :url_website, texte = :texte, url_post = :url_post, meta_description = :meta_description, meta_keywords = :meta_keywords WHERE id = :id'); // insére tous les modifications apportées à la fiche acteur
        $reponse->execute(array(
            'titre' => $_POST['titre'],
            'url_website' => $_POST['url_website'],
            'texte' => $_POST['texte'],
            'url_post' => $url_post,
            'meta_description' => $_POST['meta_description'],
            'meta_keywords' => $_POST['meta_keywords'],
            'id' => $actors_article['id']
        )); 
        
        // script JS permettant de rafraichir la page pour afficher les modifications
        echo '<script language="Javascript">  
        <!--
              document.location.replace("/admin/index.php");
        // -->
  </script>';     
    }
}
