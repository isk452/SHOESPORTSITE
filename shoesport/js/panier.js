function ajouterAuPanier() {
    // Récupérer les informations sur le produit depuis la page
    var nomProduit = "<?php echo $produit['Nom']; ?>";
    var detailsProduit = "<?php echo $produit['Details']; ?>";
    var couleurProduit = "<?php echo $produit['Couleur']; ?>";
    var pointureProduit = "<?php echo $produit['Pointure']; ?>";
    var prixProduit = "<?php echo $produit['Prix']; ?>";
    
    // Créer un objet JavaScript pour le produit
    var produit = {
      nom: nomProduit,
      details: detailsProduit,
      couleur: couleurProduit,
      pointure: pointureProduit,
      prix: prixProduit
    };
    
    // Récupérer le panier depuis le stockage local
    var panier = JSON.parse(localStorage.getItem('panier'));
    
    // Si le panier n'existe pas, créer une Map vide
    var panierMap = new Map(panier || []);
    
    // Vérifier si le produit est déjà dans le panier
    if (panierMap.has(nomProduit + couleurProduit + pointureProduit + prixProduit)) {
      alert("Ce produit est déjà dans le panier !");
      return;
    }

    // Ajouter le produit à la Map panier
    panierMap.set(nomProduit + couleurProduit + pointureProduit + prixProduit, produit);
    
    // Enregistrer le panier mis à jour dans le stockage local
    localStorage.setItem('panier', JSON.stringify(Array.from(panierMap.entries())));
    
    // Afficher un message de confirmation à l'utilisateur
    alert("Le produit a été ajouté au panier !");
}
