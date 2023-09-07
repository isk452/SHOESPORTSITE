<head>
    <meta charset="UTF_8">
    <link rel="stylesheet" href="css/recap.css">
    <link rel="stylesheet" href="css/combined-styles.css">
</head>
<?php
        $id_utilisateur = $_GET['id']; ?>

<body>
    <?php
require_once ('header.php');
// Récupération des éléments du panier de l'utilisateur depuis la base de données
require_once ('db.php');
$pdo = new PDO("mysql:host=localhost;dbname=proshoes", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("SELECT id,  Nom, Adresse FROM utilisateurs WHERE id = ?");
$stmt->execute([$_SESSION['id_utilisateur']]);
$elements = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des éléments du panier
foreach ($elements as $element) {
  echo "<div class='panier-element'>";
  echo "<p>Nom : " . $element['Nom'] . "</p>";
  echo "<p>Adresse : " . $element['Adresse'] . "</p>";
  echo '<a href="acheter.php">Livrer a cette adresse</a>';
  echo '<br>';
  echo '<a href="modif.php?id=' . $id_utilisateur . '">Modifier</a>';

  echo "</div>";
} 
?>
</body>