<?php
session_start();
require("actions/database.php");

if (isset($_POST["valide"])) {
    $surnom = htmlspecialchars($_POST["surnom"]);
    $mdp = htmlspecialchars($_POST["mdp"]);

    if (!empty($_POST["surnom"]) and !empty($_POST["mdp"])) {

        $requete_check = $connexion->prepare('SELECT * FROM users WHERE surnom=?');
        $requete_check->execute(array($surnom));
        $users_infos = $requete_check->fetch();
        if ($requete_check->rowCount() > 0) {
            if (password_verify($mdp, $users_infos['mdp'])) {
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $users_infos['id'];
                $_SESSION['nom'] = $users_infos['nom'];
                $_SESSION['surnom'] = $users_infos['surnom'];
                $_SESSION['photo'] = $users_infos['photo'];

                header('Location: index.php');
            } else{
                $errorMsg = 'Votre mot de passe est incorrect!';
            }

        } else {
            $errorMsg = "Ce surnom n'existe pas!";
        }
    } else {
        $errorMsg = "Veuillez remplir tous les chapms...";
    }
}
