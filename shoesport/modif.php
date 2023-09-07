<head>
    <meta charset="UTF_8">
    <link rel="stylesheet" href="css/modif.css">
    <link rel="stylesheet" href="css/combined-styles.css">
</head>

<body>
    <?php 
$id = $_GET['id'];
?>

    <?php 
require_once ('header.php');
?>
    <div>
        <form action="" method="POST">
            <label for="Nom">Nom :</label>
            <input type="text" name="Nom" id="Nom" value="" />

            <label for="Adresse">Email :</label>
            <input type="text" name="Email" id="Email" value="" />

            <label for="Adresse">Adresse :</label>
            <input type="text" name="Adresse" id="Adresse" value="" />

            <input type="hidden" name="id" value="<?php echo $id; ?>" />

            <input type="submit" name="modifier" value="Modifier" />
        </form>

    </div>
    <?php
require_once ('db.php');

if(isset($_POST['modifier'])) {
  // Récupération des données du formulaire
  $nom = $_POST['Nom'];
  $email = $_POST['Email'];
  $adresse = $_POST['Adresse'];

  // Mise à jour de la ligne correspondante dans la table
  $pdo = new PDO("mysql:host=localhost;dbname=proshoes", "root", "");
  $stmt = $conn->prepare("UPDATE utilisateurs SET Nom = :Nom, Email = :Email, Adresse = :Adresse WHERE id = :id");
  $stmt->execute(array(':Nom' => $nom, ':Email' => $email, ':Adresse' => $adresse, ':id' => $id));
  
 echo "Modification confirmée";
 echo '<a href="panier.php?id=' . $id_utilisateur . '">Retourner au panier</a>';
  exit();
}
?>
    <footer>
    </footer>
</body>