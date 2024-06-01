<?php
require('actions/database.php');

$allAnswer = $connexion->prepare('SELECT auteur, surnom_auteur, id_question, contenu, date, heure FROM answers WHERE id_question =? ORDER BY id DESC');
$allAnswer->execute(array($idQuestion));
