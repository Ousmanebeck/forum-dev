<?php
require('actions/users/securityAction.php');
require('actions/questions/getInfoProfileAction.php');
require('actions/questions/editProfilAction.php');
?>
<!doctype html>
<html lang="fr">
<?php include('includes/head.php'); ?>

<body class="align-items-center py-4 bg-body-tertiary d-inline h-100">
  <?php include('includes/navbar.php'); ?>

  <?php if (isset($errorMsg)) {
    echo '<p class="alert alert-danger">' . $errorMsg . '</p>';
  } ?>
  <?php
  if (isset($email)) {
  ?>
    <div class="container">
      <div class="main-body">
        <div class="row gutters-sm">
          <div class="col-md-0 mb-0">

            <form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <div id="image">
                      <div style="width:250px; height:250px; border-radius:50%; margin: -7px; padding: -7px; background:url(<?= 'upload/' . $_SESSION['id'] . '/' . $photo ?>); background-size:cover; no-repeat center;"></div>
                    </div>
                    <div class="col-lg-4 order-lg-1 text-center">
                      <label class="ctext-center">Choisir une photo</label>
                      <input type="file" name="image" class="btn container" accept="image/*" onchange="gallerie();" />
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
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $nom; ?>" required>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Surnom</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" id="surnom" name="surnom" value="<?= $surnom; ?>" required>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" required>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-12">
                        <button class="btn btn-info" type="submit" name="valide">Modifier le profile</button>
                      </div>
                    </div>
            </form>
          <?php
        }
          ?>

          <script type="text/javascript">
            function gallerie() {
              var reader = new FileReader();
              var file = document.getElementById('photo').files[0];
              reader.onload = function(e) {
                document.getElementById('result').src = e.target.result;
              }
              reader.readAsDataURL(file);
            }
          </script>

          <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>