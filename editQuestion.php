<?php
require('actions/users/securityAction.php');
require('actions/questions/getInfoEditQuestionAction.php');
require('actions/questions/editQuestionAction.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body>
  <?php include('includes/navbar.php'); ?>
  <div class="container">
    <?php if (isset($errorMsg)) {
      echo '<p class="alert alert-danger">' . $errorMsg . '</p>';
    } ?>
    <?php
    if (isset($contenu)) {
    ?>
      <form method="post" class="needs-validation container" style="margin-top: 100px;" novalidate>

        <h1 class="h3 mb-3 fw-normal text-center">Modifier la question</h1>
        <div class="mb-3">
          <label for="title" class="form-label">Titre de la question</label>
          <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>" required>
          <div class="invalid-feedback">
            Titre requis.
          </div>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description de la question</label>
          <textarea class="form-control" id="description" name="description" rows="3" required><?= $description ?></textarea>
          <div class="invalid-feedback">
            Description requise.
          </div>
        </div>
        <div class="mb-3">
          <label for="contenu" class="form-label">Contenu de la question</label>
          <textarea class="form-control" id="contenu" name="contenu" rows="3" required><?= $contenu ?></textarea>
          <div class="invalid-feedback">
            Contenu requis.
          </div>
        </div>
        <div class="form-check text-start my-2">
        </div>
        <button class="btn btn-primary w-100 py-2" name="valide" type="submit">Modifier la question</button>
      </form>
    <?php
    }
    ?>

  </div>
  <script src="js/checkout.js"></script>
</body>

</html>