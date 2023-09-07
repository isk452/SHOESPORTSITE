<head>
    <meta charset="UTF_8">
</head>

<?php
require_once('db.php');
require_once('header.php');

try {
  $pdo = new PDO("mysql:host=localhost;dbname=proshoes", 'root', '');
  // Ajouter les options PDO si nécessaire
} catch (PDOException $e) {
  echo "Erreur de connexion : " . $e->getMessage();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
  echo "Vous n'êtes pas connecté.";
  exit;
}
// Récupérer l'ID du produit depuis l'URL
$id_produit = $_GET['id'];

// Mettre à jour la quantité du produit dans le panier de l'utilisateur
$stmt = $conn->prepare("UPDATE panier SET quantite = quantite - 1 WHERE id_utilisateur = ? AND id_produit = ? AND quantite > 0");
$stmt->execute([$_SESSION['id_utilisateur'], $id_produit]);
// Supprimer le produit du panier si sa quantité est 0
$stmt = $pdo->prepare("DELETE FROM panier WHERE id_utilisateur = ? AND id_produit = ? AND quantite = 0");
$stmt->execute([$_SESSION['id_utilisateur'], $id_produit]);


// Rediriger l'utilisateur vers la page du panier
header("Location: panier.php");
exit;

?>