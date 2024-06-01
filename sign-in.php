<?php require('actions/users/signinAction.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>
<body>
  <?php include('includes/navbar.php'); ?>
  <main class="form-signin w-100 m-auto">
    <form method="post" class="needs-validation" style="margin-top: 200px" novalidate>
      <h1 class="h3 mb-3 fw-normal text-center">Se connecter</h1>
      <?php
      if (isset($errorMsg)) {
        echo '<p class="alert alert-danger">' . $errorMsg . '</p>';
      }
      ?>
      <div class="form-floating">
        <input type="text" class="form-control" id="surnom" name="surnom" placeholder="Surnom" required>
        <label class="form-label" for="surnom">Surnom</label>
        <div class="invalid-feedback">
          Surnom requis.
        </div>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Password" required>
        <label class="form-label" for="mdp">Mot de passe</label>
        <div class="invalid-feedback">
          Mot de passe requis.
        </div>
      </div>

      <div class="form-check text-start my-2">
      </div>
      <button class="btn btn-primary w-100 py-2" name="valide" type="submit">Se connecter</button>
      <a href="register.php" data-moz-translations-id="0">
        <p class="mt-5 mb-3 text-body-primary">Pas inscrit?</p>
      </a>
      <p class="mt-5 mb-3 text-body-secondary">&copy; 2024 Alcatraz</p>
    </form>
  </main>
  <script src="js/checkout.js"></script>
</body>

</html>