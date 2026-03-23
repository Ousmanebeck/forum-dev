<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>
<body class="bg-light align-items-center min-vh-100">
<?php include("includes/navbar.php"); ?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-sm-10 col-md-6 col-lg-5 col-xl-4">

      <div class="card border-0 shadow-sm rounded-3 p-2">
        <div class="card-body p-4">

          <div class="d-flex align-items-center gap-2 mb-4">
            <span class="badge fw-bold bg-primary fs-6 px-3 py-2">Forum Dev</span>
          </div>

          <h4 class="fw-bold mb-1">Bienvenue</h4>
          <p class="text-muted small mb-4">Connectez-vous pour continuer</p>

           <?php if (isset($_SESSION['erreur'])): ?>
              <div class="alert alert-danger py-2 small"><?= $_SESSION['erreur'] ?></div>
            <?php endif;
            unset($_SESSION['erreur']); ?>

          <form action="requetes.php" method="POST" class="needs-validation" novalidate>

            <div class="mb-3">
              <label for="email" class="form-label fw-semibold small">Adresse mail</label>
              <input type="email"
                     class="form-control"
                     id="email"
                     name="email"
                     placeholder="Adresse mail"
                     required
                     autocomplete="email">
              <div class="invalid-feedback">Adresse mail requis.</div>
            </div>

            <div class="mb-3">
              <label for="mdp" class="form-label fw-semibold small">Mot de passe</label>
              <input type="password"
                     class="form-control"
                     id="mdp"
                     name="mdp"
                     placeholder="Mot de passe"
                     required
                     autocomplete="current-password">
              <div class="invalid-feedback">Mot de passe requis.</div>
            </div>

            <div class="d-grid mt-4">
              <button type="submit" name="connexion" class="btn btn-primary fw-semibold">
                Se connecter
              </button>
            </div>

          </form>

          <p class="text-center text-muted small mt-4 mb-0">
            Pas encore inscrit ?
            <a href="inscription.php" class="text-primary fw-semibold">Créer un compte</a>
          </p>

        </div>
      </div>

    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
