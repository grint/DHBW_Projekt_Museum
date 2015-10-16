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
                <img src="<?php echo 'img/persons/'.$results['person']->bild_pfad ?>" class="img-responsive img-centered" alt=""/>

                <p>geboren am <?php echo date('j F Y', strtotime($results['person']->geburtsdatum)) ?></p>
                <p><?php echo $results['person']->k_beschreibung ?></p>

                <p><a href=".?action=viewPerson&amp;personId=<?php echo $results['person']->id ?>"><?php echo LEARN_MORE ?></a></p>

                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo CLOSE ?></button>                    
            </div>
        </div>
    </div>
</div>

