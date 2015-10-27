<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Login</h2>
                <hr class="star-primary">
            </div>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-12 col-lg-offset-3 col-md-offset-2">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">
              <input type="hidden" name="login" value="true" />

              <?php if ( isset( $results['errorMessage'] ) ) { ?>
                <div class="alert alert-danger errorMessage"><?php echo $results['errorMessage'] ?></div>
              <?php } ?>

              <div class="form-group">
                <label for="<?php echo $results['sessionType']?>_name"><?php echo USERNAME ?></label>
                <input type="text" class="form-control input-lg" name="<?php echo $results['sessionType']?>_name" id="<?php echo $results['sessionType']?>_name" required autofocus maxlength="20" />
              </div>

              <div class="form-group">
                <label for="<?php echo $results['sessionType']?>_password"><?php echo PASSWORD ?></label>
                <input type="password" class="form-control input-lg" name="<?php echo $results['sessionType']?>_password" id="<?php echo $results['sessionType']?>_password" required maxlength="20" />
              </div>

              <div class="form-group margin-top">
                <input type="submit" name="login" value="Login" class="btn btn-lg btn-primary btn-block" />
              </div>

            </form>

          </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>