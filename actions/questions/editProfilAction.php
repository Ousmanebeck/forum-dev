<?php
require('actions/database.php');

if (isset($_POST['valide'])) {
    if (!empty($_POST['nom']) && !empty($_POST['surnom']) && !empty($_POST['email'])) {

        $new_nom =  $_POST['nom'];
        $new_surnom = $_POST['surnom'];
        $new_email = $_POST['email'];


        $requete_check = $connexion->prepare('SELECT surnom FROM users WHERE nom=? AND email=?');
        $requete_check->execute(array($nom, $email));
        if ($requete_check != $new_surnom) {

            $requete_insert = $connexion->prepare('UPDATE users SET nom=?, surnom=?, email=? WHERE id=?');
            $requete_insert->execute(array($new_nom, $new_surnom, $new_email, $idProfile));
        } else {
            $errorMsg = "Ce surnom existe!";
        }
    } else {
        $errorMsg = 'Veuillez compléter tous les champs...';
    }

    $dossier = "upload/" . $_SESSION['id'] . "/";

    if (!is_dir($dossier)) {
        mkdir($dossier);
    }

    $fichier = basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) {
        if (file_exists("upload/" . $_SESSION['id'] . '/' . $_SESSION['image']) && isset($_SESSION['image'])) {
            unlink("upload/" . $_SESSION['id'] . '/' . $_SESSION['image']);
        }

        $requete_insert = $connexion->prepare('UPDATE users SET photo=?');
        $requete_insert->execute(array($fichier));
        $_SESSION['image'] = $fichier;
        header('Location: profile.php?id='.$_SESSION['id'].'');
    } else {
        $errorMsg = "Erreur survenu lors d'enregistrement de photo!";
    }
}
