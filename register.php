<?php require("actions/users/registerAction.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
  <main class="form-signin w-100 m-auto">
    <form method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
      <h1 class="h3 mb-3 fw-normal text-center">S'inscrire</h1>
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <div id="image">
              <img src="" id="result" style="width:250px; height:250px; margin: -7px; padding: -7px; border-radius: 50%">
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
              <label class="text-center">Choisir une photo</label>
              <input type="file" id="photo" name="image" class="btn container" accept="image/*" onchange="gallerie();"/>
            </div>
          </div>
        </div>
      </div>
      <?php
      if (isset($errorMsg)) {
        echo '<p class="alert alert-danger">' . $errorMsg . '</p>';
      }
      ?>
      <div class="form-floating">
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
        <label class="form-label" for="nom">Nom</label>
        <div class="invalid-feedback">
          Nom requis.
        </div>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="surnom" name="surnom" placeholder="Surnom" required>
        <label class="form-label" for="prenom">Surnom</label>
        <div class="invalid-feedback">
          Surnom requis.
        </div>
      </div>

      <div class="form-floating">
        <input type="email" class="form-control" id="email" name="email" placeholder="nom@gmail.com" required>
        <label class="form-label" for="email">Adresse électronique</label>
        <div class="invalid-feedback">
          E-mail requis.
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
      <button class="btn btn-primary w-100 py-2" name="valide" type="submit">S'inscrire</button>
      <a href="sign-in.php" data-moz-translations-id="0">
        <p class="mt-5 mb-3 text-body-primary">Déjà inscrit?</p>
      </a>
      <p class="mt-5 mb-3 text-body-secondary">&copy; 2024 Alcatraz</p>
    </form>
  </main>
  <script type="text/javascript">
    function gallerie() {
      var reader = new FileReader();
      var file = document.getElementById('photo').files[0];
      reader.onload = function(e) {
        document.getElementById('result').src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  </script>
  <script src="js/checkout.js"></script>
</body>

</html>