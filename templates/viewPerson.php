<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">

        <!-- Degree, firstname, lastname -->
        <div class="row margin-bottom">
            <div class="col-lg-12 text-center">
                <h2>
                    <?php echo $results['person']->titel ?> 
                    <?php echo $results['person']->vorname .' '. $results['person']->nachname ?>
                </h2>
                <hr class="star-primary">
            </div>
        </div>

        <div class="row">  

            <div class="col-xs-12 col-sm-3">
                <ul class="list-group">
                    <!-- Birth data -->
                    <li class="list-group-item active"><?php echo BORN ?></li>
                    <li class="list-group-item"><?php echo ON ?> <?php echo DateTime::createFromFormat("Y-m-d", $results['person']->geburtsdatum)->format('j F Y') ?></li>
                    <li class="list-group-item"><?php echo IN ?> <?php echo $results['person']->geburtsort ?></li>

                    <!-- Death data -->
                    <?php if($results['person']->todesdatum) { ?>
                        <li class="list-group-item active"><?php echo DIED ?></li>
                        <li class="list-group-item"><?php echo ON ?> <?php echo DateTime::createFromFormat("Y-m-d", $results['person']->todesdatum)->format('j F Y') ?></li>
                        <?php if($results['person']->todesort) { ?>
                            <li class="list-group-item"><?php echo IN ?> <?php echo $results['person']->todesort ?></li>
                        <?php } ?>
                    <?php } ?>

                    <!-- Sources -->
                    <?php if($results['person']->quelle_titel) { ?>
                        <li class="list-group-item active"><?php echo SOURCES ?></li>
                        <li class="list-group-item">
                            <?php 
                            $quelle_titel = explode("|", $results['person']->quelle_titel);
                            $quelle_isbn = explode("|", $results['person']->quelle_isbn);
                            $quelle_link = explode("|", $results['person']->quelle_link);
                            $quelle_jahr = explode("|", $results['person']->quelle_jahr);
                            $quelle_autor = explode("|", $results['person']->quelle_autor);
                            $quelle_verlag = explode("|", $results['person']->quelle_verlag);

                            for ($i = 0; $i < sizeof($quelle_titel); $i++) { ?>
                                <p>
                                    <?php echo $quelle_autor[$i] != 'NULL' ? $quelle_autor[$i]. ': ' : '' ?>
                                    <?php if($quelle_link[$i] != 'NULL') { ?> 
                                        <a href="<?php echo $quelle_link[$i] ?> " target='_blank'>
                                    <?php } ?>
                                    <strong><?php echo $quelle_titel[$i] ?></strong>.<br/> 
                                    <?php if($quelle_link[$i] != 'NULL') { ?> 
                                        </a>
                                    <?php } ?>
                                    <?php echo $quelle_verlag[$i] != 'NULL' ? $quelle_verlag[$i]. ', ' : '' ?>
                                    <?php echo $quelle_jahr[$i] != 'NULL' ? $quelle_jahr[$i]. '<br/>' : '' ?>
                                    <?php echo $quelle_isbn[$i] != 'NULL' ? 'ISBN '.$quelle_isbn[$i] : '' ?>
                                </p>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-xs-12 col-sm-9">

                <!-- Images -->
                <div class="row margin-bottom">
                    <div class="col-lg-12">
                            <?php 
                            $images_urls = explode("|", $results['person']->bild_pfad);
                            for ($i = 0; $i < sizeof($images_urls); $i++) { ?>
                                <a href="/img/persons/<?php echo $images_urls[$i] ?>" class="fancybox" rel="gallery">
                                    <img src="/<?php echo Person::cropImage('img/persons', $images_urls[$i], 360, 260); ?>" class="img-bordered img-thumbnail img-centered" alt=""/>
                                </a>
                            <?php } ?>
                    </div>
                </div>


                <!-- Categories -->
                <p class="margin-bottom">
                    <?php foreach (explode("|", $results['person']->kategorie_name) as $category) {
                        echo '<span class="label label-default">' . $category . '</span> ';
                    } ?>
                </p>

                <!-- Blockquotes -->
                <?php 
                $zitat_text = explode("|", $results['person']->zitat_text);
                $zitat_quelle = explode("|", $results['person']->zitat_quelle);
                $zitat_link = explode("|", $results['person']->zitat_link);
                $zitat_jahr = explode("|", $results['person']->zitat_jahr);
                $zitat_seite = explode("|", $results['person']->zitat_seite);
                
                for ($i = 0; $i < sizeof($zitat_text); $i++) { ?>
                    <?php if($zitat_text[$i]) { ?> 
                        <blockquote>
                            <p><?php echo $zitat_text[$i] ?></p>
                            <footer>

                                <?php if($zitat_quelle[$i]) { ?> 
                                    <?php if($zitat_link[$i]) { ?> 
                                        <a href="<?php echo $zitat_link[$i] ?> " target='_blank'>
                                    <?php } ?>
                                    <?php echo $zitat_quelle[$i]. ', ' ?>
                                    <?php if($zitat_link[$i]) { ?> 
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if($zitat_link[$i]) { ?> 
                                        <a href="<?php echo $zitat_link[$i] ?> " target='_blank'><?php echo $zitat_link[$i] ?></a>
                                    <?php } ?>
                                <?php } ?>

                                <?php echo $zitat_seite[$i] ? 'S. ' .$zitat_seite[$i]. ', ' : '' ?>
                                <?php echo $zitat_jahr[$i] ? $zitat_jahr[$i] : '' ?>
                            </footer>
                        </blockquote>
                    <?php } ?>
                <?php } ?>
        
                <!-- Long Description -->
                <p><?php echo htmlspecialchars( $results['person']->l_beschreibung ) ?></p>
               
                <p><a href="./"><?php echo RETURN_TO_HOME ?></a></p>
            </div>
        </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>