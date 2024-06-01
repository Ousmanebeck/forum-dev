<?php

require('actions/database.php');

if (isset($_POST['valide'])) {
    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['contenu'])){

        $new_title =  htmlspecialchars($_POST['title']);
        $new_description = nl2br(htmlspecialchars($_POST['description']));
        $new_contenu = nl2br(htmlspecialchars($_POST['contenu']));


        $requete_insert = $connexion->prepare('UPDATE questions SET titre=?, description=?, contenu=? WHERE id=?');
        $requete_insert->execute(array($new_title, $new_description, $new_contenu, $idQuestion));
        
        header('Location: myQuestions.php');
    } else {
        $errorMsg = 'Veuillez compléter tous les champs...';
    }
}