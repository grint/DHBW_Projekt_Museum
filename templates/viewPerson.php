<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?php echo $results['person']->vorname .' '. $results['person']->nachname ?></h2>
                <hr class="star-primary">
                <div class="row">
                    <?php 
                    $images_urls = explode(",", $results['person']->bild_pfad);
                    for ($i = 0; $i < sizeof($images_urls); $i++) { ?>
                        <a href="img/persons/<?php echo $images_urls[$i] ?>" class="fancybox" rel="gallery">
                            <img src="<?php echo Person::cropImage('img/persons', $images_urls[$i], 360, 260); ?>" class="img-bordered img-thumbnail img-centered" alt=""/>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>Titel: <?php echo $results['person']->titel ?></p>
                <p>geboren am <?php echo DateTime::createFromFormat("Y-m-d", $results['person']->geburtsdatum)->format('j F Y') ?> in <?php echo $results['person']->geburtsort ?></p>
                <p>gestorben am <?php echo DateTime::createFromFormat("Y-m-d", $results['person']->todesdatum)->format('j F Y') ?> in <?php echo $results['person']->todesort ?></p>
				<p><?php echo htmlspecialchars( $results['person']->k_beschreibung )?></p>
				<p><?php echo $results['person']->l_beschreibung?></p>
               
				<p><a href="./"><?php echo RETURN_TO_HOME ?></a></p>
            </div>
        </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>