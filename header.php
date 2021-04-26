<header>
    <div class="container_logo_gabf">
    <a href="index.php"><img src="../img/logo_gbaf.png" alt="logo GBAF"></a>
    </div>
    <?php
     require_once('core/functions.php'); // appelle le fichier permettant l'accès aux fonctions.
        if (isset($_SESSION['id_user'])) // contrôle que l'utilisateur est bien loggé en vérifiant dans la session l'id
            {
                ?>
                <div class="bloc_user">
                    <div class="icon_user">
                        <?php
                        view_img_avatar(); // fonction permettant l'affichage de l'avatar sur la page mon compte et dans le header.
                        $avatar_img=view_img_avatar(); ?>  <!--  Charge le vairoable contenant l'url de l'image --->
                        <img class="img_icon_user" src="<?php echo $avatar_img ? $avatar_img : $_SESSION['url_img_avatar'] ?>" alt="Avatar utilisateur"> <!--  affiche l'image renvoyée par la fonction --->
                </div>
                <div class="user">
                    <p>
                    <?php
                            ?>
                            <strong><?php echo htmlspecialchars($_SESSION['prenom']) ?></strong>  <!--  affiche le prénom présent en session --->
                            <strong><?php echo htmlspecialchars($_SESSION['nom']) ?></strong> <!--  affiche le nom présent en session --->
                            <?php
                            ?>
                            <br>
                            <a href="/moncompte.php">Mon compte</a> /
                            <a href="?disconnect">Déconnexion</a> <!--  permet la deconnexion et la supression des données en session--->
                            <?php
                            disconnect(); //fonction permettant de se deconnecter et de supprimer la session
                            ?>
                            <br>
                            <?php if ($_SESSION['usergroup'] === '2') // si l'utilisateur loggé est un administrateur (usergoup = 2) alors affiche des liens supplémentaires 
                                {
                                    ?>
                                    <a href="/admin/index.php">Espace admin</a> /
                                    <a href="/index.php">Front office</a>
                                    <?php
                                }
                            ?>
                    </p>
                </div>    
            <?php
            }
        ?>
</header>