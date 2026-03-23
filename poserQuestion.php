<?php 
include('includes/head.php'); 
require('session.php');

?>

<body class="bg-light">
  <?php include('includes/navbar.php'); ?>

  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-7">

        <div class="mb-4">
          <h4 class="fw-bold mb-1">Nouvelle question</h4>
          <p class="text-muted small mb-0">
            Décrivez clairement votre problème pour obtenir de meilleures réponses
          </p>
        </div>

        <?php if (isset($_SESSION['erreur'])): ?>
          <div class="alert alert-danger"><?= $_SESSION['erreur'] ?></div>
        <?php endif;
        unset($_SESSION['erreur']); ?>
        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
        <?php endif;
        unset($_SESSION['success']); ?>

        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body p-4">
            <form action="requetes.php"" method="POST" class="needs-validation" novalidate>

              <div class="mb-3">
                <label for="title" class="form-label fw-semibold small">Titre</label>
                <input type="text" class="form-control" id="title" name="title"
                  placeholder="Ex. Comment gérer les sessions en PHP ?" required>
                <div class="invalid-feedback">Titre requis.</div>
              </div>


              <div class="mb-3">
                <label for="contenu" class="form-label fw-semibold small">Contenu détaillé</label>
                <textarea class="form-control" id="contenu" name="contenu"
                  rows="7"
                  placeholder="Décrivez en détail — code, messages d'erreur, ce que vous avez déjà essayé..."
                  required></textarea>
                <div class="invalid-feedback">Contenu requis.</div>
              </div>

              <div class="d-grid">
                <button class="btn btn-primary fw-semibold" name="poserQuestion" type="submit">
                  Publier la question
                </button>
              </div>

            </form>
          </div>
        </div>

        <div class="alert alert-info border-0 small">
          <strong>Conseils :</strong>
          Titre précis · Inclure le code et l'erreur exacte ·
          Mentionner ce que vous avez déjà essayé · Préciser le langage et la version
        </div>

      </div>
    </div>
  </div>

  <?php include('includes/footer.php') ?>

  <script>
    (() => {
      'use strict'
      document.querySelectorAll('.needs-validation').forEach(form => {
        form.addEventListener('submit', e => {
          if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>

</body>

</html>