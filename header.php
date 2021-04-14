<header>
    <div class="container_logo_gabf">
    <a href="/accueil.php"><img src="img/logo_gbaf.png" alt="logo GBAF"></a>
    </div>
    <?php
        if (isset($_SESSION['id_user']))
            {
                ?>
                <div class="bloc_user">
                    <div class="icon_user">
                        <?php
                        require_once('core/functions.php');
                        view_img_avatar(); // va chercher la fonction qui controle l'affichage de l'avatar dans core/functions.php
                        $avatar_img=view_img_avatar(); ?>
                        <img class="img_icon_user"src="<?php echo $avatar_img ? $avatar_img : $_SESSION['url_img_avatar'] ?>" alt="Avatar utilisateur">
                    </div>
                    <div class="user">
                        <p>
                            <?php
                                ?>
                                <strong><?php echo htmlspecialchars($_SESSION['prenom']) ?></strong>
                                <strong><?php echo htmlspecialchars($_SESSION['nom']) ?></strong>
                                <?php
                            ?>
                            <br>
                            <a href="/moncompte.php">Mon compte</a> /
                            <a href="/deconnexion.php">Déconnexion</a>
                        </p>
                    </div>
                <?php
            }
            ?>
    </div>
</header>