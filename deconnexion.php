<?php
session_start(); // Démarrez la session 

// Détruisez toutes les variables de session
$_SESSION = array();

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers la page d'accueil 
header("Location: accueil.php");
exit();
?>
