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
            <form action="admin.php?action=login" method="post" class="form-horizontal">
              <input type="hidden" name="login" value="true" />

              <?php if ( isset( $results['errorMessage'] ) ) { ?>
                <div class="alert alert-danger errorMessage"><?php echo $results['errorMessage'] ?></div>
              <?php } ?>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
              </div>

              <div class="form-group margin-top">
                <input type="submit" name="login" value="Login" class="btn btn-lg btn-primary btn-block" />
              </div>

            </form>

          </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>