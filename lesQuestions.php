<?php
require('actions/users/securityAction.php');
require('actions/questions/showAllQuestionAction.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body>
  <?php include('includes/navbar.php'); ?>

  <div class="container" style="margin-top: 100px;">
    <div class="form-group row">
      <form class="d-flex" role="search" method="get">
        <div class="col-8">
          <input class="form-control me-2" name="search" type="search" placeholder="Recherche" aria-label="Search">
        </div>
        <div class="col-4" style="margin-left: 30px;">
          <button class="btn btn-success" type="submit">Recherche</button>
        </div>
      </form>
    </div>
    <?php
    while ($questions = $getQuestion->fetch()) {
    ?>
      <div class="row" style="margin-top: 25px">
        <div class="col-xxl-12 mb-3">
          <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
            <div class="row align-items-center">
              <div class="col-md-8 mb-3 mb-sm-0">
                <h5>
                  <a href="article.php?id=<?php echo $questions['id']; ?>" class="card-header"><?= $questions['titre']; ?></a>
                </h5>
                <div class="card-body"> <a class="text-black mr-2"><?= $questions['description']; ?></a></div>
              </div>
              <div class="card-footer">
                Publié(e) par <a href="profile.php?id=<?=$questions['auteur'];?>"><?= $questions['surnom']; ?> </a>le <?= $questions['date']; ?> à <?= $questions['heure']; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</body>

</html>