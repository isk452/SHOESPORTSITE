<head>
    <meta charset="UTF-8">
</head>
<header>
    <?php
    require_once('header.php');
    ?>
</header>
<?php
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
// Rediriger vers la page de connexion
header("Location: connexion.php");
exit;
}// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
// Rediriger vers la page de connexion
header("Location: form_connexion_inscription.php");
exit;
}

// Vérification que l'ID du produit est présent dans l'URL
if (!isset($_GET['id'])) {
  echo "L'ID du produit n'a pas été spécifié.";
  exit;
}

// Récupération des informations du produit depuis la base de données
$idProduit = $_GET['id'];
require_once('db.php');
$pdo = new PDO("mysql:host=localhost;dbname=proshoes", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("SELECT * FROM produit WHERE ID_PRODUIT = ?");
$stmt->execute([$idProduit]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification que le produit existe
if ($produit === false) {
echo "Le produit avec l'ID $idProduit n'existe pas.";
exit;
}

// Vérification si le produit est déjà dans le panier de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM panier WHERE id_utilisateur = ? AND id_produit = ?");
$stmt->execute([$_SESSION['id_utilisateur'], $idProduit]);
$lignePanier = $stmt->fetch(PDO::FETCH_ASSOC);

// Si le produit est déjà dans le panier, on augmente la quantité
if ($lignePanier) {
$quantite = $lignePanier['quantite'] + 1;
$sql = "UPDATE panier SET quantite = ? WHERE id_panier = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$quantite, $lignePanier['id_panier']]);
} else {
// Si le produit n'est pas encore dans le panier, on l'ajoute avec une quantité de 1
$sql = "INSERT INTO panier (nom, prix, couleur, id_utilisateur, id_produit, quantite) VALUES (?, ?, ?, ?, ?, 1)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$produit['Nom'], $produit['Prix'], $produit['Couleur'],
$_SESSION['id_utilisateur'], $idProduit]);
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>