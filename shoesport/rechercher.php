<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require_once ('header.php');
require_once ('db.php');
?>

<body>
    <?php
    if (isset($_GET['recherche'])) {
        $recherche = $_GET['recherche'];

        if ($recherche == "") {
            echo "Aucun terme de recherche n'est spécifié.";
        } else {
            $recherche = htmlspecialchars($recherche);

            // Requête SQL avec filtrage par le terme de recherche
            $sql = "SELECT ID_PRODUIT, Nom, Prix, Couleur FROM produit WHERE Nom LIKE :recherche";

            // Préparation de la requête
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':recherche', '%' . $recherche . '%');
            $stmt->execute();

            // Récupération des résultats
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                foreach ($results as $see) {
                    $str = "<img src='imagesboutique/" . $see["ID_PRODUIT"] . ".jpeg' width='90' />";

                    // Affichage du produit
                    echo '<div class="produit" onclick="window.location=\'product_detail.php?id=' . $see["ID_PRODUIT"] . '\'">';
                    echo $str;
                    echo '<p class="nom">' . htmlspecialchars($see['Nom'], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '<p class="prix">' . htmlspecialchars($see['Prix'], ENT_QUOTES, 'UTF-8') . '€' .'</p>';
                    echo '<p class="couleur">Couleurs : ' . htmlspecialchars($see['Couleur'], ENT_QUOTES, 'UTF-8') . '</p>' . '<br>';
                    echo '</div>';
                }

                // Accéder aux valeurs de la variable de session
                $_SESSION['ID_PRODUIT']=$see["ID_PRODUIT"];
            } else {
                echo "Aucun résultat trouvé pour '" . $recherche . "'.";
            }
        }
    }
    ?>
</body>
</html>

