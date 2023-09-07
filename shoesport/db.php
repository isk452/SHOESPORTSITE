<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "shoesport";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=shoesport", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ... votre code de traitement des formulaires ...

    // Vérification de la connexion
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["connexion"])) {
            // ... le reste de votre code ...
        } elseif (isset($_POST["inscription"])) {
            // ... le reste de votre code ...
        }
    }
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
// ... votre code de traitement des formulaires ...

// Vérification de la connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["connexion"])) {
        $nom_et_prenom = $_POST["nom_et_prenom"];
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];

        // Assurez-vous de valider et nettoyer les données avant de les utiliser
        // ...

        // Requête SQL pour obtenir les informations de l'utilisateur basées sur l'adresse e-mail
        $sql = "SELECT id, nom_et_prenom, mot_de_passe FROM utilisateurs WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
            // L'utilisateur a fourni des informations valides
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nom_et_prenom'];
            header("Location: accueil.php"); // Redirigez vers la page d'accueil après la connexion
            exit();
        } else {
            echo "Identifiants invalides. Veuillez réessayer.";
        }
    } elseif (isset($_POST["inscription"])) {
        $nom_et_prenom = $_POST["nom_et_prenom"];
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        $verifmdp = $_POST["verifmdp"];
        $adresse = $_POST["adresse"];

        // Assurez-vous de valider et nettoyer les données avant de les utiliser
        // ...

        // Hacher le mot de passe
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

        // Requête SQL pour insérer les données dans la table 'utilisateurs'
        $sql = "INSERT INTO utilisateurs (nom_et_prenom, email, mot_de_passe) VALUES (:nom_et_prenom, :email, :mdp)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_et_prenom', $nom_et_prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $mdp_hash);        
        
        // Exécution de la requête
        $stmt->execute();

        echo "Données insérées avec succès !";

        // Redirigez l'utilisateur après l'inscription
        header("Location: http://localhost/shoesport/acceuil.php"); // Remplacez par la page appropriée
        exit();
    }
}

?>