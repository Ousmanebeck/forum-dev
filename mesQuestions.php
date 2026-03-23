<?php
include('includes/head.php');
require("basededonnee.php");
require('session.php');


$requete_get = $connexion->prepare("SELECT * FROM questions WHERE utilisateur_id=? ORDER BY id DESC");
$requete_get->execute([$_SESSION['utilisateur']['id']]);
?>

<body class="bg-light">
  <?php include('includes/navbar.php'); ?>

  <div class="container py-4">

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
      <div>
        <h4 class="fw-bold mb-0">Mes questions</h4>
      </div>
      <a href="poserQuestion.php" class="btn btn-primary btn-sm fw-semibold">
        Nouvelle question
      </a>
    </div>

    <hr class="my-3">

    <?php
    $n = 0;
    while ($q = $requete_get->fetch()):
      $n++;
    ?>
      <div class="card border-0 shadow-sm mb-3 border-start border-primary border-3">
        <div class="card-body py-3 px-4">
          <a href="article.php?id=<?= $q['id'] ?>" class="text-decoration-none">
            <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($q['titre']) ?></h6>
          </a>
          <p class="text-muted small mb-3" style="display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden;">
            <?= substr($q['contenu'], 0, 150) ?>
          </p>
          <div class="d-flex gap-2 flex-wrap">
            <a href="laQuestion.php?id=<?= $q['id'] ?>" class="btn btn-outline-secondary btn-sm">
              Voir
            </a>
            <a href="modifierQuestion.php?id=<?= $q['id'] ?>" class="btn btn-outline-warning btn-sm">
              Modifier
            </a>
            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $q['id'] ?>">
              Supprimer
            </button>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deleteModal<?= $q['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $q['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form action="requetes.php" method="POST">
              <input type="hidden" name="idQuestion" value="<?= $q['id'] ?>">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel<?= $q['id'] ?>">
                  <i class="bi bi-exclamation-triangle-fill me-2"></i>
                  Confirmer la suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
              </div>
              <div class="modal-body">
                <p class="mb-2">Êtes-vous sûr de vouloir supprimer définitivement cette question ?</p>
                <p class="text-danger small mb-0">
                  <strong>Attention :</strong> Cette action est irréversible. Toutes les réponses associées seront également supprimées.
                </p>
                <hr>
                <p class="mb-0">
                  <strong>Question :</strong>
                  <span class="text-primary"><?= htmlspecialchars($q['titre']) ?></span>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" name="supprimerQuestion" class="btn btn-danger">Supprimer définitivement</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endwhile; ?>

    <?php if ($n === 0): ?>
      <div class="text-center py-5">
        <h5 class="fw-bold">Aucune question publiée</h5>
        <p class="text-muted small">Vous n'avez encore posé aucune question.</p>
        <a href="poserQuestion.php" class="btn btn-primary mt-2">
          Poser ma première question
        </a>
      </div>
    <?php endif; ?>

  </div>

  <?php include('includes/footer.php') ?>

</body>
</html>