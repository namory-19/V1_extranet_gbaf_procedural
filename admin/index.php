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
    <title>Page d'administration de l'extranet GBAF</title>
</head>
<body>
    <?php include("../header.php"); ?>
    <section class="home_about_admin_gbaf">
        <h1>
        Espace administrateur de l'Extranet de la GBAF
        </h1>
        <p> Bienvenue sur l'espace d'administration de l'extranet GBAF! Vous pourrez ici effectuer toutes les modifications que vous souhaitez :
        </p>
            <ul>
            <li>Visualiser, créer, modifier ou supprimer des fiches partenaires en <a href="admin_actors.php" target="_blank" rel="noopener noreferrer">cliquant ici</a></li>
            <li>Visualiser créer, modifier ou supprimer des comptes utilisateurs en <a href="admin_users.php" target="_blank" rel="noopener noreferrer">cliquant ici</a></li>
            <li>Visualiser créer, modifier ou supprimer des commentaires <a href="admin_comments.php" target="_blank" rel="noopener noreferrer">cliquant ici</a></li>
            </ul>
        <p>Pour toutes questions sur l'utilisation de l'administration ou sur des problèmes, merci de contacter le super administrateur à <a href="mailto:admin@gbaf.fr">admin@gbaf.fr</a></p> 
        </div>
    </section>  
    <section class="home_about_actors">
        <h2>
        Les dernières fiches partenaires mise en ligne
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
    <section class="home_about_actors">
        <h2>
        Les dernières inscription à l'extranet GBAF
        </h2>
        <p> 
        Vous trouverez ci-dessous, les 5 dernières inscriptions à l'extranet GBAF.
        </p>
    </section>
    <?php include("../footer.php"); ?>
</body>
</html>