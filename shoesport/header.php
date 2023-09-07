<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Head.css">
    <title>Header</title>
</head>

<body>
    <div class="head">
        <nav>
            <ul class="navbar">
                <li><a href="acceuil.php">Accueil</a></li>
                <li><a href="boutique.php">Boutique</a></li>
                <li><a href="contact.php">Contact</a></li>
                <img src="imagesheader/logo.jpg" class="logo" alt="">
                <img class='imagepanier' src="imagesheader/panier.jpg" alt="" onclick="window.location.href = 'panier.php';">
                <?php
                if (isset($_SESSION['id_utilisateur'])) {
                    $id_utilisateur = $_SESSION['id_utilisateur'];
                } else {
                    $id_utilisateur = null;
                }

                // Affichage conditionnel des boutons
                if ($id_utilisateur) {
                    echo '<button class="btn-primary" onclick="location.href=\'page_personnelle.php?id=' . $id_utilisateur . '\'">Accéder à ma page personnelle</button>';
                } else {
                    echo '<button class="btn-secondary" onclick="location.href=\'form_connexion_inscription.php\'">S\'identifier</button>';
                }
                ?>
            </ul>
        </nav>
    </div>
</body>

