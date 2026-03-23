<?php 
include('includes/head.php');
require('basededonnee.php');

$questions = $connexion->query("SELECT q.*, u.nom FROM questions q JOIN utilisateurs u ON q.utilisateur_id = u.id ORDER BY id DESC LIMIT 0,5");

if (isset($_GET["recherche"]) AND !empty($_GET["recherche"])) {

    $recherche = $_GET["recherche"];
    $questions = $connexion->query('SELECT q.*, u.nom FROM questions q JOIN utilisateurs u ON q.utilisateur_id = u.id WHERE q.titre LIKE "%'.$recherche.'%" ORDER BY q.id DESC');

}
?>
<body class="bg-light">
<?php include('includes/navbar.php'); ?>

<div class="container py-4">

  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <div>
      <h4 class="fw-bold mb-0">Questions</h4>
      <p class="text-muted small mb-0">Discussions de la communauté</p>
    </div>
    <a href="poserQuestion.php" class="btn btn-primary btn-sm fw-semibold">
      Nouvelle question
    </a>
  </div>

  <hr class="my-3">

  <form class="d-flex gap-2 mb-4" role="recherche" method="get">
    <input
      class="form-control"
      name="recherche"
      type="recherche"
      placeholder="Rechercher une question..."
      value="<?= isset($_GET['recherche']) ? htmlspecialchars($_GET['recherche']) : '' ?>"
    >
    <button type="submit" class="btn btn-primary px-4 fw-semibold">Chercher</button>
  </form>

  <?php
  $n = 0;
  while ($q = $questions->fetch()):
    $n++;
  ?>
    <div class="card border-0 shadow-sm mb-3 border-start border-primary border-3">
      <div class="card-body py-3 px-4">
        <a href="laQuestion.php?id=<?= $q['id'] ?>" class="text-decoration-none">
          <h6 class="fw-bold text-dark mb-1"><?= $q['titre'] ?></h6>
        </a>
        <p class="text-muted small mb-2" style="display:-webkit-box;-webkit-box-orient:vertical;overflow:hidden;">
          <?= $q['contenu'] ?>
        </p>
        <div class="d-flex align-items-center gap-2 small text-muted flex-wrap">
          <span>Par <a href="profil.php?id=<?= $q['utilisateur_id'] ?>" class="text-primary fw-semibold text-decoration-none">@<?= $q['nom'] ?></a></span>
          <span>·</span>
          <span><?= date('d/m/Y H:i:s', strtotime($q['date_creation'])) ?></span>      
        </div>
      </div>
    </div>
  <?php endwhile; ?>

  <?php if ($n === 0): ?>
    <div class="text-center py-5">
      <h5 class="fw-bold">Aucune question trouvée</h5>
      <p class="text-muted small">Soyez le premier à poser une question.</p>
      <a href="publishQuestion.php" class="btn btn-primary mt-2">Poser une question</a>
    </div>
  <?php endif; ?>

</div>

<?php include('includes/footer.php') ?>

</body>
</html>
