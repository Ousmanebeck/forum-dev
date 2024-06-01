<?php
session_start();
require("actions/database.php");

if (isset($_POST["valide"])) {
    $nom = htmlspecialchars($_POST["nom"]);
    $surnom = htmlspecialchars($_POST["surnom"]);
    $email = htmlspecialchars($_POST["email"]);
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

    $requete_check = $connexion->prepare('SELECT surnom, email FROM users WHERE nom=? AND email=?');
    $requete_check->execute(array($nom, $email));

    if ($requete_check->rowCount() == 0) {
        $requete_insert = $connexion->prepare('INSERT INTO users(nom, surnom, email, mdp) VALUES (?, ?, ?, ?)');
        $requete_insert->execute(array($nom, $surnom, $email, $mdp));

        $requete_infos = $connexion->prepare('SELECT id, nom, surnom FROM users WHERE nom=? AND surnom=?');
        $requete_infos->execute(array($nom, $surnom));

        $users_infos = $requete_infos->fetch();

        $_SESSION['auth'] = true;
        $_SESSION['id'] = $users_infos['id'];
        $_SESSION['nom'] = $users_infos['nom'];
        $_SESSION['surnom'] = $users_infos['surnom'];
    } else {
        $errorMsg = "Ce surnom existe!";
    }

    $dossier = "upload/" . $_SESSION['id'] . "/";

    if (!is_dir($dossier)) {
        mkdir($dossier);
    }

    $fichier = basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) {
        if (file_exists("upload/".$idProfile.'/'.$_SESSION['image']) && isset($_SESSION['image'])){
            unlink("upload/".$idProfile.'/'.$_SESSION['image']);
        }

        $requete_insert = $connexion->prepare('UPDATE users SET photo=?');
        $requete_insert->execute(array($fichier));
        $_SESSION['image'] = $fichier;
        header('Location: index.php');
    } else {
        $errorMsg = "Erreur survenu lors d'enregistrement de photo!";
        
    }
}
