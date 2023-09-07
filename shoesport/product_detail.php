</html>

<head>
    <meta charset="UTF-8">
    <title>Détail produit</title>
    <link rel="stylesheet" href="css/prodetail.css">
    <link rel="stylesheet" href="css/combined-styles.css">

</head>
<header>
    <?php require_once ('header.php')?>
</header>

<?php
// Récupération de l'identifiant de produit depuis l'URL
$id_produit = $_GET['id'];

// Inclusion du fichier de configuration de la base de données
require_once 'db.php';
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=shoesport', 'root', '');

// Préparation de la requête
$sql = "SELECT * FROM produit WHERE ID_PRODUIT = :ID_PRODUIT";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':ID_PRODUIT', $id_produit);

// Exécution de la requête
$stmt->execute();

// Récupération des résultats
$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

try {
    //CONNEXION
    $sql = "SELECT * FROM `produit` WHERE ID_PRODUIT = :ID_PRODUIT";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ID_PRODUIT', $id_produit);
    $stmt->execute();
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    
    }
 catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
// Fermeture de la connexion à la base de données
$pdo = null;
?>

<body>
<div class="fullscreenimage">
<img src="imageacceuil/imagevitrine2.jpg" class="cc">
</div>
    <main>
        <section class="product-details">
            <div class="product-info">
                <h2><?php echo $produit['Nom']; ?></h2>
                <img class="imageproduit" src="imagesboutique/<?php echo $produit['ID_PRODUIT']; ?>.jpeg"
                    alt="<?php echo $produit['Nom']; ?>">

                <p><?php echo $produit['Details']; ?></p>
                <p><?php echo $produit['Prix']; ?></p>
                <p><?php echo $produit['Couleur']; ?></p>

            </div>

            <?php
 if (isset($_SESSION['id_utilisateur'])) {
     // L'utilisateur est connecté
     echo '<a href="ajoutpanier.php?id=' . $id_produit . '"  onclick="return confirm(\'Produit ajouté au panier\')">Ajouter au panier</a>';
 } else {
     echo '<a href="form_connexion_inscription.php">Ajouter au panier</a>';
 }

                ?>
            <?php  echo "<a href='panier.php'>aller au panier</a>";
        

           $var= $_SESSION['ID_PRODUIT'];

           echo $var;
?>
<!-- À l'intérieur de la section "product-rating" existante -->
<section class="product-rating">
    <h3>Donner une note :</h3>
    <form action="enregistrer_note.php" method="post">
        <input type="hidden" name="produit_id" value="<?php echo $produit['ID_PRODUIT']; ?>">
        <select name="etoiles">
            <option value="1">1 étoile</option>
            <option value="2">2 étoiles</option>
            <option value="3">3 étoiles</option>
            <option value="4">4 étoiles</option>
            <option value="5">5 étoiles</option>
        </select>
        <input type="submit" value="Noter">
    </form>
</section>


    </main>

</body>

</html>