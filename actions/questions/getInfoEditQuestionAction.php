<?php

require('actions/database.php');

if (isset($_GET['id']) and !empty($_GET['id'])) {

  $idQuestion = $_GET['id'];

  $checkQuestion = $connexion->prepare('SELECT * FROM questions WHERE id =?');
  $checkQuestion->execute(array($idQuestion));

  if ($checkQuestion->rowCount() > 0) {

    $questionInfos = $checkQuestion->fetch();
    if ($questionInfos['auteur'] == $_SESSION['id']) {
      $title = $questionInfos['titre'];
      $description = $questionInfos['description'];
      $contenu = $questionInfos['contenu'];
      $date = $questionInfos['date'];
      $heure = $questionInfos['heure'];

      $description = str_replace('<br />', '', $description);
      $contenu = str_replace('<br />', '', $contenu);
    } else {
      $errorMsg = "Vous n'êtes pas l'auteur de cette question";
    }

  } else {
    $errorMsg = "Aucune question n'a été trouvée";
  }
} else {
  $errorMsg = "Aucune question n'a été trouvée";
}
