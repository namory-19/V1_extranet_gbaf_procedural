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
    <title>Page d'administration des acteurs et partenaires de l'extranet GBAF</title>
</head>
<body>
    <?php include("../header.php"); ?>
    <section>
        <div class="fil_ariane">
        <p><strong>Fil d'ariane : </strong><a href="index.php">Accueil de l'admin</a> / Espace acteurs</p>
        </div>
    </section>
    <section class="home_about_admin_gbaf">
        <h1>
        Espace acteurs / partenaires
        </h1>
        
        </p>
        <p> Bienvenue sur l'espace d'administration dédié aux acteurs et aux partenaires. 
            Vous aurez ici la possibilité de consulter de voir, de créer, de modifier ou encore de supprimer des fiches.

            Ajouter une fiche acteurs : <a href="admin_actors_add.php">Cliquez ici</a>
        </p>
        </div>
    </section>  
    <section class="home_about_actors">
        <h2>
        Les fiches partenaires / acteurs mise en ligne
        </h2>
        <p> 
        Vous trouverez ci-dessous, les 5 dernières fiches acteurs et partenaires mise en ligne via l'administation de l'extranet GBAF.
        </p>
    </section>
    <section class="home_bloc_actors">
        <div class="home_bloc_actors_container">
            <div class="home_logo_bloc_actors">
                <img src="../img/logo_formation_co.png" alt="logo Formation&Co">
            </div>
            <div class="home_text_bloc_actors">
                <h3>
                    Formation&Co
                </h3>
                <p>
                Formation&co est une association française présente sur tout le territoire.
                Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un ...
                </p>
            </div>
            <div class="home_read_more_bloc_actors">
            <a href="../acteurs.php" target="_blank" rel="noopener noreferrer"><div class="home_read_more_bloc_actors_button">Lire la suite</div></a>   
            </div>
        </div>
    </section>
    <?php include("../footer.php"); ?>
</body>
</html>