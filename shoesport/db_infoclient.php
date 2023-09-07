<?php
// Connexion à la base de données
require_once 'db.php';

try {
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base_de_donnees', 'nom_utilisateur', 'mot_de_passe');
} catch (PDOException $e) {
echo 'Connexion échouée : ' . $e->getMessage();
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$utilisateur_id = $_SESSION['ID_UTILISATEUR'];

// Préparation de la requête d'insertion
$sql = "INSERT INTO infoclient (ID_UTILISATEUR, nom, prenom, adresse) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

// Exécution de la requête avec les données du formulaire
$stmt->execute([$utilisateur_id, $nom, $prenom, $adresse]);

// Confirmation de l'insertion
if ($stmt->rowCount()) {
echo "Les informations ont été enregistrées avec succès.";
} else {
echo "Une erreur est survenue lors de l'enregistrement des informations.";
}
?>