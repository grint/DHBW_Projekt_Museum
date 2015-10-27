<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">

      <div class="row">
          <div class="col-lg-12 text-center">
              <h2>Admin</h2>
              <hr class="star-primary">
              <p><?php echo LOGGED_1 ?> <b><?php echo htmlspecialchars( $_SESSION['admin_name']) ?></b><?php echo LOGGED_2 ?>. <a href="/admin/logout"?><?php echo LOGOUT ?></a></p>
          </div>
      </div>

      <div class="row">
        <div class="col-lg-10 col-md-12 col-lg-offset-1">
          <h1 class="text-center"><?php echo $results['pageTitle'] ?></h1>

          <?php if ( isset( $results['errorMessage'] ) ) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
          <?php } ?>


          <?php if ( isset( $results['statusMessage'] ) ) { ?>
              <div class="alert alert-info text-center statusMessage"><?php echo $results['statusMessage'] ?></div>
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

                <tr onclick="location='/admin/editPerson/<?php echo $person->id?>'">
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
      <p><?php echo $results['totalRows']?> <?php echo ( $results['totalRows'] > 1 ) ? PERSONS : PERSON ?> <?php echo IN_TOTAL ?>.</p>
      </div>
      <div class="col-lg-5 col-md-6 text-right">
        <a href="/admin/newPerson" class="btn btn-primary"><?php echo ADD_NEW_PERSON ?></a>
      </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>

