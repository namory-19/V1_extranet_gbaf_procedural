<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
require_once('../core/admin_functions.php'); 
verif_group_admin();
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
    <?php include("../header.php"); ?>
    <section>
        <div class="fil_ariane">
        <p><strong>Fil d'ariane : </strong><a href="index.php">Accueil de l'admin</a> / <a href="admin_actors.php">Espace acteurs</a></p>
        </div>
    </section>
    <section class="home_about_admin_gbaf">
        <h1>
        Ajouter une nouvelle "fiche acteur"
        </h1>
        <p> 
            Vous avez ici la possibilité d'ajouter une nouvelle fiche "partenaires ou acteurs"
        </p>
        <form action="admin_actors_add.php" method="post" enctype="multipart/form-data">
                <div>
                <label for="titre"><strong>Titre : </strong></label>
                <br>
                <input type="text" id="titre" name="titre" size="80" value="<?php echo isset($_POST['titre'])? $_POST['titre'] :'';?>" autofocus required>
                </div>
                <br>
                <div>
                <label for="url_website"><strong>URL site web : </strong></label>
                <br>
                <input type="url" id="url_website" name="url_website" size="80" value="<?php echo isset($_POST['url_website'])? $_POST['url_website'] :'';?>">
                </div>
                <br>
                <div>
                <label for="texte"><strong>Texte : </strong></label>
                <br>
                <textarea name="texte" id="texte" rows="10" cols="50" required></textarea>       
                </div>
                <br>
                <div>
                <label for="img_actors"><strong>Image <br>(type autorisé : png, gif, jpg, jpeg et poids <= 1mo) :  </strong><br></label> <!-- champ pour la réponse à la question secrète -->
                <br>
                <input type="file" id="img_actors" name="img_actors">
                </div>
                <div>
                <br>
                <label for="url"><strong>Meta keyword (mots clés séparés par une virgule) : </strong></label>
                <br>
                <input type="text" id="meta_keywords" name="meta_keywords" size="80" value="<?php echo isset($_POST['meta_keywords'])? $_POST['meta_keywords'] : '';?>">
                </div>
                <br>
                <div>
                <label for="url"><strong>Meta description (description courte) : </strong></label>
                <br>
                <input type="text" id="meta_description" name="meta_description" size="80" value="<?php echo isset($_POST['meta_description'])? $_POST['meta_description'] : '';?>">
                </div>
                <br>
                <input type="submit" value="Enregistrer" class="button_submit">
                <?php 
                create_actors_article(); 
                ?>
            </form>
    </section>  
    <?php include("../footer.php"); ?>
</body>
</html>