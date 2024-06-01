<main>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Offcanvas navbar large">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Plateforme Alcatraz</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Alcatraz</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="profile.php?id=<?= $_SESSION['id'] ?>">Mon profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="lesQuestions.php">Les questions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="publishQuestion.php">Publier une question</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="myQuestions.php">Mes questions</a>
            </li>
            <?php
            if (isset($_SESSION['auth'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="actions/users/signoutAction.php">Déconnexion</a>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</main>