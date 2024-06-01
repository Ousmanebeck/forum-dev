<?php

require('actions/database.php');

if (isset($_POST['valide'])){

    if (!empty($_POST['answer'])){
        $answer = nl2br(htmlspecialchars($_POST['answer']));

        setlocale(LC_TIME, 'fr_FR.UTF-8');
        $date = strftime("%d/%B/%Y");
        $heure = date("H:i:s", strtotime('-1 hour'));
        
        $requete_insert = $connexion->prepare('INSERT INTO answers(auteur, surnom_auteur, id_question, contenu, date, heure) VALUES (?, ?, ?, ?, ?, ?)');
        $requete_insert->execute(array($_SESSION['id'], $_SESSION['surnom'], $idQuestion, $answer, $date, $heure));
    }

}