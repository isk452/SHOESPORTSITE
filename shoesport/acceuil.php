<html>

<head>
    <meta charset="UTF_8">
    <link rel="stylesheet" href="css/combined-styles.css">
    <link rel="stylesheet" type="text/css" href="css/acceuil.css"> 
    <title>Shoesport</title>
    <script>
    $(document).ready(function() {
    $('#searchForm').submit(function(event) {
      event.preventDefault();
    var recherche = $('#recherche').val(); 

       $.ajax({
      url: 'rechercher.php',
      method: 'GET',
             data: { recherche: recherche },
                dataType: 'html',
                success: function(response) {
                    $('.container-flex').html(response);
                },
                error: function() {
                    alert("Une erreur s'est produite lors de la recherche.");
                }
                });
            });
            });
        </script>
</head>

<body>

    <header>
        <?php
    require_once ('header.php')?>
    </header>

</body>
<div class="fullscreenimage">
<img src="imageacceuil/imagevitrine2.jpg" class="cc">
</div>
</html>
<!DOCTYPE html>
<html>
<head>
  <title>Ma page avec barre de recherche</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php
// Votre code PHP peut être placé ici si nécessaire
?>

<div class="container">
  <form method="GET" action="rechercher.php">
    <input type="text" name="recherche" id="recherche" class="search-bar" placeholder="Rechercher...">
    <button class="btn-primary">Rechercher</button>
    </form>
</div>


</body>
</html>





