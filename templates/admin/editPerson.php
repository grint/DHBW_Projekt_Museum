<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Admin</h2>
                <hr class="star-primary">
                <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a href="admin.php?action=logout"?>Log out</a></p>
            </div>
        </div>

        <div class="row">
          <div class="col-lg-8 col-md-10 col-sm-12 col-lg-offset-2 col-md-offset-1">
           
            <h1 class="text-center"><?php echo $results['pageTitle']?></h1>

            <form action="admin.php?action=<?php echo $results['formAction']?>" enctype="multipart/form-data" method="post">
              <input type="hidden" name="personId" value="<?php echo $results['person']->id ?>"/>

              <?php if ( isset( $results['errorMessage'] ) ) { ?>
                <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
              <?php } ?>

              <div class="row">
                <div class="col-xs-12 col-md-6">

                  <div class="form-group required">
                    <label for="name">Vorname</label>
                    <input type="text" class="form-control" name="vorname" id="vorname" placeholder="Vorname des informatiker" maxlength="255" value="<?php echo htmlspecialchars( $results['person']->vorname )?>" />
                  </div>

                  <div class="form-group required">
                    <label for="geburtsdatum">Geburtsdatum</label>
                    <input type="text" class="form-control datepicker" name="geburtsdatum" id="geburtsdatum" placeholder="YYYY-MM-DD" maxlength="10" value="<?php echo $results['person']->geburtsdatum ? date( "Y-m-d", strtotime($results['person']->geburtsdatum)) : "" ?>" />
                  </div>

                  <div class="form-group">
                    <label for="geburtsort">Geburtsort</label>
                    <input type="text" class="form-control" name="geburtsort" id="geburtsort" placeholder="Geburtsort" maxlength="100" value="<?php echo htmlspecialchars( $results['person']->geburtsort )?>" />
                  </div>

                  <div class="form-group">
                    <label for="titel">Titel</label>
                    <select class="form-control" name="titel" id="titel">
                      <option value="" <?php echo ($results['person']->titel == '')?"selected":""; ?>></option>
                      <?php 
                        foreach(Person::getSet("person", "titel") as $option) { ?>
                            <option value="<?php echo $option ?>" <?php echo ($results['person']->titel == $option)?"selected":""; ?>>
                              <?php echo $option ?>
                            </option>
                      <?php } ?>
                    </select>
                  </div>

                </div>

                <div class="col-xs-12 col-md-6">
                  
                  <div class="form-group required">
                    <label for="name">Nachname</label>
                    <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname des informatiker" autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['person']->nachname )?>" />
                  </div>

                  <div class="form-group">
                    <label for="todesdatum">Todesdatum</label>
                    <input type="text" class="form-control datepicker" name="todesdatum" id="todesdatum" placeholder="YYYY-MM-DD" maxlength="10" value="<?php echo $results['person']->todesdatum ? date( "Y-m-d", strtotime($results['person']->todesdatum)) : "" ?>" />
                  </div>

                  <div class="form-group">
                    <label for="todesort">Todesort</label>
                    <input type="text" class="form-control" name="todesort" id="todesort" placeholder="Todesort" maxlength="100" value="<?php echo htmlspecialchars( $results['person']->todesort )?>" />
                  </div>

                  <div class="form-group">
                    <label for="geschlecht">Geschlecht</label>
                    <select class="form-control" name="geschlecht" id="geschlecht">
                      <?php 
                        foreach( Person::getSet("person", "geschlecht") as $option) { ?>
                            <option value="<?php echo $option ?>" <?php echo ($results['person']->geschlecht == $option)?"selected":""; ?>>
                              <?php echo $option == 'f' ? 'weiblich' : 'männlich' ?>
                            </option>
                      <?php } ?>
                    </select>
                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-xs-12">

                  <div class="form-group">
                    <label for="k_beschreibung">Kurze Beschreibung</label>
                    <textarea class="form-control" name="k_beschreibung" id="k_beschreibung" placeholder="Kurze Beschreibung der Informatiker" maxlength="1000" style="height: 5em;"><?php echo $results['person']->k_beschreibung ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="l_beschreibung">Lange Beschreibung</label>
                    <textarea class="form-control" name="l_beschreibung" id="l_beschreibung" placeholder="Lange Beschreibung der Informatiker" maxlength="100000" style="height: 15em;"><?php echo $results['person']->l_beschreibung ?></textarea>
                  </div>  

                  <div class="form-group">
                    <label for="images">Bilder hinzufügen</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple="multiple" accept="image/*" onchange="readURL(this);" />
                    <span class="help-block">Supported image formats: .jpeg, .jpg, .png, .gif</span>
                    <div id="image-peview"></div>
                  </div>  

                  <?php 
                    $images_ids = explode(",", $results['person']->bild_id);
                    $images_urls = explode(",", $results['person']->bild_pfad);
                    $images_num = sizeof($images_ids);

                    if($results['formAction'] == "editPerson" && strlen( $results['person']->bild_id ) > 0) { ?>
                      <div class="form-group">
                        <input type="hidden" value="[]" name="deleted_images_ids"/>
                        <input type="hidden" value="[]" name="deleted_images_urls"/>
                        <label>Bilder bearbeiten</label>
                        <div class="row">
                          <?php for ($i = 0; $i < $images_num; $i++) { ?>
                             <div class="col-xs-6 col-sm-4" id="image-<?php echo $images_ids[$i]; ?>">
                                <img src="<?php echo "/img/persons/".$images_urls[$i] ?>" class="img-thumbnail img-bordered">
                                <div class="caption">
                                  <p><a href="#" class="btn btn-primary remove-image" role="button" id="remove-<?php echo $images_ids[$i] ?>">Delete</a></p>
                                </div>
                             </div>
                          <?php } ?>
                        </div>
                    </div> 
                  <?php } ?> 

                </div>
              </div>

              <div class="form-group margin-top">
                <div class="pull-left">
                  <input type="submit" name="saveChanges" value="Save Changes" class="btn btn-lg btn-success" />
                  <input type="submit" formnovalidate name="cancel" value="Cancel" class="btn btn-lg btn-default"  />
                </div>
                
                <?php if ( $results['person']->id ) { ?>
                  <div class="pull-right">
                    <a href="admin.php?action=deletePerson&amp;personId=<?php echo $results['person']->id ?>" onclick="return confirm('Delete This Person?')" class="btn btn-lg btn-danger">Delete This Person</a>
                  </div>
                <?php } ?>

              </div>

            </form>
          </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>