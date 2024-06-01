<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('Location: ../../login.php');
}
require('../database.php');
if (isset($_GET['id']) AND !empty($_GET['id'])){

    $idQuestion = $_GET['id'];

    $checkQuestion = $connexion->prepare('SELECT auteur FROM questions WHERE id=?');
    $checkQuestion->execute(array($idQuestion));

    if ($checkQuestion->rowCount() > 0){
        $userInfos = $checkQuestion->fetch();
        if($userInfos['auteur'] == $_SESSION['id']){
            $deleteQuestion = $connexion->prepare('DELETE FROM questions WHERE id=?');
            $deleteQuestion->execute(array($idQuestion));

            header('Location: ../../myQuestions.php');

        } else {
            $errorMsg = "Vous n'avez pas le droit de supprimer une question qui ne vous appartient pas!";
        }

    } else {
        $errorMsg = "Aucune question n'a été trouvée";
    }

} else {
    $errorMsg = "Aucune question n'a été trouvée";
}