<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Alle Informatiker</h2>
                <hr class="star-primary">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

              <?php if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page = 1; }; ?>
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="<?php echo '.?action=allPersons&page=1' ?>">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <?php for ($i = 1; $i <= $results['totalPages']; $i++) { ?>
                    <li class="<?php if($page == $i) { echo 'active'; } ?>">
                      <a href="<?php echo '.?action=allPersons&page=' . $i ?>"><?php echo $i; ?></a>
                    </li>
                  <?php } ?> 
                  <li>
                    <a href="<?php echo '.?action=allPersons&page='. $results['totalPages'] ?>">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>

              <?php foreach ( $results['persons'] as $person ) { ?>
                <div class="media">
                  <div class="media-left">
                    <a href=".?action=viewPerson&amp;personId=<?php echo $person->id?>" title="Meht erfahren">
                      <img class="media-object" src="<?php echo Person::cropImage('img/persons', $person->bild_pfad, 150, 150); ?>" alt="">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4>
                      <a href=".?action=viewPerson&amp;personId=<?php echo $person->id?>" title="Meht erfahren">
                        <?php echo $person->vorname .' '. $person->nachname ?>
                      </a>
                    </h4>
                    <p class="k_beschreibung"><?php echo htmlspecialchars( $person->k_beschreibung )?></p>
                  </div>
                </div>
              <?php } ?>

              
              <hr class="star-primary">
            </div>
        </div>
        <div class="row margin-top">
            <div class="col-sm-6">
              <p><?php echo $results['totalRows']?> person<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
            </div>
            <div class="col-sm-6 text-right">
              <p><a href="./">Return to Homepage</a></p>
            </div>
        </div>
      </div>
</section>

<?php include "templates/include/footer.php" ?>

