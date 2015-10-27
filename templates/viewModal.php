<div class="close-modal" data-dismiss="modal">
    <div class="lr">
        <div class="rl">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-12 col-lg-offset-1">
            <div class="modal-body">
                <h2><?php echo $results['person']->vorname .' '. $results['person']->nachname ?></h2>
                <hr class="star-primary">
                <img src="<?php echo 'img/persons/'.explode("|", $results['person']->bild_pfad)[0] ?>" height='250' class="img-centered" alt=""/>

                <p>
                    <?php foreach (explode("|", $results['person']->kategorie_name) as $category) {
                        echo '<span class="label label-default">' . $category . '</span> ';
                    } ?>
                </p>

                <?php 
                $zitat_text = explode("|", $results['person']->zitat_text);
                $zitat_quelle = explode("|", $results['person']->zitat_quelle);
                $zitat_link = explode("|", $results['person']->zitat_link);
                $zitat_jahr = explode("|", $results['person']->zitat_jahr);
                $zitat_seite = explode("|", $results['person']->zitat_seite);
            
                if($zitat_text[0] != 'NULL') { ?> 
                    <blockquote class="centered">
                        <p><?php echo $zitat_text[0] ?></p>
                        <footer>

                            <?php if($zitat_quelle[0] != 'NULL') { ?> 
                                <?php if($zitat_link[0] != 'NULL') { ?> 
                                    <a href="<?php echo $zitat_link[0] ?> " target='_blank'>
                                <?php } ?>
                                <?php echo $zitat_quelle[0]. ', ' ?>
                                <?php if($zitat_link[0] != 'NULL') { ?> 
                                    </a>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if($zitat_link[0] != 'NULL') { ?> 
                                    <a href="<?php echo $zitat_link[0] ?> " target='_blank'><?php echo $zitat_link[0] ?></a>
                                <?php } ?>
                            <?php } ?>

                            <?php echo $zitat_seite[0] != 'NULL' ? 'S. ' .$zitat_seite[0]. ', ' : '' ?>
                            <?php echo $zitat_jahr[0] != 'NULL' ? $zitat_jahr[0] : '' ?>
                        </footer>
                    </blockquote>
                <?php } ?>

                <p><?php echo $results['person']->k_beschreibung ?></p>

                <p><a href="/viewPerson/<?php echo $results['person']->id ?>"><?php echo LEARN_MORE ?></a></p>

                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo CLOSE ?></button>                    
            </div>
        </div>
    </div>
</div>

