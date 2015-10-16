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
        <div class="col-lg-10 col-md-12 col-lg-offset-1">
          <h1 class="text-center">Alle Informatiker</h1>

          <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
          <?php } ?>


          <?php if ( isset( $results['statusMessage'] ) ) { ?>
              <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
          <?php } ?>

          <table class="table table-bordered table-striped table-hover margin-top">
            <thead>
            <tr>
              <th>Vorname</th>
              <th>Nachname</th>
              <th>Geburtsdatum</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ( $results['persons'] as $person ) { ?>

                <tr onclick="location='admin.php?action=editPerson&amp;personId=<?php echo $person->id?>'">
                  <td><?php echo $person->vorname ?></td>
                  <td><?php echo $person->nachname ?></td>
                  <td><?php echo date('j M Y', strtotime($person->geburtsdatum))?></td>
                </tr>

              <?php } ?>
            </tbody>
          </table>

        </div>
    </div>

    <div class="row">
      <div class="col-lg-5 col-md-6 col-lg-offset-1">
        <p><?php echo $results['totalRows']?> person<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
      </div>
      <div class="col-lg-5 col-md-6 text-right">
        <a href="admin.php?action=newPerson" class="btn btn-primary">Add a New Person</a>
      </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>

