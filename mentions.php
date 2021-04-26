<?php
session_start(); // On démarre la session pour récupérer les informations destinées au contôle de connexion 
require_once('core/functions.php');  // Appelle le fichier functions.php chargeant toutes les fonctions du font office dont la connexion à la BDD.
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
    <title>Mentions légales de l'extranet GBAF</title>
</head>
<body>
    <!--  Charge le header --->
    <?php include("header.php"); ?>
    <section class="home_about_gabf">
        <h1>
        Mentions légales de l'Extranet de la GBAF
        </h1>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ornare mi vel nisl fermentum tempus. Donec et congue libero. Donec nisi odio, pretium a nulla quis, blandit lobortis ligula. Vestibulum vel magna ante. Praesent nec lorem porttitor, hendrerit ligula non, vehicula dui. Mauris mollis, risus iaculis sollicitudin blandit, purus elit vestibulum diam, non fringilla justo dolor ac turpis. Vestibulum dapibus posuere maximus. Nulla id metus congue, aliquet lectus a, tempor urna. Aliquam erat volutpat. In ac sem dolor. 
        </p><br>
        <h3>
        Pellentesque eget tellus in velit interdum sollicitudin ac in lectus.
        </h3>
        <p>  
        Cras faucibus nibh dolor, sed porta ex sodales non. Sed aliquam ex et ex pulvinar, commodo tristique diam sagittis. Praesent nisl lectus, tristique in pharetra a, consequat nec nulla. Proin cursus metus diam, in aliquet neque laoreet at. Proin tellus mi, pretium at arcu eu, tempor pellentesque massa. Aliquam ac erat ut quam dapibus dapibus. Pellentesque vitae sem nunc. Pellentesque non cursus massa, ut congue lorem. 
        </p><br>
        <h3>
        Quisque quis augue at magna gravida ultrices.
        </h3>
        <p>  
        Nulla enim diam, euismod a ligula quis, aliquam vestibulum risus. Sed sodales lorem ut condimentum porta. Phasellus et sagittis urna. Proin molestie porta tristique. Nullam elementum felis erat, ac molestie felis finibus nec. Aliquam convallis tortor aliquet ornare maximus. Donec ut vestibulum ligula, sed ornare dolor. Nulla nec feugiat ligula. 
        </p><br>
        <h3>
        Ut risus enim, placerat vel consequat nec, cursus pulvinar mauris.
        </h3>
        <p>  
        Quisque non lectus accumsan, congue arcu a, molestie purus. Sed eget rhoncus felis. Fusce sagittis porta augue a condimentum. Nulla aliquam dolor vel consectetur suscipit. Integer a sapien mi. Curabitur in dui porta est interdum pellentesque id at lacus. Nullam molestie, nulla at facilisis tristique, nibh nulla placerat tellus, vel varius libero neque a arcu. Nullam blandit, neque in pulvinar tincidunt, erat turpis euismod sapien, vitae ultrices libero dolor eu velit. Nullam tincidunt, lacus sed luctus vestibulum, eros quam sagittis ligula, et faucibus orci augue id ipsum. Suspendisse gravida ex arcu, ut consequat tellus ullamcorper sed. 
        </p><br>
        <h3>
        Suspendisse leo tellus, pellentesque vitae pulvinar nec, lobortis at magna.
        </h3>
        <p>  
        Donec eleifend leo a metus mattis pharetra. Etiam efficitur mi vitae sem lobortis interdum. Integer eu dui consequat, viverra enim sit amet, laoreet magna. Pellentesque a velit ut velit ultricies fringilla. Vivamus est orci, vestibulum ut malesuada ut, faucibus at diam. Duis interdum sollicitudin maximus. Nullam lacinia efficitur tortor, at laoreet nisi facilisis non. Nunc non mauris at odio ornare iaculis. Aliquam erat volutpat. Suspendisse potenti. Etiam non enim scelerisque, ultrices dolor vel, vestibulum dolor. Duis aliquam justo erat. 
        </p><br>
        <h3>
        Sed et metus vel elit pharetra congue.
        </h3>
        <p>  
        Proin aliquet lacus et velit pulvinar tincidunt. Nunc metus neque, facilisis vitae rutrum id, varius accumsan odio. In nec dignissim mi. Cras eget erat vel ex posuere molestie. Proin luctus lobortis neque, vel luctus diam luctus vel. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla blandit aliquet sagittis. Ut maximus pellentesque tincidunt. Nulla sit amet neque dapibus, lacinia erat sed, hendrerit nisl. Donec varius dolor ipsum. 
        </p><br>
        <h3>
        Pellentesque eget tellus in velit interdum sollicitudin ac in lectus.
        </h3>
        <p>  
        Cras faucibus nibh dolor, sed porta ex sodales non. Sed aliquam ex et ex pulvinar, commodo tristique diam sagittis. Praesent nisl lectus, tristique in pharetra a, consequat nec nulla. Proin cursus metus diam, in aliquet neque laoreet at. Proin tellus mi, pretium at arcu eu, tempor pellentesque massa. Aliquam ac erat ut quam dapibus dapibus. Pellentesque vitae sem nunc. Pellentesque non cursus massa, ut congue lorem. 
        </p><br>
        <h3>
        Quisque quis augue at magna gravida ultrices.
        </h3>
        <p>  
        Nulla enim diam, euismod a ligula quis, aliquam vestibulum risus. Sed sodales lorem ut condimentum porta. Phasellus et sagittis urna. Proin molestie porta tristique. Nullam elementum felis erat, ac molestie felis finibus nec. Aliquam convallis tortor aliquet ornare maximus. Donec ut vestibulum ligula, sed ornare dolor. Nulla nec feugiat ligula. 
        </p><br>
        <h3>
        Ut risus enim, placerat vel consequat nec, cursus pulvinar mauris.
        </h3>
        <p>  
        Quisque non lectus accumsan, congue arcu a, molestie purus. Sed eget rhoncus felis. Fusce sagittis porta augue a condimentum. Nulla aliquam dolor vel consectetur suscipit. Integer a sapien mi. Curabitur in dui porta est interdum pellentesque id at lacus. Nullam molestie, nulla at facilisis tristique, nibh nulla placerat tellus, vel varius libero neque a arcu. Nullam blandit, neque in pulvinar tincidunt, erat turpis euismod sapien, vitae ultrices libero dolor eu velit. Nullam tincidunt, lacus sed luctus vestibulum, eros quam sagittis ligula, et faucibus orci augue id ipsum. Suspendisse gravida ex arcu, ut consequat tellus ullamcorper sed. 
        </p><br>
        <h3>
        Suspendisse leo tellus, pellentesque vitae pulvinar nec, lobortis at magna.
        </h3>
        <p>  
        Donec eleifend leo a metus mattis pharetra. Etiam efficitur mi vitae sem lobortis interdum. Integer eu dui consequat, viverra enim sit amet, laoreet magna. Pellentesque a velit ut velit ultricies fringilla. Vivamus est orci, vestibulum ut malesuada ut, faucibus at diam. Duis interdum sollicitudin maximus. Nullam lacinia efficitur tortor, at laoreet nisi facilisis non. Nunc non mauris at odio ornare iaculis. Aliquam erat volutpat. Suspendisse potenti. Etiam non enim scelerisque, ultrices dolor vel, vestibulum dolor. Duis aliquam justo erat. 
        </p><br>
        <h3>
        Sed et metus vel elit pharetra congue.
        </h3>
        <p>  
        Proin aliquet lacus et velit pulvinar tincidunt. Nunc metus neque, facilisis vitae rutrum id, varius accumsan odio. In nec dignissim mi. Cras eget erat vel ex posuere molestie. Proin luctus lobortis neque, vel luctus diam luctus vel. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla blandit aliquet sagittis. Ut maximus pellentesque tincidunt. Nulla sit amet neque dapibus, lacinia erat sed, hendrerit nisl. Donec varius dolor ipsum. 
        </p><br>
    </section>  
     <!--  Charge le footer --->
    <?php include("footer.php"); ?>
</body>
</html>