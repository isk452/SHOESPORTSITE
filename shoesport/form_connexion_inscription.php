<!DOCTYPE html>
<?php
session_start();
// Inclure le fichier de connexion à la base de données
require_once "C:\wamp64\www\shoesport\db.php";

// ... le reste de votre code ...

// Vérification de la connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... le reste de votre code ...
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["connexion"])) {
        // Traitement du formulaire de connexion
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        
        // Assurez-vous de valider et nettoyer les données avant de les utiliser
        // ...

        // Requête SQL pour obtenir les informations de l'utilisateur basées sur l'adresse e-mail
        $sql = "SELECT id, nom_et_prenom, mot_de_passe FROM utilisateurs WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
            // L'utilisateur a fourni des informations valides
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nom_et_prenom'];
            header("Location: accueil.php"); // Redirigez vers la page d'accueil après la connexion
            exit();
        } else {
            echo "Identifiants invalides. Veuillez réessayer.";
        }
    } elseif (isset($_POST["inscription"])) {
        // Traitement du formulaire d'inscription
        $nom_et_prenom = $_POST["nom_et_prenom"];
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        $verifmdp = $_POST["verifmdp"];
        $adresse = $_POST["adresse"];
        
        // Assurez-vous de valider et nettoyer les données avant de les utiliser
        // ...

        // Vérification du mot de passe
        if ($mdp !== $verifmdp) {
            echo "Les mots de passe ne correspondent pas.";
        } else {
            // Hacher le mot de passe
            $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
            
            // Requête SQL pour insérer les données dans la table 'utilisateurs'
            $sql = "INSERT INTO utilisateurs (nom_et_prenom, email, mot_de_passe) VALUES (:nom_et_prenom, :email, :mdp)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom_et_prenom', $nom_et_prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mdp', $mdp_hash);
            
            
            // Exécution de la requête
            $stmt->execute();
            
            echo "Inscription réussie !";
            
            // Rediriger l'utilisateur après l'inscription
            header("Location:acceuil.php"); // Remplacez par la page appropriée
            exit();
        }
    }
}
?>


<html>

<head>

<link rel="stylesheet" href="css/formulaire.css">
<link rel="stylesheet" href="css/combined-styles.css">
<script src="js/veriform.js"></script>
<?php require_once('header.php'); ?>
<?php require_once('db.php'); ?>
<?php require_once('db-formulaireconn.php'); ?>

    <meta charset='UTF-8'>
    <title>Formulaire de connexion/inscription</title>
    <style>

        body {
            background-color: black;
            color: #ffa600;
            font-family: Arial, sans-serif;
        }

        .container1 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffa600;
            color: black;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: black;
            color: #ffa600;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #ffa600;
            color: black;
        }

        button[type="button"] {
            background-color: transparent;
            border: none;
            color: #ffa600;
            cursor: pointer;
        }

        button[type="button"]:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container1">
        <div class="form-container sign-up-container">
            <form name="monpremierFormulaire" method="POST" action="" onsubmit="return validerFormulaire()"
                id="formulaire">
                <h1>Créer un compte</h1>
                <input type="text" name="nom_et_prenom" placeholder="Nom et Prénom" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <input type="password" name="verifmdp" placeholder="Confirmer Mot de passe" required>
                <label for="adresse">Adresse :</label>
                <textarea id="adresse" name="adresse" required></textarea>
                <button type="submit">M'inscrire</button>
            </form>
        </div>
        <button type="button" onclick="afficherContenu()">J'ai déjà un compte</button>
        <div id="contenu" style="display:none">
            <div class='container2'>
                <form name='mondeuxiemeform' action="" method="post">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required><br><br>
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" required><br><br>
                    <input type="submit" name="connexion" id="connexion" class="btn btn-primary" value="Connexion">
                </form>
            </div>
        </div>
    </div>
    <script>
        function afficherContenu() {
            document.getElementById("contenu").style.display = "block";
        }
    </script>
</body>

</html>
