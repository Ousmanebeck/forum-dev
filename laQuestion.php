<?php
include('includes/head.php');
require('basededonnee.php');
require('session.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['erreur'] = "Aucune question n'a été trouvée";
    header('location: mesQuestions.php');
    exit();
}

$questionId = $_GET['id'];

$reponses = $connexion->prepare('SELECT r.*, u.nom, u.id as user_id FROM reponses r JOIN utilisateurs u ON r.utilisateur_id = u.id WHERE r.question_id = ? ORDER BY r.date_creation DESC');
$reponses->execute([$questionId]);

$question = $connexion->prepare('SELECT q.*, u.nom FROM questions q JOIN utilisateurs u ON q.utilisateur_id = u.id WHERE q.id = ?');
$question->execute([$questionId]);

if ($question->rowCount() > 0) {
    $questionInfos = $question->fetch();
} else {
    $_SESSION['erreur'] = "Aucune question n'a été trouvée";
    header('location: mesQuestions.php');
    exit();
}
?>

<body class="bg-light">
    <?php include('includes/navbar.php'); ?>

    <div class="container py-4">

        <?php if (isset($_SESSION['erreur'])): ?>
            <div class="alert alert-danger py-2 small"><?= $_SESSION['erreur'] ?></div>
            <?php unset($_SESSION['erreur']); ?>
        <?php endif; ?>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3"><?= htmlspecialchars($questionInfos['titre']) ?></h4>
                <div class="text-secondary" style="line-height:1.8;"><?= nl2br($questionInfos['contenu']) ?></div>
                 <div class="d-flex align-items-center gap-2 small text-muted bg-light rounded px-3 py-2 mb-4 flex-wrap">
                    <span>Par <a href="profile.php?id=<?= $questionInfos['utilisateur_id'] ?>" class="text-primary fw-semibold text-decoration-none">@<?= htmlspecialchars($questionInfos['nom']) ?></a></span>
                    <span>·</span>
                    <span><?= date('d/m/Y H:i:s', strtotime($questionInfos['date_creation'])) ?></span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold text-muted text-uppercase small letter-spacing-1 mb-3">Votre réponse</h6>
                <form action="requetes.php" method="post">
                    <input type="hidden" name="idQuestion" value="<?= $questionId ?>">
                    <div class="mb-3">
                        <textarea
                            name="reponses"
                            class="form-control"
                            rows="5"
                            placeholder="Partagez votre solution ou votre point de vue..."></textarea>
                    </div>
                    <button name="reponse" class="btn btn-primary fw-semibold">
                        Publier la réponse
                    </button>
                </form>
            </div>
        </div>

        <h6 class="fw-bold text-muted text-uppercase small mb-3">Réponses</h6>

        <?php
        $n = 0;
        while ($reponse = $reponses->fetch()):
            $n++;
        ?>
            <div class="card border-0 shadow-sm mb-3 bg-white">
                <div class="card-body px-4 py-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold">
                            @<?= htmlspecialchars($reponse['nom']) ?>
                        </span>
                        <span class="badge bg-secondary bg-opacity-10 text-secondary small fw-normal">
                            réponse
                        </span>
                    </div>
                    <p class="text-secondary mb-2" style="line-height:1.7;"><?= nl2br($reponse['contenu']) ?></p>
                    <small class="text-muted">
                        Repondu par <a href="profil.php?id=<?= $reponse['utilisateur_id'] ?>" class="text-decoration-none text-primary">@<?= htmlspecialchars($reponse['nom']) ?></a>
                        · <?= date('d/m/Y H:i:s', strtotime($reponse['date_creation'])) ?>
                    </small>
                </div>
            </div>
        <?php endwhile; ?>

        <?php if ($n === 0): ?>
            <div class="text-center py-4 text-muted">
                <p class="small mb-0">Aucune réponse pour l'instant. Soyez le premier à répondre !</p>
            </div>
        <?php endif; ?>

    </div>

    <?php include('includes/footer.php') ?>

</body>
</html>