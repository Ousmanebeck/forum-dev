<?php include("includes/head.php"); ?>
<body class="bg-light">

<?php include("includes/navbar.php"); ?>

<div class="container py-5">

  <div class="p-5 mb-4 bg-primary text-white rounded-3">
    <div class="container-fluid py-3">
      <h1 class="display-5 fw-bold">Forum des développeurs</h1>
      <p class="col-md-8 fs-5 opacity-75">
        Posez vos questions, obtenez des réponses. Une communauté tech pour progresser ensemble.
      </p>
      <div class="d-flex gap-2 flex-wrap mt-4">
        <a href="lesQuestions.php" class="btn btn-light btn-lg fw-semibold">
          Voir les questions
        </a>
        <a href="poserQuestion.php" class="btn btn-outline-light btn-lg">
          Poser une question
        </a>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-4">
      <div class="card text-center border-0 shadow-sm h-100">
        <div class="card-body py-4">
          <div class="fs-2 fw-bold text-primary">Infini</div>
          <div class="text-muted small text-uppercase fw-semibold mt-1">Questions</div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card text-center border-0 shadow-sm h-100">
        <div class="card-body py-4">
          <div class="fs-2 fw-bold text-primary">24/7</div>
          <div class="text-muted small text-uppercase fw-semibold mt-1">Disponible</div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card text-center border-0 shadow-sm h-100">
        <div class="card-body py-4">
          <div class="fs-2 fw-bold text-primary">100%</div>
          <div class="text-muted small text-uppercase fw-semibold mt-1">Gratuit</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4">
          <h5 class="fw-bold">Support technique</h5>
          <p class="text-muted small mb-0">
            Code, bugs, architecture — la communauté répond à vos questions techniques.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4">
          <h5 class="fw-bold">Recherche rapide</h5>
          <p class="text-muted small mb-0">
            Retrouvez des réponses déjà publiées grâce au moteur de recherche.
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body p-4">
          <h5 class="fw-bold">Profils & historique</h5>
          <p class="text-muted small mb-0">
            Consultez les profils des membres et suivez vos contributions.
          </p>
        </div>
      </div>
    </div>
  </div>

</div>

<?php include("includes/footer.php"); ?>


</body>
</html>
