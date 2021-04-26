<?php
//
//
// fonction permettant la connexion à la base de données
//
//

function get_bdd (): \PDO 
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', 'root'); // connexion à la BDD
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // affichage des erreurs SQL
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); // affichage des erreurs SQL
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage()); // message d'erreur si problème connexion BDD
    }
    return $bdd;
}