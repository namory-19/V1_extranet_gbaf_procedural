<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
require_once('core/functions.php');  // appelle le fichier permettant la connexion à la BDD.
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
    <title>Page d'accueil de l'extranet GBAF</title>
</head>
<body>
    <?php include("header.php"); ?>  <!--  Charge le header -->
    <section class="home_about_gabf">
        <h1>
        Extranet de la GBAF
        </h1>
        <p> Le Groupement Banque Assurance Français (GBAF) est une fédération
            représentant les <strong>6 grands groupes français</strong> : 
        </p>
            <ul>
            <li>Paribas</li>
            <li>BPCE</li>
            <li>Crédit Agricole</li>
            <li>Crédit Mutuel-CIC</li>
            <li>Société Générale</li>
            <li>La Banque Postale</li>
            </ul>
        <p>  
            Ces entités représentent près de <strong>80 millions de comptes</strong> sur le territoire
            national.
            <br>
            Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. 
            Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.
        </p>
        <div class="home_ban_gbaf">
        <img src="img/ban_gbaf_home.jpg" alt="Bannière GBAF, plus 80 millions de comptes en gestion">
        </div>
    </section>  
    <section class="home_about_actors">
        <h2>
        Les acteurs et partenaires de la GBAF
        </h2>
        <p> Les produits et services bancaires sont nombreux et très variés. Afin de
            renseigner au mieux les clients, les salariés des 340 agences des banques et
            assurances en France (agents, chargés de clientèle, conseillers financiers, etc.) recherchaient jusqu'ici sur Internet des informations portant sur des produits bancaires et des financeurs, entre autres.
            <br><br>
            Aujourd’hui, et à fin de faciliter le travail de ces derniers, le GBAF met à disposition une base de données pour chercher ces informations de manière fiable et rapide ou pour donner son avis sur les partenaires et acteurs du secteur bancaire, tels que les associations ou les financeurs solidaires.
            <br><br>
            Le GBAF propose donc aux salariés des grands groupes français un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services bancaires et financiers.
            <br><br>
            Sur cet extranet, chaque salariés peut aussi poster un commentaire et donner son avis sur un acteur ou partenaire.
        </p>
    </section>
    <section id="pagination_go">  
        <?php select_actors_article(); ?> <!--  fonction permettant d'afficher la liste des article partenaire avec une pagination en bas de page --->
    </section>
    <?php include("footer.php"); ?> <!--  Charge le footer --->
</body>
</html>