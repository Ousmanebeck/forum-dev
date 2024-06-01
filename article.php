<?php
require('actions/users/securityAction.php');
require('actions/questions/showArticleContent.php');
require('actions/questions/postAnswerAction.php');
require('actions/questions/showAllAnswerAction.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body>
  <?php include('includes/navbar.php'); ?>

  <?php
  if (isset($errorMsg)) {
    echo '<p class="alert alert-danger">' . $errorMsg . '</p>';
  }
  if (isset($heure_article)) {
  ?>
    <section class="show-content container" style="margin-top: 25px;">
      <div class="container">
        <article class="blog-post">
          <h2 class="display-5 link-body-emphasis mb-1"><?= $title; ?></h2>
          <hr>
          <p style="padding-bottom: 200px;"><?= $contenu; ?></p>
          <hr>
          <p class="blog-post-meta">Par <a href="profile.php?id=<?=$questionInfos['id'];?>"><?= $surnom; ?></a> le <?= $date_article ?> à <?= $heure_article; ?></p>
      </div>
    </section>

    <section class="show-answer container" style="margin-top: 25px;">

      <form class="form-group container" method="post">

        <label class="form-label">Réponse:</label>
        <textarea name="answer" class="form-control" style="padding-bottom: 200px;"></textarea>
        <button name="valide" class="btn btn-outline-success" style="margin-top: 25px;">Répondre</button>
      </form>
      <?php
      while ($answers = $allAnswer->fetch()) {
      ?>
        <div class="row" style="margin-top: 25px">
          <div class="col-xxl-12 mb-3">
            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
              <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-sm-0">
                  <h5>
                    <a class="card-header"><?= $answers['surnom_auteur']; ?></a>
                  </h5>
                  <div class="card-body"> <a class="text-black mr-2"><?= $answers['contenu']; ?></a></div>
                </div>
                <div class="card-footer">
                  Publié(e) par <a href="profile.php?id=<?= $answers['auteur']; ?>"><?= $answers['surnom_auteur']; ?> </a>le <?= $answers['date']; ?> à <?= $answers['heure']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </section>
  <?php
  }
  ?>
  <div class="container" style="margin-top: 50px;">
  </div>
</body>

</html>