<?php
session_start();

// Vérifier si le panier existe dans la session
if (isset($_SESSION['panier'])) {

    // Afficher le titre du panier
    echo "<h2>Panier :</h2>";

    // Afficher la liste des produits dans le panier
    foreach ($_SESSION['panier'] as $produit) {
        echo "<p>".$produit['nom']." - ".$produit['quantite']." x ".$produit['prix']." €</p>";
    }

} else {
    echo "<p>Votre panier est vide.</p>";
}
?>