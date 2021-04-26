<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
require_once('../core/admin_functions.php'); // appelle le fichier permettant l'accès aux fonctions de l'admin.
verif_group_admin(); // apelle la fonction permettant de récupérer l'id group pour l'affichage des éléments admin et d'autoriser ou non l'affichage
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Page d'ajout d'acteurs et partenaires sur l'extranet GBAF</title>
</head>
<body>
    <?php include("../header.php"); ?> <!--  Charge le header -->
    <section class="home_about_admin_gbaf">
        <h1>
        Ajouter une nouvelle "fiche acteur"
        </h1>
        <p> 
            Vous avez ici la possibilité d'ajouter une nouvelle fiche "partenaires ou acteurs" ou de revenir à <a href="index.php">l'accueil de l'admin</a>.
        </p>
        <form action="admin_actors_add.php" method="post" enctype="multipart/form-data">
                <div>
                <label for="titre"><strong>Titre : </strong></label>
                <br>
                <input class="text_area" type="text" id="titre" name="titre" size="80" value="<?php echo isset($_POST['titre'])? $_POST['titre'] :'';?>" autofocus required> <!-- champ pour le titre de la fiche acteur -->
                </div>
                <br>
                <div>
                <label for="url_website"><strong>URL site web : </strong></label> 
                <br>
                <input class="text_area" type="url" id="url_website" name="url_website" size="80" value="<?php echo isset($_POST['url_website'])? $_POST['url_website'] :'';?>">  <!-- champ pour le site web de la fiche acteur -->
                </div>
                <br>
                <div>
                <label for="texte"><strong>Texte : </strong></label> 
                <br>
                <textarea class="text_area" name="texte" id="texte" rows="10" cols="50" required></textarea>  <!-- champ pour le texte de la fiche acteur -->
                </div>
                <br>
                <div>
                <label for="img_actors"><strong>Image <br>(type autorisé : png, gif, jpg, jpeg et poids <= 1mo) :  </strong><br></label> 
                <br>
                <input type="file" id="img_actors" name="img_actors"> <!-- champ pour l'upload de l'image de la fiche acteur -->
                </div>
                <div>
                <br>
                <label for="url"><strong>Meta keyword (mots clés séparés par une virgule) : </strong></label>
                <br>
                <input class="text_area" type="text" id="meta_keywords" name="meta_keywords" size="80" value="<?php echo isset($_POST['meta_keywords'])? $_POST['meta_keywords'] : '';?>"> <!-- champ pour les méta keywords de la fiche acteur -->
                </div>
                <br>
                <div>
                <label for="url"><strong>Meta description (description courte) : </strong></label>
                <br>
                <input class="text_area" type="text" id="meta_description" name="meta_description" size="80" value="<?php echo isset($_POST['meta_description'])? $_POST['meta_description'] : '';?>"> <!-- champ pour la méta description de la fiche acteur -->
                </div>
                <br>
                <input type="submit" value="Enregistrer" class="button_submit">
                <?php 
                create_actors_article(); // appelle la fonction permettant la création des fiches acteurs 
                ?>
            </form>
    </section>  
    <?php include("../footer.php"); ?> <!--  Charge le footer -->
</body>
</html>