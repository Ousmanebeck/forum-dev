<?php

if (!isset($_SESSION['utilisateur']) || !isset($_SESSION['utilisateur']['id'])) {
    $_SESSION['erreur'] = "Vous devez être connecté";
    header('location: connexion.php');
    exit();
}