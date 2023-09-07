<?php

    session_start();
        require_once ('db.php');    
                 // Requête SQL à exécuter
    $sql = "SELECT ID_PRODUIT, Nom, Prix, Couleur FROM produit";
    
    // Préparation de la première requête
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Récupération des résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>