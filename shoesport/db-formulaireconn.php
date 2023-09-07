<?php
require_once('db.php'); // Inclure le fichier de connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['nom_et_prenom'], $_POST['email'], $_POST['mdp'])) {
        $nom_et_prenom = $_POST['nom_et_prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        // Hacher le mot de passe
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

        // Requête SQL pour insérer les données dans la table 'utilisateurs'
        $sql = "INSERT INTO utilisateurs (nom_et_prenom, email, mot_de_passe) VALUES (:nom_et_prenom, :email, :mdp)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_et_prenom', $nom_et_prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $mdp_hash);

        try {
            $stmt->execute();
            // Redirection vers la page de confirmation
            header("Location: confirmation_inscription.php");
            exit();            
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}

// Fermer la connexion à la base de données
$conn = null;

?>
