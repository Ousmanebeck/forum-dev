<?php 

require('actions/database.php');

$getQuestion = $connexion->query("SELECT id, auteur, titre, description, surnom, date, heure FROM questions ORDER BY id DESC LIMIT 0,5");

if (isset($_GET["search"]) AND !empty($_GET["search"])) {

    $userSearch = $_GET["search"];

    $getQuestion = $connexion->query('SELECT id, auteur, titre, description, surnom, date, heure FROM questions WHERE titre LIKE "%'.$userSearch.'%" ORDER BY id DESC');
}