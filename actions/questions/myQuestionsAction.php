<?php
require("actions/database.php");
$requete_get = $connexion->prepare("SELECT id, titre, description FROM questions WHERE auteur=? ORDER BY id DESC");
$requete_get->execute(array($_SESSION['id']));