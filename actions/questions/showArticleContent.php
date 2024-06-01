<?php

require('actions/database.php');

if (isset($_GET['id']) AND !empty($_GET['id'])){

    $idQuestion = $_GET['id'];
    $checkQuestion = $connexion->prepare('SELECT * FROM questions WHERE id =?');
    $checkQuestion->execute(array($idQuestion));

    if ($checkQuestion->rowCount() > 0){

        $questionsInfos = $checkQuestion->fetch();

        $title = $questionsInfos['titre'];
        $contenu = $questionsInfos['contenu'];
        $surnom = $questionsInfos['surnom'];
        $date_article = $questionsInfos['date'];
        $heure_article = $questionsInfos['heure'];
    } else {
        $errorMsg = "Aucune question n'a été trouvée";
    }

} else {
    $errorMsg = "Aucune question n'a été trouvée"; 
}