<?php
session_start();
// Vérification des identifiants de l'utilisateur
// ...
// Validation de la connexion
$_SESSION['utilisateur_id'] = $id_utilisateur; // $id_utilisateur est l'ID de l'utilisateur connecté
?>