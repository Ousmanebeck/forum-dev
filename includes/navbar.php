<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
  <div class="container">

    <a class="navbar-brand fw-bold" href="index.php">
      Forum Dev
    </a>

    <button class="navbar-toggler" type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarMain"
      aria-controls="navbarMain"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lesQuestions.php">Questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="poserQuestion.php">Publier</a>
        </li>
        <?php if (isset($_SESSION['utilisateur'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="mesQuestions.php">Mes questions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profil.php?id=<?= $_SESSION['utilisateur']['id'] ?>">
                Profil
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
          </li>
        <?php endif; ?>
      </ul>
      <?php if (isset($_SESSION['utilisateur'])): ?>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
          <li class="nav-item">
            <a class="nav-link text-white-50" href="deconnexion.php">
              Déconnexion
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </div>

  </div>
</nav>