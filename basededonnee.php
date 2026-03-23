<?php
try {
    $connexion = new PDO('mysql:host=localhost; dbname=forum; charset=utf8;', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (Exception $e) {
    echo 'Erreur:'. $e->getMessage();
}
