<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?php echo $results['person']->vorname .' '. $results['person']->nachname ?></h2>
                <hr class="star-primary">
                <img src="<?php echo 'img/persons/'.$results['person']->bild_pfad ?>" class="img-responsive img-centered" alt=""/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
				<p><?php echo htmlspecialchars( $results['person']->k_beschreibung )?></p>
				<p><?php echo $results['person']->l_beschreibung?></p>
				<p class="pubDate">geboren am <?php echo date('j F Y', strtotime($results['person']->geburtsdatum)) ?></p>

				<p><a href="./"><?php echo RETURN_TO_HOME ?></a></p>
            </div>
        </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>