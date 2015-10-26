<?php

/**
 * Class for processing persons
 */

class Person
{
  public $id = null;
  public $nachname = null;
  public $vorname = null;
  public $titel = null;
  public $geburtsdatum = null;
  public $geburtsort = null;
  public $todesdatum = null;
  public $todesort = null;
  public $geschlecht = null;
  public $k_beschreibung = null;
  public $l_beschreibung = null;

  public $bild_id = null;
  public $bild_pfad = null;
  public $bild_beschreibung = null;
  public $bild_link = null;
  public $deleted_images_ids = null;
  public $deleted_images_urls = null;

  public $kategorie_id = null;
  public $kategorie_name = null;

  public $quelle_titel = null;
  public $quelle_isbn = null;
  public $quelle_link = null;
  public $quelle_typ = null;
  public $quelle_jahr = null;
  public $quelle_autor = null;
  public $quelle_verlag = null;

  public $zitat_text = null;
  public $zitat_quelle = null;
  public $zitat_link = null;
  public $zitat_jahr = null;
  public $zitat_seite = null;


  /**
  * Set the properties using the values in the specified array
  *
  * @param assoc property values
  */

  public function __construct( $data=array() ) {

    if ( isset( $data['id'] ) )                 $this->id = (int) $data['id'];
    if ( isset( $data['vorname'] ) )            $this->vorname = $data['vorname'];
    if ( isset( $data['nachname'] ) )           $this->nachname = $data['nachname'];
    if ( isset( $data['geburtsdatum'] ) )       $this->geburtsdatum = $data['geburtsdatum'];
    if ( isset( $data['geburtsort'] ) )         $this->geburtsort = $data['geburtsort'];
    if ( isset( $data['todesdatum'] ) )         $this->todesdatum = $data['todesdatum'];
    if ( isset( $data['todesort'] ) )           $this->todesort = $data['todesort'];
    if ( isset( $data['k_beschreibung'] ) )     $this->k_beschreibung = $data['k_beschreibung'];
    if ( isset( $data['l_beschreibung'] ) )     $this->l_beschreibung = $data['l_beschreibung'];
    if ( isset( $data['titel'] ) )              $this->titel = $data['titel'];
    if ( isset( $data['geschlecht'] ) )         $this->geschlecht = $data['geschlecht'];

    if ( isset( $data['kategorie_id'] ) )       $this->kategorie_id = $data['kategorie_id'];
    if ( isset( $data['kategorie_name'] ) )     $this->kategorie_name = $data['kategorie_name'];

    if ( isset( $data['bild_id'] ) )            $this->bild_id = $data['bild_id'];
    if ( isset( $data['bild_pfad'] ) )          $this->bild_pfad = $data['bild_pfad'];
    if ( isset( $data['bild_beschreibung'] ) )  $this->bild_beschreibung = $data['bild_beschreibung'];
    if ( isset( $data['bild_link'] ) )          $this->bild_link = $data['bild_link'];
    if ( isset( $data['deleted_images_ids'] ) )     $this->deleted_images_ids = $data['deleted_images_ids'];
    if ( isset( $data['deleted_images_urls'] ) )     $this->deleted_images_urls = $data['deleted_images_urls'];

    if ( isset( $data['quelle_titel'] ) )       $this->quelle_titel = $data['quelle_titel'];
    if ( isset( $data['quelle_isbn'] ) )        $this->quelle_isbn = $data['quelle_isbn'];
    if ( isset( $data['quelle_link'] ) )        $this->quelle_link = $data['quelle_link'];
    if ( isset( $data['quelle_typ'] ) )         $this->quelle_typ = $data['quelle_typ'];
    if ( isset( $data['quelle_jahr'] ) )        $this->quelle_jahr = $data['quelle_jahr'];
    if ( isset( $data['quelle_autor'] ) )       $this->quelle_autor = $data['quelle_autor'];
    if ( isset( $data['quelle_verlag'] ) )      $this->quelle_verlag = $data['quelle_verlag'];

    if ( isset( $data['zitat_text'] ) )         $this->zitat_text = $data['zitat_text'];
    if ( isset( $data['zitat_quelle'] ) )       $this->zitat_quelle = $data['zitat_quelle'];
    if ( isset( $data['zitat_link'] ) )         $this->zitat_link = $data['zitat_link'];
    if ( isset( $data['zitat_jahr'] ) )         $this->zitat_jahr = $data['zitat_jahr'];
    if ( isset( $data['zitat_seite'] ) )        $this->zitat_seite = $data['zitat_seite'];
  }


  /**
  * Set properties using values from editing person form in the specified array
  *
  * @param assoc form recorded values
  */

  public function storeFormValues ( $params ) {

    // Save all parameters
    $this->__construct( $params );

    // Disassemble and save the birthdate 
    if ( isset($params['geburtsdatum']) ) {
      $geburtsdatum = explode ( '-', $params['geburtsdatum'] );

      if ( count($geburtsdatum) == 3 ) {
        list ( $y, $m, $d ) = $geburtsdatum;
        $this->geburtsdatum = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }

    // Disassemble and save the deathdate
    if ( isset($params['todesdatum']) ) {
      $todesdatum = explode ( '-', $params['todesdatum'] );

      if ( count($todesdatum) == 3 ) {
        list ( $y, $m, $d ) = $todesdatum;
        $this->todesdatum = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
  }


  /**
  * Return a Person object corresponding to the specified Person ID
  *
  * @param int ID of the person
  * @return Person|false Person object or false, if the record is not found or there're problems
  */

  public static function getById( $id ) {
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );

    $sql = "SELECT *,
              GROUP_CONCAT(KATEGORIE.id SEPARATOR '|') AS kategorie_id,
              GROUP_CONCAT(KATEGORIE.name SEPARATOR '|') AS kategorie_name,
              person.id AS id

            FROM person
            -- include categories, all persons have a category -> inner join
            INNER JOIN person_kategorie AS PK
              ON person.id = PK.person_id
            INNER JOIN kategorie AS KATEGORIE
              ON KATEGORIE.id = PK.kategorie_id

            -- include blockquotes
            LEFT JOIN (
              SELECT 
                person.id as PersonId,
                GROUP_CONCAT(zitat.text SEPARATOR '|') AS zitat_text,
                GROUP_CONCAT(zitat.quelle SEPARATOR '|') AS zitat_quelle,
                GROUP_CONCAT(zitat.link SEPARATOR '|') AS zitat_link,
                GROUP_CONCAT(zitat.jahr SEPARATOR '|') AS zitat_jahr,
                GROUP_CONCAT(zitat.seite SEPARATOR '|') AS zitat_seite
              FROM person
              LEFT JOIN zitat
                ON person.id = zitat.person_id
              GROUP BY person.id
              ) AS ZITAT on person.id = ZITAT.PersonId

            -- include images
            LEFT JOIN (
              SELECT 
                person.id as PersonId,
                GROUP_CONCAT(bilder.id SEPARATOR '|') AS bild_id,
                GROUP_CONCAT(bilder.beschreibung SEPARATOR '|') AS bild_beschreibung,
                GROUP_CONCAT(bilder.link SEPARATOR '|') AS bild_link,
                GROUP_CONCAT(bilder.pfad SEPARATOR '|') AS bild_pfad
               FROM person
               LEFT JOIN person_bilder ON
                   person.id = person_bilder.person_id
               LEFT JOIN bilder ON
                   bilder.id = person_bilder.bilder_id
               GROUP BY person.id
              ) AS BILDER on person.id = BILDER.PersonId

            -- include sources
            LEFT JOIN (
               SELECT 
                  person.id as PersonId,
                  GROUP_CONCAT(quelle.titel SEPARATOR '|') AS quelle_titel,
                  GROUP_CONCAT(IFNULL(quelle.isbn, 'NULL') SEPARATOR '|') AS quelle_isbn,
                  GROUP_CONCAT(IFNULL(quelle.link, 'NULL') SEPARATOR '|') AS quelle_link,
                  GROUP_CONCAT(IFNULL(quelle.typ, 'NULL') SEPARATOR '|') AS quelle_typ,
                  GROUP_CONCAT(IFNULL(quelle.jahr, 'NULL') SEPARATOR '|') AS quelle_jahr,
                  GROUP_CONCAT(IFNULL(AUTOR.autor, 'NULL') SEPARATOR '|') AS quelle_autor,
                  GROUP_CONCAT(IFNULL(VERLAG.name, 'NULL') SEPARATOR '|') AS quelle_verlag
                FROM person
                LEFT JOIN person_quelle ON
                   person.id = person_quelle.person_id
                LEFT JOIN quelle ON
                   quelle.id = person_quelle.quelle_id

                -- include sources authors
                LEFT JOIN (
                   SELECT 
                      quelle.id as QuelleId,
                      GROUP_CONCAT(IFNULL(CONCAT(autor.nachname, ', ', autor.vorname), 'NULL') SEPARATOR '; ') AS autor
                   FROM quelle
                   LEFT JOIN quelle_autor ON
                       quelle.id = quelle_autor.quelle_id
                   LEFT JOIN autor ON
                       autor.id = quelle_autor.autor_id
                   GROUP BY quelle.id
                  ) AS AUTOR on quelle.id = AUTOR.QuelleId

                -- include sources publishers
                LEFT JOIN (
                   SELECT 
                      quelle.id as QuelleId,
                      GROUP_CONCAT(IFNULL(verlag.name, 'NULL') SEPARATOR '|') AS name
                   FROM quelle
                   LEFT JOIN quelle_verlag ON
                       quelle.id = quelle_verlag.quelle_id
                   LEFT JOIN verlag ON
                       verlag.id = quelle_verlag.verlag_id
                   GROUP BY quelle.id
                  ) AS VERLAG on quelle.id = VERLAG.QuelleId

               GROUP BY person.id
              ) AS QUELLE on person.id = QUELLE.PersonId

            WHERE person.id = :id";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($row);
    // echo '</pre>';
    $conn = null;
    if ( $row ) return new Person( $row );
  }


  /**
  * Returns all (or range) of persons from the database
  *
  * @param int Optional Start row position (default 0)
  * @param int Optional The number of rows (default all)
  * @param string Optional The category filter id (default "null")
  * @param string Optional The sorting column of persons (default "nachname ASC")
  * @return Array|false Two-dimentional array: results => array, a list of persons; totalRows => total number of persons
  */

  public static function getList( $startFrom=0, $numRows=1000000, $category_id=null, $order="nachname ASC" ) {
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );
    $sql = "SELECT SQL_CALC_FOUND_ROWS PERSON.*, 
              BILDER.pfad AS bild_pfad, 
              BILDER.beschreibung AS bild_beschreibung,
              BILDER.link AS bild_link,
              GROUP_CONCAT(KATEGORIE.id SEPARATOR '|') AS kategorie_id,
              GROUP_CONCAT(KATEGORIE.name SEPARATOR '|') AS kategorie_name
            FROM person PERSON
              LEFT JOIN person_bilder PB
                ON PERSON.id = PB.person_id
              LEFT JOIN bilder BILDER
                ON BILDER.id = PB.bilder_id
              INNER JOIN person_kategorie PK
                -- ON PERSON.id = PK.person_id
                ON (PERSON.id = PK.person_id AND (:catId IS NULL OR PK.kategorie_id = :catId))
              INNER JOIN kategorie KATEGORIE
                ON KATEGORIE.id = PK.kategorie_id
              -- WHERE (:catId IS NULL OR PK.kategorie_id = :catId)
                -- ON (KATEGORIE.id = PK.kategorie_id AND (:catId IS NULL OR PK.kategorie_id = :catId))
                -- WHERE KATEGORIE.id IN (:catId)
            GROUP BY PERSON.id
            ORDER BY " . mysql_escape_string($order) . " LIMIT :startFrom, :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":startFrom", $startFrom, PDO::PARAM_INT );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->bindValue( ":catId", $category_id, PDO::PARAM_STR );

    $st->execute();
    $list = array();

    while ( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
      // echo '<pre>';
      // print_r($row);
      // echo '</pre>';
      $person = new Person( $row );
      $list[] = $person;
    }


    // Get the total number of entries that match the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows['totalRows'][0] ) );
  }



  /**
  * Returns a field of a table from the database
  *
  * @param string Table name
  * @param string Field names divided by comma
  * @return Array
  */

  public static function getFields($table, $field) {
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );
    $sql = 'SELECT DISTINCT ' . $field .
              ' FROM ' . $table . 
              ' GROUP BY ' . $field;

    $st = $conn->prepare( $sql );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
      $list[] = $row;
    }

    $conn = null;
    return $list;
  }



  /**
  * Returns possible values of a set
  *
  * @param string Table name
  * @param string Field of the table, which contains set
  * @return Array a list of set values
  */

  public function getSet($table, $field) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = 'SHOW COLUMNS FROM '.$table.' WHERE field="'.$field.'"';
    $row = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    $list = array();
    
    foreach( explode("','", substr($row['Type'],5,-2) ) as $option) { 
        $list[] = $option;
    }

    $conn = null;
    return $list;
  }



  /**
  * Inserts multiple images URLs to a database.
  *
  * @param string conn current connection taken from outer function
  * @param string person_id a person whom images will be deleted
  */
  public function insertImages($conn, $person_id) {
    $sql_image = "INSERT INTO bilder ( pfad ) VALUES ( :pfad )";
    $sql_relationships = "INSERT INTO person_bilder ( person_id, bilder_id ) VALUES ( :person_id, :bilder_id )";

    foreach ($_FILES['images']['name'] as $f => $name) {  

      if ($_FILES['images']['error'][$f] == 4) {
          continue; // Skip file if any error found
      }        

      if ($_FILES['images']['error'][$f] == 0) {            
          if ($_FILES['images']['size'][$f] > MAX_IMAGES_SIZE) {
              $message[] = "$name is too large!.";
              continue; // Skip large files
          }
          elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), unserialize (VALID_IMAGES)) ){
            $message[] = "$name is not a valid format";
            continue; // Skip invalid file formats
          }
          else{ // No error found! Move uploaded files 
              move_uploaded_file($_FILES["images"]["tmp_name"][$f], IMAGES_PATH.$name);

              $st = $conn->prepare ( $sql_image );
              $st->bindValue( ":pfad", $name, PDO::PARAM_STR );
              // $st->bindValue( ":beschreibung", $name, PDO::PARAM_STR );
              // $st->bindValue( ":link", $name, PDO::PARAM_STR );
              $st->execute();
              $bilder_id = $conn->lastInsertId();
              $this->id = $bilder_id;

              // Insert relationships
              $st = $conn->prepare ( $sql_relationships );
              $st->bindValue( ":person_id", $person_id, PDO::PARAM_INT );
              $st->bindValue( ":bilder_id", $bilder_id, PDO::PARAM_INT );
              $st->execute();
              $this->id = $conn->lastInsertId();
          }
      }
    }
  }



  /**
  * Paste the current object in a database, set its properties.
  */

  public function insert() {

    // Does an object have ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Person::insert(): Attempt to insert a person that already has its ID property set (to $this->id).", E_USER_ERROR );

    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );

    $sql_person = "INSERT INTO person ( vorname, nachname, geburtsdatum, todesdatum, geburtsort, todesort, titel, geschlecht, k_beschreibung, l_beschreibung ) VALUES ( :vorname, :nachname, :geburtsdatum, :todesdatum, :geburtsort, :todesort, :titel, :geschlecht, :k_beschreibung, :l_beschreibung );";

    // Insert person
    $st = $conn->prepare ( $sql_person );
    $st->bindValue( ":vorname", $this->vorname, PDO::PARAM_STR );
    $st->bindValue( ":nachname", $this->nachname, PDO::PARAM_STR );
    $st->bindValue( ":geburtsdatum", date('Y-m-d', $this->geburtsdatum), PDO::PARAM_STR );
    $st->bindValue( ":todesdatum", date('Y-m-d', $this->todesdatum), PDO::PARAM_STR );
    $st->bindValue( ":geburtsort", $this->geburtsort, PDO::PARAM_STR );
    $st->bindValue( ":todesort", $this->todesort, PDO::PARAM_STR );
    $st->bindValue( ":titel", $this->titel, PDO::PARAM_STR );
    $st->bindValue( ":geschlecht", $this->geschlecht, PDO::PARAM_STR );
    $st->bindValue( ":k_beschreibung", $this->k_beschreibung, PDO::PARAM_STR );
    $st->bindValue( ":l_beschreibung", $this->l_beschreibung, PDO::PARAM_STR );

    $st->execute();
    $person_id = $conn->lastInsertId();
    $this->id = $person_id;


    // Insert category connection
    $sql_category = "INSERT INTO person_kategorie (person_id, kategorie_id) VALUES (:person_id, :kategorie_id)";
    $st = $conn->prepare ( $sql_category );
    $st->bindValue( ":person_id", $person_id, PDO::PARAM_INT );
    $st->bindValue( ":kategorie_id", $this->kategorie_id, PDO::PARAM_INT );
    $st->execute();

    // Insert images
    Person::insertImages($conn, $person_id);

    $conn = null;
  }


  /**
  * Update the current object in the database
  */

  public function update() {
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    // Does an object have ID?
    if ( is_null( $this->id ) ) trigger_error ( "Person::update(): Attempt to update a person that does not have its ID property set.", E_USER_ERROR );
   
    
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );
    
    // Update person
    $sql_person = "UPDATE person SET vorname=:vorname, nachname=:nachname, geburtsdatum=:geburtsdatum, todesdatum=:todesdatum, geburtsort=:geburtsort, todesort=:todesort, titel=:titel, geschlecht=:geschlecht, k_beschreibung=:k_beschreibung, l_beschreibung=:l_beschreibung WHERE id = :id";

    $st = $conn->prepare ( $sql_person );
    $person_id = $this->id;

    $st->bindValue( ":id", $person_id, PDO::PARAM_INT );
    $st->bindValue( ":vorname", $this->vorname, PDO::PARAM_STR );
    $st->bindValue( ":nachname", $this->nachname, PDO::PARAM_STR );
    $st->bindValue( ":geburtsdatum", date('Y-m-d', $this->geburtsdatum), PDO::PARAM_STR );
    $st->bindValue( ":todesdatum", date('Y-m-d', $this->todesdatum), PDO::PARAM_STR );
    $st->bindValue( ":geburtsort", $this->geburtsort, PDO::PARAM_STR );
    $st->bindValue( ":todesort", $this->todesort, PDO::PARAM_STR );
    $st->bindValue( ":titel", $this->titel, PDO::PARAM_STR );
    $st->bindValue( ":geschlecht", $this->geschlecht, PDO::PARAM_STR );
    $st->bindValue( ":k_beschreibung", $this->k_beschreibung, PDO::PARAM_STR );
    $st->bindValue( ":l_beschreibung", $this->l_beschreibung, PDO::PARAM_STR );
    $st->execute(); 

    // Update category connection
    $sql_category = "UPDATE person_kategorie SET kategorie_id=:kategorie_id WHERE person_id=:person_id";
    $st = $conn->prepare ( $sql_category );
    $st->bindValue( ":person_id", $person_id, PDO::PARAM_INT );
    $st->bindValue( ":kategorie_id", $this->kategorie_id, PDO::PARAM_INT );
    $st->execute();

    // Delete images
    $images_ids_to_delete = str_replace('"', '\'', str_replace(array( '[', ']' ), '', $this->deleted_images_ids));
    $images_urls_to_delete = str_replace('"', '', str_replace(array( '[', ']' ), '', $this->deleted_images_urls));

    if(strlen($images_ids_to_delete) > 0) {
      // Delete images from database
      $sql_delete_images = "DELETE FROM bilder WHERE id in ($images_ids_to_delete)";
      $st = $conn->prepare ( $sql_delete_images );
      $st->execute();

      // Delete images from folder
      foreach (explode("|", $images_urls_to_delete) as $url) {
        unlink(IMAGES_PATH.$url);     
      }
    }

    // Insert images
    Person::insertImages($conn, $person_id);

    $conn = null;

  }


  /**
  * Remove the current object form the database
  */

  public function delete() {

    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    // Does an object have ID?
    if ( is_null( $this->id ) ) trigger_error ( "Person::delete(): Attempt to delete an Person object that does not have its ID property set.", E_USER_ERROR );

    // Remove person
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );
    $st = $conn->prepare ( "DELETE FROM person WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }



  /**
  * Make thumbnail of an image
  */
  public function cropImage($path, $file_name, $thumb_width, $thumb_height) {
    //  check if image exists
    if($file_name != '') {
      $image_path = $path .'/'. $file_name;
      $image = imagecreatefromjpeg($image_path);
      $cropped_image = $path.'/'.explode('.', $file_name)[0].'_'.$thumb_width.'_'.$thumb_height.'.jpg';

      if(!file_exists($cropped_image)) {
        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect )
        {
           // If image is wider than thumbnail (in aspect ratio sense)
           $new_height = $thumb_height;
           $new_width = $width / ($height / $thumb_height);
        }
        else
        {
           // If the thumbnail is wider than the image
           $new_width = $thumb_width;
           $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

        // Resize and crop
        imagecopyresampled($thumb,
                           $image,
                           0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                           0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                           0, 0,
                           $new_width, $new_height,
                           $width, $height);
        imagejpeg($thumb, $cropped_image, 100);      
      }

      return $cropped_image;
    
    } else {
      // if not exists - show default image
      return $path.'/no-image.jpg';
    } 
  } 

}
?>
