<?php

require("actions/database.php");

if (isset($_POST["valide"])) {
    if (!empty($_POST["title"]) and !empty(trim($_POST["description"])) and !empty(trim($_POST["contenu"]))) {
        $title = htmlspecialchars($_POST["title"]);
        $description = nl2br(htmlspecialchars($_POST["description"]));
        $contenu = nl2br(htmlspecialchars($_POST["contenu"]));
        setlocale(LC_TIME, 'fr_FR.UTF-8');
        $date = strftime("%d/%B/%Y");
        $heure = date("H:i:s", strtotime('-1 hour'));
        $author = $_SESSION['id'];
        $surnom = $_SESSION['surnom'];

        $requete_insert = $connexion->prepare("INSERT INTO questions(titre, description, contenu, date, heure, auteur, surnom) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $requete_insert->execute(array($title, $description, $contenu, $date, $heure, $author, $surnom));
        $successMsg = "Votre question a bien été publiée sur le site";
    } else {
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}
