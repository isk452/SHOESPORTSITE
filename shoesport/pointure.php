        <html>

        <body>


        </body>

        </html>



        <?php

$id_produit = $_POST['ID_PRODUIT']; // récupère l'ID du produit à partir du formulaire soumis par l'utilisateur

$pdo = new PDO('mysql:host=localhost;dbname=proshoes', 'root', '');

$sql = "SELECT Pointures, SUM(quantité_disponible) AS quantité_disponible
        FROM Pointures
        WHERE ID_PRODUIT = :id_produit
        GROUP BY Pointures";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_produit', $id_produit);
$stmt->execute();
$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>