<?php
session_start();
if (isset($_SESSION['ID_UTILISATEUR'])) {
    echo $_SESSION['ID_UTILISATEUR'];
} else {
    echo 'Utilisateur non connecté';
}
?>