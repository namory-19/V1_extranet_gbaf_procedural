<header>
    <div class="container_logo_gabf">
    <a href="index.php"><img src="../img/logo_gbaf.png" alt="logo GBAF"></a>
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
                            <a href="?disconnect">Déconnexion</a>
                            <?php
                            require_once('core/functions.php');
                            disconnect();
                            ?>
                            <br>
                            <?php if ($_SESSION['usergroup'] === '2')
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
    </div>
</header>