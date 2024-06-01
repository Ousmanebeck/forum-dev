<?php

require('actions/database.php');

if (isset($_GET['id']) AND !empty($_GET['id'])) {

    $idUsers = $_GET['id'];

    $checkUsers = $connexion->prepare('SELECT nom, surnom, email, photo FROM users WHERE id =?');
    $checkUsers->execute(array($idUsers));

    if ($checkUsers->rowCount() > 0) {

        $userInfos = $checkUsers->fetch();

        $user_nom = $userInfos['nom'];
        $user_surnom = $userInfos['surnom'];
        $user_email = $userInfos['email'];
        $user_photo = $userInfos['photo'];

        

        $getQuestions = $connexion->prepare('SELECT *  FROM questions WHERE auteur = ? ORDER BY auteur DESC');
        $getQuestions->execute(array($idUsers));

    } else {
        $errorMsg = "Aucun utlisateur trouvé";
    }

} else {
    $errorMsg = "Aucun utlisateur trouvé";
}