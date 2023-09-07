
    // Récupérer l'élément HTML pour afficher le panier
    var panierEl = document.getElementById("panier");

// Vérifier si le panier existe
if (panier && panier.length > 0) {
    // Sélectionner l'élément HTML pour afficher le panier
    var panierEl = document.getElementById("panier");

    // Parcourir tous les produits du panier
    for (var i = 0; i < panier.length; i++) {
        li.innerHTML =
            panier[i].nom +
            " - " +
            panier[i].couleur +
            " - Pointure: " +
            panier[i].pointure +
            " - Prix: " +
            panier[i].prix +
            " €";
        panierEl.appendChild(li);
    }
} else {
    // Afficher un message si le panier est vide
    var panierEl = document.getElementById("panier");
    panierEl.innerHTML = "Votre panier est vide.";
}