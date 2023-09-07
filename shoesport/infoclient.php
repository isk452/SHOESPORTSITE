<?php 
require_once 'db.php'
?>

<head>
    <link rel="stylesheet" href="css/infoclient.css">
    <meta charset='UTF_8'>
    <script src="js/infoclient.js"></script>
</head>

<body>
    <form class="formulaire" method="POST" action="traitement.php">
        <h2>Formulaire de contact</h2>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="adresse">Adresse :</label>
        <textarea id="adresse" name="adresse" required></textarea>

        <button type="submit" action='traitement.php'>Envoyer</button>
    </form>

</body>