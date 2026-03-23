<?php
include('includes/head.php'); 
require('basededonnee.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['erreur'] = "Aucune question n'a été trouvée";
    header('location: mesQuestions.php');
    exit();
}  

$idQuestion = $_GET['id'];

$questions = $connexion->prepare('SELECT * FROM questions WHERE id = ?');
$questions->execute([$idQuestion]);

if ($questions->rowCount() > 0) {
    $questionInfos = $questions->fetch();
    
    if ($questionInfos['utilisateur_id'] != $_SESSION['utilisateur']['id']) {
        $_SESSION['erreur'] = "Vous n'êtes pas l'auteur de cette question";
        header('location: mesQuestions.php');
        exit();
    }
    
    $title = $questionInfos['titre'];
    $contenu = $questionInfos['contenu'];
    $contenu = str_replace('<br />', "\n", $contenu);
    
} else {
    $_SESSION['erreur'] = "Aucune question n'a été trouvée";
    header('location: mesQuestions.php');
    exit();
}
?>
<body class="bg-light">
<?php include('includes/navbar.php'); ?>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-7">

      <div class="mb-4">
        <h4 class="fw-bold mb-0">Modifier la question</h4>
      </div>

      <?php if (isset($_SESSION['erreur'])): ?>
        <div class="alert alert-danger py-2 small"><?= htmlspecialchars($_SESSION['erreur']) ?></div>
        <?php unset($_SESSION['erreur']); ?>
      <?php endif; ?>

      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <form action="requetes.php" method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="idQuestion" value="<?= htmlspecialchars($idQuestion) ?>">
            
            <div class="mb-3">
              <label for="title" class="form-label fw-semibold small">Titre</label>
              <input type="text" class="form-control" id="title" name="title"
                     value="<?= htmlspecialchars($title) ?>" required>
              <div class="invalid-feedback">Titre requis.</div>
            </div>

            <div class="mb-3">
              <label for="contenu" class="form-label fw-semibold small">Contenu</label>
              <textarea class="form-control" id="contenu" name="contenu"
                        rows="8" required><?= $contenu ?></textarea>
              <div class="invalid-feedback">Contenu requis.</div>
            </div>

            <div class="d-flex gap-2">
              <button class="btn btn-primary fw-semibold" name="modifierQuestion" type="submit">
                Enregistrer
              </button>
              <a href="mesQuestions.php" class="btn btn-outline-secondary">Annuler</a>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include('includes/footer.php') ?>

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
})()
</script>

</body>
</html>