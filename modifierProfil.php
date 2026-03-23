<?php
include('includes/head.php');
require('basededonnee.php');
require('session.php');



if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];

  if ($id != $_SESSION['utilisateur']['id']) {
    $_SESSION['erreur'] = "Vous n'êtes pas autorisé à modifier ce profil";
    header('location: profil.php?id=' . $_SESSION['utilisateur']['id']);
    exit();
  }

  $verifierUtilisateur = $connexion->prepare('SELECT nom, email FROM utilisateurs WHERE id = ?');
  $verifierUtilisateur->execute(array($id));

  if ($verifierUtilisateur->rowCount() > 0) {
    $infos = $verifierUtilisateur->fetch();
    $nom = $infos['nom'];
    $email = $infos['email'];
  } else {
    $_SESSION['erreur'] = "Utilisateur non trouvé";
    header('location: profil.php?id=' . $_SESSION['utilisateur']['id']);
    exit();
  }
} else {
  $_SESSION['erreur'] = "Aucun utilisateur spécifié";
  header('location: profil.php?id=' . $_SESSION['utilisateur']['id']);
  exit();
}
?>

<body class="bg-light">
  <?php include('includes/navbar.php'); ?>

  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">

        <div class="mb-4">
          <h4 class="fw-bold mb-1">Modifier le profil</h4>
          <p class="text-muted small mb-0">Mettez à jour vos informations</p>
        </div>

       <?php if (isset($_SESSION['erreur'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['erreur'] ?></div>
        <?php endif;
        unset($_SESSION['erreur']); ?>
        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
        <?php endif;
        unset($_SESSION['success']); ?>


        <?php if (isset($email)): ?>
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <form action="requetes.php" method="POST" class="needs-validation" novalidate>

                <div class="mb-3">
                  <label for="nom" class="form-label fw-semibold small">Nom</label>
                  <input type="text" class="form-control" id="nom" name="nom"
                    value="<?= htmlspecialchars($nom) ?>" required>
                  <div class="invalid-feedback">Nom requis.</div>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label fw-semibold small">Email</label>
                  <input type="email" class="form-control" id="email" name="email"
                    value="<?= htmlspecialchars($email) ?>" required>
                  <div class="invalid-feedback">Email requis.</div>
                </div>

                <div class="d-flex gap-2">
                  <button class="btn btn-primary fw-semibold" type="submit" name="modifierProfil">
                    Enregistrer
                  </button>
                  <a href="profil.php?id=<?= $_SESSION['utilisateur']['id'] ?>" class="btn btn-outline-secondary">
                    Annuler
                  </a>
                </div>

              </form>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>

  <script>
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })();
  </script>

</body>

</html>