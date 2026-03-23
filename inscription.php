<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body class="bg-light align-items-center min-vh-100">

  <?php include("includes/navbar.php"); ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-sm-10 col-md-7 col-lg-6 col-xl-5">

        <div class="card border-0 shadow-sm rounded-3 p-2">
          <div class="card-body p-4">

            <div class="d-flex align-items-center gap-2 mb-4">
              <span class="badge fw-bold bg-primary fs-6 px-3 py-2">Forum Dev</span>
            </div>

            <h4 class="fw-bold mb-1">Créer un compte</h4>
            <p class="text-muted small mb-4">Rejoignez la communauté de développeurs</p>

            <?php if (isset($_SESSION['erreur'])): ?>
              <div class="alert alert-danger py-2 small"><?= $_SESSION['erreur'] ?></div>
            <?php endif;
            unset($_SESSION['erreur']); ?>

            <form action="requetes.php" method="POST" class="needs-validation" novalidate>


              <div class="mb-3">
                <label for="nom" class="form-label fw-semibold small">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom"
                  placeholder="Nom" required>
                <div class="invalid-feedback">Nom requis.</div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label fw-semibold small">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                  placeholder="nom@gmail.com" required>
                <div class="invalid-feedback">Email requis.</div>
              </div>

              <div class="mb-3">
                <label for="mdp" class="form-label fw-semibold small">Mot de passe</label>
                <input type="password" class="form-control" minlength="6" id="mdp" name="mdp"
                  placeholder="Minimum 6 caractères" required>
                <div class="invalid-feedback">Mot de passe requis.</div>
              </div>

              <div class="d-grid mt-4">
                <button type="submit" name="inscrire" class="btn btn-primary fw-semibold">
                  Créer le compte
                </button>
              </div>

            </form>

            <p class="text-center text-muted small mt-4 mb-0">
              Déjà inscrit ?
              <a href="connexion.php" class="text-primary fw-semibold">Se connecter</a>
            </p>

          </div>
        </div>

      </div>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>
  

</body>

</html>