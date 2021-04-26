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
    <title>Page d'administration de l'extranet GBAF</title>
</head>
<body>
    <?php include("../header.php"); ?> <!--  Charge le header -->
    <section class="home_about_admin_gbaf">
        <h1>
        Espace administrateur de l'Extranet de la GBAF
        </h1>
        <p> Bienvenue sur l'espace d'administration de l'extranet GBAF! <br>
        <p>Pour toutes questions sur l'utilisation de l'administration ou sur des problèmes, merci de contacter le super administrateur à <a href="mailto:admin@gbaf.fr">admin@gbaf.fr</a></p> 
    </section>  
    <section class="home_about_actors">
        <h2>
        Les fiches partenaires / acteurs en ligne
        </h2>
        <p>
        Vous avez ici la possibilité de consulter de voir, de créer, de modifier ou encore de supprimer des fiches. <br>
        Pour ajouter une nouvelle fiche acteur, il suffit simplement de <a href="admin_actors_add.php">Cliquez ici</a>.
        </p>
        <p>
        Vous trouverez ci-dessous, les dernières fiches acteurs et partenaires mise en ligne via l'administration de l'extranet GBAF. Il vous est possible de les modifier ou de les supprimer en cliquant sur les liens.
        </p>
    </section>
    <section id="pagination_go">  
        <?php select_actors_article_admin(); // appelle la fonction permettant d'afficher la totalité de la liste des article partenaire avec une pagination en bas de page ainsi que des liens pour supprimer ou modfier les fiches ?>
    </section>
    <?php include("../footer.php"); ?> <!--  Charge le footer -->
</body>
</html>
