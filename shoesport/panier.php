<head>
    <meta charset='UTF_8'>
    <link rel="stylesheet" href="css/panier.css">
    <link rel="stylesheet" href="css/combined-styles.css">
    <title>Panier</title>
</head>
<header>
    <?php 
require_once ('header.php');

?>
</header>
<?php
// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
  echo "Vous n'êtes pas connecté.";
  exit;
}

// Récupération des éléments du panier de l'utilisateur depuis la base de données
require_once ('db.php');
$pdo = new PDO("mysql:host=localhost;dbname=shoesport", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("SELECT id_utilisateur, id_produit, nom, prix, couleur, SUM(quantite) as total_quantite FROM panier WHERE id_utilisateur = ? GROUP BY id_produit");
$stmt->execute([$_SESSION['id_utilisateur']]);
$elements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Connexion à la base de données
require_once 'db.php';

// Requête SQL à exécuter
$sql = "SELECT ID_PRODUIT, Nom, Prix, Couleur FROM produit";

// Préparation de la première requête
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Récupération des résultats
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des éléments
if (isset($elements)) {
    foreach ($elements as $element) {
        echo '<div class="panier-element">';
        echo "<p> " . $element['nom'] . "</p>";
        echo "<p>Prix : " . $element['prix'] .  " €</p>";
        echo "<p>Couleur : " . $element['couleur'] . "</p>";
        echo "<p>Quantité : " . $element['total_quantite'] . "</p>";
        echo '<a href="deletepanier.php?id=' . $element['id_produit'] . '">Supprimer du panier</a>';
        echo "</div>";
    }
}

// Requête SQL pour récupérer l'id_utilisateur depuis la table panier
$sql_id_utilisateur = "SELECT id_utilisateur FROM panier LIMIT 1";
$result_id_utilisateur = $pdo->query($sql_id_utilisateur);

// Requête SQL pour compter le nombre d'enregistrements dans la table "panier"
$sqlreq = "SELECT COUNT(*) as total FROM panier";
$result = $conn->query($sqlreq);
$row = $result->fetch(PDO::FETCH_ASSOC);

// Vérifier si le panier est vide
if ($row['total'] == 0) {
    echo "Votre panier est vide";
} else {
    // Récupérer la valeur de l'id_utilisateur
    $row_id_utilisateur = $result_id_utilisateur->fetch(PDO::FETCH_ASSOC);
    $id_utilisateur = $row_id_utilisateur['id_utilisateur'];

    // Code pour afficher le lien
    echo '<a href="recap.php?id=' . $id_utilisateur . '">Valider le panier</a>';
}