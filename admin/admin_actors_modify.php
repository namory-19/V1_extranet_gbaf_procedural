<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
require_once('../core/admin_functions.php'); // appelle le fichier permettant l'accès aux fonctions de l'admin.
verif_group_admin(); // apelle la fonction permettant de récupérer l'id group pour l'affichage des éléments admin et d'autoriser ou non l'affichage
$actors_article=actors_article(); // récupère le tableau avec les données de la fiche acteur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Page de modification des fiches acteurs et partenaires sur l'extranet GBAF</title>
</head>
<body>
    <?php include("../header.php"); ?>  <!--  Charge le header -->
    <section class="home_about_admin_gbaf">
        <h1>
        Modifier la "fiche acteur" : <?php echo $actors_article['titre'] ?>  <!--  affiche le titre de la fiche -->
        </h1>
        <p> 
            Vous avez ici la possibilité de modifier cette fiche "partenaires ou acteurs"
        </p>
        <form action="admin_actors_modify.php?url_post=<?php echo $actors_article['url_post'] ?>" method="post" enctype="multipart/form-data">
                <div>
                <label for="titre"><strong>Titre : </strong></label>
                <br>
                <input class="text_area" type="text" id="titre" name="titre" size="80" value="<?php echo $actors_article['titre'] ?>" autofocus required> <!--  champ pour la modification du titre, pré-rempli avec les données déjà stockée en BDD -->
                </div>
                <br>
                <div>
                <label for="url_website"><strong>URL site web : </strong></label>
                <br>
                <input class="text_area" type="url" id="url_website" name="url_website" size="80" value="<?php echo $actors_article['url_website']?>"> <!--  champ pour la modification de l'url du site web, pré-rempli avec les données déjà stockée en BDD -->
                </div>
                <br>
                <div>
                <label for="texte"><strong>Texte : </strong></label>
                <br>
                <textarea class="text_area" name="texte" id="texte" rows="10" cols="50"required><?php echo $actors_article['texte']?></textarea> <!--  champ pour la modification du texte, pré-rempli avec les données déjà stockée en BDD -->       
                </div>
                <br>
                <div>
                <strong>L'image actuelle est : </strong>
                <br>
                <img class ="img_resp" src="<?php echo $actors_article['url_img_actors']?>" alt="image fiche acteur"> <!--  prévisualisation de l'image actuelle -->
                <br>
                </div>
                <div>
                <br>
                <label for="img_actors"><strong>Changer l'image <br>(type autorisé : png, gif, jpg, jpeg et poids <= 1mo) :  </strong><br></label> <!-- champ pour modfier l'image actuelle -->
                <br>
                <input type="file" id="img_actors" name="img_actors">
                </div>
                <div>
                <br>
                <label for="url"><strong>Meta keyword (mots clés séparés par une virgule) : </strong></label>
                <br>
                <input class="text_area" type="text" id="meta_keywords" name="meta_keywords" size="80" value="<?php echo $actors_article['meta_keywords']?>"> <!--  champ pour modifier ou ajouter des mots clés -->
                </div>
                <br>
                <div>
                <label for="url"><strong>Meta description (description courte) : </strong></label>
                <br>
                <input class="text_area" type="text" id="meta_description" name="meta_description" size="80" value="<?php echo $actors_article['meta_description']?>"> <!--  champ pour modifier la méta description -->
                </div>
                <br>
                <br>
                <div>
                Une fois vos informations enregistrées, vous reviendrez à l'accueil des pages acteurs.
                </div>
                <br>
                <input type="submit" value="Enregistrer" class="button_submit">
            </form>
            <?php 
                modify_actors_article(); // appelle la fonction permettant la modifications des fiches acteurs
                ?>
    </section>  
    <?php include("../footer.php"); ?> <!--  Charge le footer -->
</body>
</html>