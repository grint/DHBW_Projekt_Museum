<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Admin</h2>
                <hr class="star-primary">
                <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
            </div>
        </div>

        <div class="row">
          <div class="col-lg-8 col-md-10 col-sm-12 col-lg-offset-2 col-md-offset-1">
           
            <h1 class="text-center"><?php echo $results['pageTitle']?></h1>

            <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" class="form-horizontal">
              <input type="hidden" name="personId" value="<?php echo $results['person']->id ?>"/>

              <?php if ( isset( $results['errorMessage'] ) ) { ?>
                <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
              <?php } ?>


                <div class="form-group">
                  <label for="name">Nachname</label>
                  <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname des informatiker" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['person']->nachname )?>" />
                </div>

                <div class="form-group">
                  <label for="k_beschreibung">Kurze Beschreibung</label>
                  <textarea class="form-control" name="k_beschreibung" id="k_beschreibung" placeholder="Kurze Beschreibung der Informatiker" required maxlength="1000" style="height: 5em;"><?php echo $results['person']->k_beschreibung ?></textarea>
                </div>

                <div class="form-group">
                  <label for="l_beschreibung">Lange Beschreibung</label>
                  <textarea class="form-control" name="l_beschreibung" id="l_beschreibung" placeholder="Lange Beschreibung der Informatiker" required maxlength="100000" style="height: 15em;"><?php echo $results['person']->l_beschreibung ?></textarea>
                </div>

                <div class="form-group">
                  <label for="geburtsdatum">Geburtsdatum</label>
                  <input type="date" class="form-control" name="geburtsdatum" id="geburtsdatum" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['person']->geburtsdatum ? date( "Y-m-d", strtotime($results['person']->geburtsdatum)) : "" ?>" />
                </div>

              <div class="form-group margin-top">
                <div class="pull-left">
                  <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-lg btn-success" />
                  <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-lg btn-default"  />
                </div>
                
                <?php if ( $results['person']->id ) { ?>
                  <div class="pull-right">
                    <a href="admin.php?action=deletePerson&amp;personId=<?php echo $results['person']->id ?>" onclick="return confirm('Delete This Person?')" class="btn btn-lg btn-danger">Delete This Person</a>
                  </div>
                <?php } ?>

              </div>

            </form>
          </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>