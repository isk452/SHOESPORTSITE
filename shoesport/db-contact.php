<head>
    <meta charset='UTF_8'>
</head>

<header>
    <?php
    require_once ('header.php');
    require_once ('db.php'); ?>
</header>

<?php
try {
$dsn = "mysql:host=localhost;dbname=proshoes;charset=utf8mb4";
$username = "root";
$password = "";

} catch (PDOException $e) {
echo "Erreur de connexion à la base de données : " . $e->getMessage();
die();
}

// Récupérer les données du formulaire
$message = $_POST['message'];

if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: form_connexion_inscription.php");
    exit;
}

$id_utilisateur = $_SESSION['id_utilisateur'];

$stmt = $dbh->prepare("INSERT INTO message (message, id_utilisateur) VALUES (:message,
:id_utilisateur)");
$stmt->bindParam(':message', $message);
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$stmt->execute();

// Fermer la connexion à la base de données MySQL
$dbh = null;
header("Location: contact.php");

exit;

?>