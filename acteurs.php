<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Page partenaire et acteur</title>
</head>
<body>
    <?php include("header.php"); ?>
    <section class="page_actors">
        <div class="logo_page_actors">
            <img src="img/logo_formation_co.png" alt="logo Formation&Co">
        </div>
        <div class="text_page_actors">
            <h2>
                Formation&co
            </h2>
            <p>
            <strong>Site web :</strong> <a href="http://formationco.fr" target="_blank" rel="noopener noreferrer">www.formationco.fr</a>
            </p>
            <p>Formation&co est une association française présente sur tout le territoire.
                Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.
            </p>
                <ul>
                    <li>un financement jusqu’à 30 000€</li>
                    <li>un suivi personnalisé et gratuit</li>
                    <li>une lutte acharnée contre les freins sociétaux et les stéréotypes</li>
                </ul>
            <p>
                Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.
                Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.
            </p>
        </div>
    </section>
    <section class="commentaire">
        <div class="commentaire_container">
            <div class="bloc_header_comment">
                <div class="nb_comment">
                    <h2>
                        2 commentaires
                    </h2>
                </div>
                <div class="new_comment">
                <a href="/"><div class="comment_button">Nouveau commentaire</div></a>   
                </div>
                <div class="counterlike_button">
                    <div class="like">
                    <p>500000 </p>
                    <img src="img/up.png" alt="logo like">
                    </div>
                    <div class="unlike">
                    <p>2 </p>
                    <img src="img/down.png" alt="logo unlike">
                    </div>
                </div>
            </div>
            <div class="bloc_comment">
                <p><strong>Prénom :</strong> Nicolas</p>
                <p><strong>Date :</strong> 18/02/2021 à 16h50min50s</p>
                <p><strong>Commentaire :</strong> Super partenaire! je recommende!</p>
            </div>
            <div class="bloc_comment">
                <p><strong>Prénom :</strong> Marie</p>
                <p><strong>Date :</strong> 16/01/2021 à 19h40min45s</p>
                <p><strong>Commentaire :</strong> Très utile pour le montage des dossiers pour des formations</p>
            </div>
            <div class="bloc_comment">
                <p><strong>Prénom :</strong> Laura</p>
                <p><strong>Date :</strong> 16/01/2021 à 08h44min43s</p>
                <p><strong>Commentaire :</strong> Très utile pour le montage des dossiers pour des formations</p>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>