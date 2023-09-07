<html>

<head>
    <link rel="stylesheet" href="css/reductions.css">
    <meta charset="UTF-8">
    <title>Ma boutique en ligne</title>
</head>

<body>
    <?php require_once ('header.php')?>
    <main>
        <section class="produits">
            <h2>Nos produits</h2>
            <div class="produit">
                <img src="chemise.jpg" alt="Chemise" class="produit__image">
                <h3 class="produit__titre">Chemise en coton</h3>
                <p class="produit__description">Chemise en coton à manches courtes, disponible en plusieurs
                    couleurs.</p>
                <p class="produit__prix">49,99 €</p>
                <button class="produit__bouton-ajouter">Ajouter au panier</button>
            </div>
            <div class="produit">
                <img src="chaussures.jpg" alt="Chaussures" class="produit__image">
                <h3 class="produit__titre">Chaussures en cuir</h3>
                <p class="produit__description">Chaussures en cuir pour homme, disponible en plusieurs tailles.</p>
                <p class="produit__prix">99,99 €</p>
                <button class="produit__bouton-ajouter">Ajouter au panier</button>
            </div>
            <div class="produit">
                <img src="jupe.jpg" alt="Jupe" class="produit__image">
                <h3 class="produit__titre">Jupe en denim</h3>
                <p class="produit__description">Jupe en denim à taille haute, disponible en plusieurs tailles.</p>
                <p class="produit__prix">39,99 €</p>
                <button class="produit__bouton-ajouter">Ajouter au panier</button>
            </div>
        </section>
    </main>
</body>

</html>