<?php
$host = "localhost";
$dbname = "shoesport";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=localhost;dbname=shoesport", "root", "");

if ($conn->errorCode() !== null) {
    die("Connexion échouée : " . implode(" - ", $conn->errorInfo()));
}

$nom_et_prenom = $_POST['nom_et_prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

if ($mdp_hash === false) {
    die("Hachage du mot de passe échoué.");
}

$sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mdp)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nom', $nom_et_prenom);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':mdp', $mdp_hash);

if ($stmt->execute()) {
    header("Location: C:\wamp64\www\shoesport\css\confirmation_inscription.php");
    exit();
} else {
    echo "Erreur : " . implode(" - ", $stmt->errorInfo());
    exit();
}

$conn = null;
?>

