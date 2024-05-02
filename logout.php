<?php
session_start();

// Détruit toutes les données de session
$_SESSION = array();

// Supprime le cookie de session s'il existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Détruit la session actuelle
session_destroy();

// Redirige vers la page de connexion ou une autre page de votre choix
header("Location: connection.php");
exit();
?>
