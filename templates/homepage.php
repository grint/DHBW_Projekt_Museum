<?php include "templates/include/header.php" ?>

<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-responsive img-circle img-thumbnail" src="img/logo.jpg" alt="">
                <div class="intro-text">
                    <span class="name"><?php echo HOME_HEADER_TITLE; ?></span>
                    <hr class="star-light">
                    <span class="skills"><?php echo SLOGAN; ?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Informatiker Grid -->
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?php echo COMPUTER_SCIENTIST; ?></h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
          <?php foreach ( $results['persons'] as $person ) { ?>
            <div class="col-sm-4 person-item">
                <a href=".?action=viewModal&amp;personId=<?php echo $person->id?>" data-toggle="modal" data-target="#informatikerModal" class="portfolio-link">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                            <span><?php echo htmlspecialchars($person->vorname).' '.htmlspecialchars($person->nachname)?></span>
                        </div>
                    </div>
                    <img src="<?php echo Person::cropImage('img/persons', $person->bild_pfad, 360, 260); ?>" class="img-responsive img-thumbnail img-rounded" alt=""/>
                </a>
            </div>
          <?php } ?>
        </div>
    </div>
</section>


<!-- About Section -->
<section class="success" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?php echo MENU_ABOUT; ?></h2>
                <hr class="star-light">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <p><?php echo ABOUT_TEXT_1 ?></p>
            </div>
            <div class="col-lg-4">
                <p><?php echo ABOUT_TEXT_2 ?></p>
            </div>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="./?action=allPersons" class="btn btn-lg btn-outline">
                    <i class="fa fa-user"></i> <?php echo ALL_COMPUTER_SCIENTIST; ?>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Informatiker Modal -->
<div class="portfolio-modal modal fade" id="informatikerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
    </div>
</div>

<?php include "templates/include/footer.php" ?>