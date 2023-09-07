<?php
// enregistrer_note.php
require_once 'db.php';
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID du produit et la note à partir de la soumission du formulaire
    $produit_id = $_POST['produit_id'];
    $etoiles = $_POST['etoiles'];

    try {
        // Préparer l'instruction INSERT
        $sql = "INSERT INTO note (produit_id, utilisateur_id, etoiles, date_note) VALUES (:produit_id, :utilisateur_id, :etoiles, NOW())";
        $stmt = $conn->prepare($sql); // Utiliser $conn à la place de $pdo

        // Remplacer 'utilisateur_id' par l'ID de l'utilisateur connecté (vous pouvez obtenir cela à partir de la session)
        $utilisateur_id = 1; // Remplacez ceci par l'ID réel de l'utilisateur.
        
        // Lier les paramètres et exécuter l'instruction
        $stmt->bindParam(':produit_id', $produit_id);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':etoiles', $etoiles);
        $stmt->execute();

        // Après avoir inséré la note, mettez à jour la note moyenne du produit dans la table "produit"
        updateAverageRating($conn, $produit_id); // Utiliser $conn à la place de $pdo
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement de la note : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $pdo = null;

    // Rediriger vers la page de détails du produit après la soumission du formulaire
    header("Location: product_detail.php?id=" . $produit_id);
    exit();
}

function updateAverageRating($pdo, $product_id) {
    // Même code que celui mentionné dans la réponse précédente pour calculer et mettre à jour la note moyenne
}
?>

