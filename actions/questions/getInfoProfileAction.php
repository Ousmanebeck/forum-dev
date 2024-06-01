<?php

require('actions/database.php');

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $idProfile = $_GET['id'];
    $idPhoto = $_GET['photo'];

    $checkProfile = $connexion->prepare('SELECT * FROM users WHERE id =?');
    $checkProfile->execute(array($idProfile));

    if ($checkProfile->rowCount() > 0) {
        $profileInfos = $checkProfile->fetch();
        if ($profileInfos['id'] == $_SESSION['id']) {
            $nom = $profileInfos['nom'];
            $surnom = $profileInfos['surnom'];
            $email = $profileInfos['email'];
            $photo = $profileInfos['photo'];
        } else {
            $errorMsg = "Vous n'êtes pas l'auteur de cette profile";
        }
    } else {
        $errorMsg = "Aucune profile n'a été trouvée";
    }
} else {
    $errorMsg = "Aucune profile n'a été trouvée";
}
