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
                    <img class="img_icon_user"src="img/icon_user.png" alt="Avatar utilisateur">
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