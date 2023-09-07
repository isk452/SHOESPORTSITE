<?php
// Connexion à la base de données
try {
    require_once 'db.php';
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérification si le panier n'est pas vide
if (!empty($_SESSION['panier'])) {
    // Préparation de la requête d'insertion
    $stmt = $bdd->prepare("INSERT INTO panier (produit_nom, produit_prix, produit_quantite, produit_reference, ID_UTILISATEUR) VALUES (?, ?, ?, ?, ?)");
    
    // Boucle sur les produits du panier
    foreach ($_SESSION['panier'] as $utilisateur_id => $produits) {
        foreach ($produits as $produit) {
            // Insertion des données dans la base de données
            $stmt->execute(array(
                $produit['nom'],
                $produit['prix'],
                $produit['quantite'],
                $produit['reference'],
                $utilisateur_id
            ));
        }
    }
    // Effacement du panier
    unset($_SESSION['panier']);
    
    echo "Le panier a été validé et les données ont été insérées dans la base de données.";
} else {
    echo "Le panier est vide.";
}

session_start();
if (isset($_SESSION['ID_UTILISATEUR'])) {
    $utilisateur_id = $_SESSION['ID_UTILISATEUR'];

    if (isset($_SESSION['panier'][$utilisateur_id])) {
        foreach ($_SESSION['panier'][$utilisateur_id] as $produit) {
            echo 'Nom : ' . $produit['nom'] . '<br>';
            echo 'Prix : ' . $produit['prix'] . '<br><br>';
            echo 'Quantite : ' . $produit['quantite'] . '<br>';
            echo 'Reference : ' . $produit['reference'] . '<br><br>';
        }
    } else {
        echo 'Panier vide';
    }
} else {
    echo 'Utilisateur non connecté';
}
?>
<html>

<body>
    <form method="POST" action="redirectologin.php">
        <input type="submit" value="Passer la commande">
    </form>
    <?php  require_once ('footer.php') ?>
</body>

</html>