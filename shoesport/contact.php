<html>

<head>
    <meta charset="UTF_8">
    <title>Formulaire de contact</title>
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/combined-styles.css">
</head>

<header>
    <?php require_once ('header.php')?>
    <? require_once ('db-contact.php')?>
</header>

<body>
    <div class="container">
        <form id="contact-form" method="post" action="db-contact.php" onsubmit="return validerFormulair2()">
            <h2>Contactez-nous</h2>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
            <div id="confirmation" style="display: none;">Formulaire envoyé avec succès !</div>
        </form>
    </div>
</body>

</html>