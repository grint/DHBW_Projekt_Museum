<?php include "templates/include/header.php" ?>

<section class="inner-page">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Admin</h2>
                <hr class="star-primary">
                <p><?php echo LOGGED_1 ?> <b><?php echo htmlspecialchars( $_SESSION['admin_name']) ?></b><?php echo LOGGED_2 ?>. <a href="admin.php?action=logout"?><?php echo LOGOUT ?></a></p>
            </div>
        </div>

        <div class="row">
          <div class="col-lg-8 col-md-10 col-sm-12 col-lg-offset-2 col-md-offset-1">
           
            <h1 class="text-center"><?php echo $results['pageTitle']?></h1>

            <form action="<?php echo htmlspecialchars('/admin/' . $results['formAction']); ?>" enctype="multipart/form-data" method="post">
              <input type="hidden" name="personId" value="<?php echo $results['person']->id ?>"/>

              <?php if ( isset( $results['errorMessage'] ) ) { ?>
                <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
              <?php } ?>

              <div class="row">
                <div class="col-xs-12 col-md-6">

                  <div class="form-group required">
                    <label for="name"><?php echo FIRST_NAME ?></label>
                    <input type="text" class="form-control" name="vorname" id="vorname" placeholder="Vorname des informatiker" autofocus required maxlength="255" value="<?php echo htmlspecialchars( $results['person']->vorname )?>" />
                  </div>

                  <div class="form-group required">
                    <label for="geburtsdatum"><?php echo BIRTHDATE ?></label>
                    <input type="text" class="form-control datepicker" name="geburtsdatum" id="geburtsdatum" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['person']->geburtsdatum ? date( "Y-m-d", strtotime($results['person']->geburtsdatum)) : "" ?>" />
                  </div>

                  <div class="form-group">
                    <label for="geburtsort"><?php echo BIRTH_PLACE ?></label>
                    <input type="text" class="form-control" name="geburtsort" id="geburtsort" placeholder="Geburtsort" maxlength="100" value="<?php echo htmlspecialchars( $results['person']->geburtsort )?>" />
                  </div>

                  <div class="form-group">
                    <label for="titel"><?php echo DEGREE ?></label>
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

                  <div class="form-group">
                    <label for="kategorie_id"><?php echo CATEGORY ?></label>
                    <select class="form-control" name="kategorie_id" id="kategorie_id">
                      <?php 
                        foreach(Person::getFields("kategorie", 'id, name') as $option) { ?>
                            <option value="<?php echo $option['id'] ?>" <?php echo ($results['person']->kategorie_id == $option['id'])?"selected":""; ?>>
                              <?php echo $option['name'] ?>
                            </option>
                      <?php } ?>
                    </select>
                  </div>

                </div>

                <div class="col-xs-12 col-md-6">
                  
                  <div class="form-group required">
                    <label for="name"><?php echo LAST_NAME ?></label>
                    <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname des informatiker" required maxlength="255" value="<?php echo htmlspecialchars( $results['person']->nachname )?>" />
                  </div>

                  <div class="form-group">
                    <label for="todesdatum"><?php echo DEATHDATE ?></label>
                    <input type="text" class="form-control datepicker" name="todesdatum" id="todesdatum" placeholder="YYYY-MM-DD" maxlength="10" value="<?php echo $results['person']->todesdatum ? date( "Y-m-d", strtotime($results['person']->todesdatum)) : "" ?>" />
                  </div>

                  <div class="form-group">
                    <label for="todesort"><?php echo DEATH_PLACE ?></label>
                    <input type="text" class="form-control" name="todesort" id="todesort" placeholder="Todesort" maxlength="100" value="<?php echo htmlspecialchars( $results['person']->todesort )?>" />
                  </div>

                  <div class="form-group">
                    <label for="geschlecht"><?php echo SEX ?></label>
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
                    <label for="k_beschreibung"><?php echo SHORT_DESC ?></label>
                    <textarea class="form-control" name="k_beschreibung" id="k_beschreibung" placeholder="Kurze Beschreibung der Informatiker" maxlength="1000" style="height: 5em;"><?php echo $results['person']->k_beschreibung ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="l_beschreibung"><?php echo LONG_DESC ?></label>
                    <textarea class="form-control" name="l_beschreibung" id="l_beschreibung" placeholder="Lange Beschreibung der Informatiker" maxlength="100000" style="height: 15em;"><?php echo $results['person']->l_beschreibung ?></textarea>
                  </div>  

                  <div class="form-group">
                    <label for="images"><?php echo ADD_IMAGES ?></label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple="multiple" accept="image/*" onchange="readURL(this);" />
                    <span class="help-block"><?php echo SUPPORTED_IMAGES ?>: .jpeg, .jpg, .png, .gif</span>
                    <div id="image-peview"></div>
                  </div>  

                  <?php 
                    $images_ids = explode("|", $results['person']->bild_id);
                    $images_urls = explode("|", $results['person']->bild_pfad);
                    $images_num = sizeof($images_ids);

                    if($results['formAction'] == "editPerson" && strlen( $results['person']->bild_id ) > 0) { ?>
                      <div class="form-group">
                        <input type="hidden" value="[]" name="deleted_images_ids"/>
                        <input type="hidden" value="[]" name="deleted_images_urls"/>
                        <label><?php echo EDIT_IMAGES ?></label>
                        <div class="row">
                          <?php for ($i = 0; $i < $images_num; $i++) { ?>
                             <div class="col-xs-6 col-sm-4" id="image-<?php echo $images_ids[$i]; ?>">
                                <img src="<?php echo "/img/persons/".$images_urls[$i] ?>" class="img-thumbnail img-bordered">
                                <div class="caption">
                                  <p><a href="#" class="btn btn-primary remove-image" role="button" id="remove-<?php echo $images_ids[$i] ?>"><?php echo REMOVE ?></a></p>
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
                  <input type="submit" name="saveChanges" value="<?php echo SAVE ?>" class="btn btn-lg btn-success" />
                  <input type="submit" formnovalidate name="cancel" value="<?php echo CANCEL ?>" class="btn btn-lg btn-default"  />
                </div>
                
                <?php if ( $results['person']->id ) { ?>
                  <div class="pull-right">
                    <a href="/admin/deletePerson/<?php echo $results['person']->id ?>" onclick="return confirm('Delete This Person?')" class="btn btn-lg btn-danger"><?php echo REMOVE_THIS_PERSON ?></a>
                  </div>
                <?php } ?>

              </div>

            </form>
          </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>