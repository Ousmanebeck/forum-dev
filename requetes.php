<?php
session_start();
require("session.php");


if (isset($_POST["inscrire"])) {

    if (empty($_POST["nom"]) || empty($_POST["email"]) || empty($_POST["mdp"])) {
        $_SESSION['erreur'] = "Tous les champs sont requis";
        header('Location: inscription.php');
        exit();
    }


    $nom = trim($_POST["nom"]);
    $email = $_POST["email"];
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);

    $requete = $connexion->prepare('SELECT email FROM utilisateurs WHERE email=?');
    $requete->execute([$email]);

    if ($requete->rowCount() == 0) {
        $requete = $connexion->prepare('INSERT INTO utilisateurs(nom, email, mdp) VALUES (?, ?, ?)');
        $requete->execute([$nom, $email, $mdp]);

        $dernier_id = $connexion->lastInsertId();

        $requete = $connexion->prepare('SELECT * FROM utilisateurs WHERE id=?');
        $requete->execute([$dernier_id]);

        $infos = $requete->fetch();

        $_SESSION['utilisateur'] = $infos;
        $_SESSION['success'] = "Inscription réussie !";
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['erreur'] = "Cet email existe déjà";
        header('Location: inscription.php');
        exit();
    }
}

if (isset($_POST["connexion"])) {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    if (empty($_POST["email"]) && empty($_POST["mdp"])) {
        $_SESSION['erreur'] = "Tous les champs sont requis";
        header('Location: connexion.php');
        exit();
    }

    $requete = $connexion->prepare('SELECT * FROM utilisateurs WHERE email=?');
    $requete->execute([$email]);
    $infos = $requete->fetch();
    if ($requete->rowCount() > 0) {
        if (password_verify($mdp, $infos['mdp'])) {
            $_SESSION['utilisateur'] = $infos;
            header('Location: index.php');
        } else {
            $_SESSION['erreur'] = 'Email ou mot de passe incorrect!';
            header('Location: connexion.php');
            exit();
        }
    } else {
        $_SESSION['erreur'] = 'Email ou mot de passe incorrect!';
        header('Location: connexion.php');
        exit();
    }
}


if (isset($_POST["poserQuestion"])) {

    if (empty($_POST["title"]) && empty(trim($_POST["contenu"]))) {
        $_SESSION['erreur'] = "Tous les champs sont requis";
        header('Location: poserQuestion.php');
        exit();
    }

    $title = $_POST["title"];
    $contenu = nl2br($_POST["contenu"]);

    $id = $_SESSION['utilisateur']['id'];

    $requete = $connexion->prepare("INSERT INTO questions(titre, contenu, utilisateur_id) VALUES (?, ?, ?)");
    $requete->execute(array($title, $contenu, $id));
    $_SESSION['success'] = "Votre question a bien été publiée sur le site";

    header('Location: poserQuestion.php');
    exit();
}

if (isset($_POST["modifierQuestion"])) {
    
    if (!isset($_POST['idQuestion']) || empty($_POST['idQuestion'])) {
        $_SESSION['erreur'] = "Question non identifiée";
        header('Location: mesQuestions.php');
        exit();
    }
    
    if (empty($_POST["title"]) || empty(trim($_POST["contenu"]))) {
        $_SESSION['erreur'] = "Tous les champs sont requis";
        header('Location: modifierQuestion.php?id=' . $_POST['idQuestion']);
        exit();
    }
    
    $idQuestion = $_POST['idQuestion'];
    $title = htmlspecialchars($_POST["title"]);
    $contenu = nl2br(htmlspecialchars($_POST["contenu"]));
    $utilisateurId = $_SESSION['utilisateur']['id'];
    
    $verifier = $connexion->prepare("SELECT utilisateur_id FROM questions WHERE id = ?");
    $verifier->execute([$idQuestion]);
    $question = $verifier->fetch();
    
    if (!$question || $question['utilisateur_id'] != $utilisateurId) {
        $_SESSION['erreur'] = "Vous n'êtes pas autorisé à modifier cette question";
        header('Location: mesQuestions.php');
        exit();
    }
    
    $requete = $connexion->prepare("UPDATE questions SET titre = ?, contenu = ? WHERE id = ?");
    $requete->execute(array($title, $contenu, $idQuestion));
    
    $_SESSION['success'] = "Votre question a bien été modifiée";
    header('Location: laQuestion.php?id=' . $idQuestion);
    exit();
}

if (isset($_POST['supprimerQuestion'])) {
    
    if (!isset($_POST['idQuestion']) || empty($_POST['idQuestion'])) {
        $_SESSION['erreur'] = "Question non identifiée";
        header('Location: mesQuestions.php');
        exit();
    }
    
    $idQuestion = $_POST['idQuestion'];
    $utilisateurId = $_SESSION['utilisateur']['id'];
    
    $verifier = $connexion->prepare("SELECT utilisateur_id FROM questions WHERE id = ?");
    $verifier->execute([$idQuestion]);
    $question = $verifier->fetch();
    
    if ($question && $question['utilisateur_id'] == $utilisateurId) {
        $supprimerReponses = $connexion->prepare("DELETE FROM reponses WHERE question_id = ?");
        $supprimerReponses->execute([$idQuestion]);
        
        $supprimerQuestion = $connexion->prepare("DELETE FROM questions WHERE id = ?");
        $supprimerQuestion->execute([$idQuestion]);
        
        $_SESSION['success'] = "Question supprimée avec succès";
    } else {
        $_SESSION['erreur'] = "Vous n'êtes pas autorisé à supprimer cette question";
    }
    
    header('Location: mesQuestions.php');
    exit();
}

if (isset($_POST['reponse'])) {

    if (empty($_POST['reponses'])) {
        $_SESSION['erreur'] = "la reponse est requis";
        header('Location: laQuestion.php?id=' . $_POST['idQuestion'] . '');
        exit();
    }

    $reponses = nl2br($_POST['reponses']);

    $requete = $connexion->prepare('INSERT INTO reponses(utilisateur_id, question_id, contenu) VALUES (?, ?, ?)');
    $requete->execute(array($_SESSION['utilisateur']['id'], $_POST['idQuestion'], $reponses));

    header('Location: laQuestion.php?id=' . $_POST['idQuestion'] . '');
    exit();
}


if (isset($_POST['modifierProfil'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);

    
    if (empty($nom) || empty($email)) {
        $_SESSION['erreur'] = "Tous les champs sont requis";
        header('location: modifierProfil.php?id=' . $_SESSION['utilisateur']['id']);
        exit();
    } 
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erreur'] = "Email invalide";
        header('location: modifierProfil.php?id=' . $_SESSION['utilisateur']['id']);
        exit();
    }
    
    $verifieEmail = $connexion->prepare('SELECT id FROM utilisateurs WHERE email = ? AND id != ?');
    $verifieEmail->execute([$email, $_SESSION['utilisateur']['id']]);
    
    if ($verifieEmail->rowCount() > 0) {
        $_SESSION['erreur'] = "Cet email est déjà utilisé par un autre compte";
        header('location: modifierProfil.php?id=' . $_SESSION['utilisateur']['id']);
        exit();
    }
    
    $requete = $connexion->prepare('UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?');
    $resultat = $requete->execute([$nom, $email, $_SESSION['utilisateur']['id']]);
    
    if ($resultat) {
        $_SESSION['utilisateur']['nom'] = $nom;
        $_SESSION['utilisateur']['email'] = $email;
        $_SESSION['success'] = "Profil mis à jour avec succès";
        header('location: profil.php?id=' . $_SESSION['utilisateur']['id']);
        exit();
    } else {
        $_SESSION['erreur'] = "Erreur lors de la mise à jour";
        header('location: profil.php?id=' . $_SESSION['utilisateur']['id']);
        exit();
    }
}
?>