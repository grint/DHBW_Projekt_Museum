<?php include "templates/include/header.php" ?>

<?php 
  $query = ''; 
  if (isset($_GET["q"]) && $_GET["q"] != '') { 
    $query  = ' ' . SEARCH_FOR . ' "'.$_GET["q"].'"'; 
  } 
?>

<section class="inner-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?php echo SEARCH; ?><?php echo $query ?></h2>
                <hr class="star-primary">
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

              <?php if($_GET["q"] != '') { ?>

                <p class="text-center">
                  <?php echo $results['totalRows']?> 
                  <?php echo ( $results['totalRows'] > 1 || $results['totalRows'] == 0 ) ? PERSONS : PERSON; ?> <?php echo FOUND; ?>
                </p>

                <?php foreach ( $results['persons'] as $person ) { ?>
                  <div class="media">
                    <div class="media-left">
                      <a href="/viewPerson/<?php echo $person->id?>" title="Meht erfahren">
                        <img class="media-object" width='150' src="/<?php echo Person::cropImage('img/persons', explode("|", $person->bild_pfad)[0], 150, 150); ?>" alt=""/>
                      </a>
                    </div>
                    <div class="media-body">
                      <h4>
                        <a href="/viewPerson/<?php echo $person->id?>" title="Meht erfahren">
                          <?php echo $person->vorname .' '. $person->nachname ?>
                        </a>
                      </h4>
                      <p>
                          <?php foreach (explode("|", $person->kategorie_name) as $category) {
                              echo '<span class="label label-default">' . $category . '</span> ';
                          } ?>
                      </p>
                      <p class="k_beschreibung"><?php echo htmlspecialchars( $person->k_beschreibung )?></p>
                    </div>
                  </div>
                <?php } ?>

              <?php } else { ?>
                <div class="alert alert-danger text-center"><?php echo NO_SEARCH_QUERY; ?></div>
              <?php } ?>

            </div>
        </div>

        <div class="row margin-top">
            <div class="col-xs-12 text-right">
              <p><a href="/"><?php echo RETURN_TO_HOME ?></a></p>
            </div>
        </div>
      </div>
</section>

<?php include "templates/include/footer.php" ?>

