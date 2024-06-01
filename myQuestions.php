<?php
require('actions/users/securityAction.php');
require('actions/questions/myQuestionsAction.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body style="margin-top: 20px; background: #eee; color: #708090;">
  <?php include('includes/navbar.php'); ?>
  <?php
  while ($questions = $requete_get->fetch()) {

  ?>
    <div class="container">
      <div class="row">
        <div class="col-xxl-12 mb-3">
          <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
            <div class="row align-items-center">
              <div class="col-md-8 mb-3 mb-sm-0">
                <h5>
                  <a href="article.php?id=<?php echo $questions['id']; ?>" class="text-primary"><?= $questions['titre']; ?></a>
                </h5>
                <div class="text-sm op-5"> <a class="text-black mr-2"><?= $questions['description']; ?></a></div>
              </div>
              <div class="col-md-4 op-7">
                <div class="row text-center op-7">
                  <div class="col px-0"><a href="article.php?id=<?php echo $questions['id']; ?>"><button class="btn btn-primary">Accéder</button></a></div>
                  <div class="col px-0"><a href="editQuestion.php?id=<?= $questions['id']; ?>"><button class="btn btn-warning">Modifier</button></a></div>
                  <div class="col px-0"><a href="actions/questions/deleteQuestionAction.php?id=<?= $questions['id']; ?>"><button class="btn btn-danger">Supprimer</button></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</body>

</html>