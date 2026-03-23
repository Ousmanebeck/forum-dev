<?php
include('includes/head.php');
require('basededonnee.php');
require('session.php');


if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];

  $verifierUtilisateur = $connexion->prepare('SELECT * FROM utilisateurs WHERE id = ?');
  $verifierUtilisateur->execute(array($id));

  if ($verifierUtilisateur->rowCount() > 0) {
    $infos = $verifierUtilisateur->fetch();

    $id = $infos['id'];
    $nom = htmlspecialchars($infos['nom']);
    $email = htmlspecialchars($infos['email']);
    $date = $infos['date_creation'];

    $questions = $connexion->prepare('SELECT * FROM questions WHERE utilisateur_id = ? ORDER BY id DESC');
    $questions->execute(array($id));
  } else {
    $_SESSION['erreur'] = "Aucun utilisateur trouvé";
  }
} else {
  $_SESSION['erreur'] = "Aucun utilisateur trouvé";
}
?>

<body class="bg-light">
  <?php include('includes/navbar.php'); ?>

  <div class="container py-4">

    <?php if (isset($_SESSION['erreur'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['erreur'] ?></div>
    <?php endif;
    unset($_SESSION['erreur']); ?>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
    <?php endif;
    unset($_SESSION['success']); ?>

    <?php if (isset($nom)): ?>
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

          <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-3"
              style="width:72px;height:72px;flex-shrink:0;">
              <?= strtoupper(substr($nom, 0, 1)) ?>
            </div>
            <div>
              <h5 class="fw-bold mb-0"><?= $nom ?></h5>
              <div class="d-flex gap-2 flex-wrap">
                <span class="badge bg-primary bg-opacity-10 text-success border border-primary-subtle fw-semibold">
                  Membre actif depuis <?= date('d/m/Y H:m:s', strtotime($date)) ?>
                </span>
              </div>
            </div>
          </div>

          <table class="table table-sm table-borderless mb-0">
            <tbody>
              <tr>
                <td class="text-muted small fw-semibold text-uppercase" style="width:100px;">Nom</td>
                <td class="small"><?= $nom ?></td>
              </tr>
              <tr>
                <td class="text-muted small fw-semibold text-uppercase">Email</td>
                <td class="small"><?= $email ?></td>
              </tr>
            </tbody>
          </table>

          <?php if (isset($_SESSION['utilisateur']['id']) && $_SESSION['utilisateur']['id'] == $id): ?>
            <div class="mt-3">
              <a href="modifierProfil.php?id=<?= $_SESSION['utilisateur']['id'] ?>" class="btn btn-outline-secondary btn-sm">
                Modifier le profil
              </a>
            </div>
          <?php endif; ?>

        </div>
      </div>

      <h6 class="fw-bold text-muted text-uppercase small mb-3">Questions publiées</h6>

      <?php
      if ($questions && $questions->rowCount() > 0):
        while ($q = $questions->fetch()):
      ?>
          <div class="card border-0 shadow-sm mb-3 border-start border-primary border-3">
            <div class="card-body py-3 px-4">
              <a href="laQuestion.php?id=<?= $q['id'] ?>" class="text-decoration-none">
                <h6 class="fw-bold text-dark mb-1"><?= $q['titre'] ?></h6>
              </a>
              <p class="text-muted small mb-1" style="display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden;">
                <?= substr($q['contenu'], 0, 150) ?>...
              </p>
              <small class="text-muted"><?= date('d/m/Y H:i:s', strtotime($q['date_creation'])) ?></small>
            </div>
          </div>
        <?php
        endwhile;
      else:
        ?>
        <div class="text-center py-4 text-muted">
          <p class="small mb-0">Aucune question publiée pour le moment.</p>
        </div>
      <?php endif; ?>

    <?php endif; ?>
  </div>

  <?php include('includes/footer.php') ?>

</body>

</html>