<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?php echo ALL_COMPUTER_SCIENTIST ?></h2>
                <hr class="star-primary">
            </div>
        </div>

        <div class="row">

          <?php if (isset($_GET["category"])) { $category  = $_GET["category"]; } else { $category = ''; }; ?>
          <div class="col-xs-12 col-sm-3">
            <ul class="list-group">
              <li class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo CATEGORIES ?></h4>
              </li>
              <li class="list-group-item <?php if($category == '') { echo 'active'; } ?>">
                <a href="/allPersons"><?php echo ALL ?></a>
              </li>
            <?php foreach(Person::getFields("kategorie", 'id, name') as $cat) { ?>
                  <li class="list-group-item <?php if($category == $cat['id']) { echo 'active'; } ?>">
                    <a href="/allPersons/category/<?php echo $cat['id'] ?>">
                      <?php echo $cat['name'] ?>
                    </a>
                  </li>
            <?php } ?>
            </ul>
          </div>



            <div class="col-xs-12 col-sm-9">

              <?php foreach ( $results['persons'] as $person ) { ?>
                <div class="media">
                  <div class="media-left">
                    <a href="/viewPerson/<?php echo $person->id?>" title="Meht erfahren">
                      <img class="media-object" width='150' src="/<?php echo Person::cropImage('img/persons', $person->bild_pfad, 150, 150); ?>" alt="">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4>
                      <a href="/viewPerson/<?php echo $person->id?>" title="Meht erfahren">
                        <?php echo $person->vorname .' '. $person->nachname ?>
                      </a>
                    </h4>
                    <p class="k_beschreibung"><?php echo htmlspecialchars( $person->k_beschreibung )?></p>
                  </div>
                </div>
              <?php } ?>


              <?php if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page = 1; }; ?>
              <nav class='text-right'>
                <ul class="pagination">
                  <li>
                    <a href="<?php echo '/allPersons/page/1' ?>">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <?php for ($i = 1; $i <= $results['totalPages']; $i++) { ?>
                    <li class="<?php if($page == $i) { echo 'active'; } ?>">
                      <a href="<?php echo '/allPersons/page/' . $i ?>"><?php echo $i; ?></a>
                    </li>
                  <?php } ?> 
                  <li>
                    <a href="<?php echo '/allPersons/page/'. $results['totalPages'] ?>">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>

            </div>
        </div>
        <div class="row margin-top">
            <div class="col-sm-6">
              <p><?php echo $results['totalRows']?> <?php echo ( $results['totalRows'] > 1 ) ? PERSONS : PERSON ?> <?php echo IN_TOTAL ?>.</p>
            </div>
            <div class="col-sm-6 text-right">
              <p><a href="/"><?php echo RETURN_TO_HOME ?></a></p>
            </div>
        </div>
      </div>
</section>

<?php include "templates/include/footer.php" ?>

