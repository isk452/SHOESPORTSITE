<html>

<head>
    <meta charset='UTF_8'>
    <link rel="stylesheet" href="css/pagepersonnelle.css">
    <link rel="stylesheet" href="css/combined-styles.css">
    <title>page perso</title>
</head>

<header>
    <?php require_once ('header.php')?>
</header>

<body>
    <?php
    // Récupération de l'ID depuis l'URL
    $id_utilisateur = $_GET['id'];
    require_once ('db.php');

// Établir une connexion à la base de données
try {
  $pdo = new PDO("mysql:host=localhost;dbname=proshoes", 'root', '');
  // activer le mode d'erreur pour avoir des rapports d'erreurs détaillés
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Erreur de connexion : " . $e->getMessage();
}

// Requête pour récupérer les informations de l'utilisateur 

$sql = "SELECT * FROM utilisateurs WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id_utilisateur);
$stmt->execute();
$info_utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
$nom_utilisateur = $info_utilisateur['Nom'];
$email_utilisateur = $info_utilisateur['Email'];
$adresse_utilisateur = $info_utilisateur['Adresse'];

// Vérification de l'existence de l'utilisateur
$sql = "SELECT * FROM utilisateurs WHERE id=:id AND Email=:Email AND Nom=:Nom AND Adresse=:Adresse";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id_utilisateur);
$stmt->bindParam(':Nom', $nom_utilisateur);
$stmt->bindParam(':Email', $email_utilisateur);
$stmt->bindParam(':Adresse', $adresse_utilisateur);
$stmt->execute();

// Vérification du nombre de lignes retournées
if ($stmt->rowCount() == 1) {
    // L'utilisateur existe, affichage de ses informations
    $info_utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // ... autres informations spécifiques à l'utilisateur
} else {
    // L'utilisateur n'existe pas ou l'ID est invalide
    echo "Utilisateur introuvable.";
    // Ajout d'un message d'erreur pour obtenir plus d'informations sur la raison pour laquelle l'utilisateur n'a pas été trouvé
    $errorInfo = $stmt->errorInfo();
    echo "<p>Erreur: " . $errorInfo[2] . "</p>";
}

            // Affichage les éléments 
    // Affichage des éléments 
    echo "<div class='elements'>";
    echo "<p>Nom : " . $nom_utilisateur . "</p>";
    echo "<p>Email : " . $email_utilisateur . "</p>";
    echo "<p>Adresse : " . $adresse_utilisateur . "</p>";
    echo '<br>';
    echo '<a href="modif.php?id=' . $id_utilisateur . '">Modifier mes informations</a>';
    echo "</div>";    
  
    // Fermeture de la connexion à la base de données
    $pdo = null;
    ?>
    <a href="deconnexion.php">Déconnexion</a>

</body>

</html>