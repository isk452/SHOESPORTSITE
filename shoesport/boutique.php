<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF_8'>
    <title>boutique</title>
    <link rel="stylesheet" href="css/boutiques.css">
    <link rel="stylesheet" href="css/combined-styles.css">
    <style>
        body {
            /* Ajouter le CSS pour l'image en arrière-plan */
            background-image: url("imageacceuil/imagevitrine2.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .produits-container {
            /* Ajouter les styles pour les produits */
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 50px 20px;
        }

        .produit {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            width: 200px;
            text-align: center;
        }

        .produit img {
            width: 90px;
        }

        .produit .nom {
            font-weight: bold;
            margin: 10px 0;
        }

        .produit .prix {
            color: #ffa600;
            font-weight: bold;
        }

        .produit .couleur {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <header>
        <?php require_once('header.php') ?>
    </header>

    <div class='bloc-blanc'>
        <h2>Boutique</h2>
    </div>

    <div class="produits-container">
        <?php
        // Connexion à la base de données
        require_once 'db.php';

        // Requête SQL à exécuter
        $sql = "SELECT ID_PRODUIT, Nom, Prix, Couleur FROM produit";

        // Préparation de la première requête
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Récupération des résultats
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Code de la boucle pour générer les images
        foreach ($results as $see) {
            $str = "<img src='imagesboutique/" . $see["ID_PRODUIT"] . ".jpeg' width='90' />";

            // Affichage du produit
            echo '<div class="produit" onclick="window.location=\'product_detail.php?id=' . $see["ID_PRODUIT"] . '\'">';
            echo $str;
            echo '<p class="nom">' . htmlspecialchars($see['Nom'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p class="prix">' . htmlspecialchars($see['Prix'], ENT_QUOTES, 'UTF-8') . '€' . '</p>';
            echo '<p class="couleur">Couleurs : ' . htmlspecialchars($see['Couleur'], ENT_QUOTES, 'UTF-8') . '</p>' . '<br>';
            echo '</div>';
        }

        // Démarrer une session

        // Accéder aux valeurs de la variable de session
        $_SESSION['ID_PRODUIT'] = $see["ID_PRODUIT"];

        ?>
    </div>
</body>

</html>
