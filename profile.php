<?php
require('actions/users/securityAction.php');
require('actions/questions/showProfileAction.php');
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body class="align-items-center py-4 bg-body-tertiary d-inline h-100">
  <?php include('includes/navbar.php'); ?>
  <?php if (isset($errorMsg)) {
    echo '<p class="alert alert-danger">' . $errorMsg . '</p>';
  } ?>
  <?php
  if (isset($getQuestions)) {
  ?>
    <div class="container">
      <div class="main-body">
        <div class="row gutters-sm">
          <div class="col-md-0 mb-0">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <div id="image">
                    <div style="width:250px; height:250px;border-radius:50%; margin: -7px; padding: -7px; background:url(<?='upload/'.$_SESSION['id'].'/'.$user_photo ?>); background-size:cover; no-repeat center;"></div>
                  </div>
                  <div class="mt-3">
                    <h4>@<?= $user_surnom; ?></h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-0">
              <div class="card mb-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nom</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $user_nom ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <a><?= $user_email; ?></a>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                  <?php if ($_SESSION['id'] == $idUsers): ?>
                    <div class="col-sm-12">
                      <a class="btn btn-info" href="editProfile.php?id=<?= $_SESSION['id']; ?>">Modifier le profile</a>
                    </div>
                    <?php endif; ?>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="container">
                      <h6 class="col-12 text-center">Question-s posé-s</h6>
                      <div class="container">
                        <?php
                        while ($questions = $getQuestions->fetch()) {
                        ?><div class="container"></div>
                          <div class="row" style="margin-top: 15px">
                            <div class="col-xxl-12 mb-3">
                              <div class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                                <div class="row align-items-center">
                                  <div class="col-md-8 mb-3 mb-sm-0">
                                    <h5>
                                      <a href="article.php?id=<?php echo $questions['id']; ?>"><?= $questions['titre']; ?></a>
                                    </h5>
                                    <div class="card-body"> <a class="text-black mr-2"><?= $questions['description']; ?></a></div>
                                  </div>
                                  <div class="card-footer">
                                    Publié(e) par le <?= $questions['date']; ?> à <?= $questions['heure']; ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
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

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/checkout.js"></script>


</body>

</html>