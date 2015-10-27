<?php

/**
 * Class for processing persons
 */

class Person
{
  // set variables of the class
  
  // person data
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

  // image data
  public $bild_id = null;
  public $bild_pfad = null;
  public $bild_beschreibung = null;
  public $bild_link = null;
  public $deleted_images_ids = null;
  public $deleted_images_urls = null;

  // category data
  public $kategorie_id = null;
  public $kategorie_name = null;

  // source data
  public $quelle_titel = null;
  public $quelle_isbn = null;
  public $quelle_link = null;
  public $quelle_typ = null;
  public $quelle_jahr = null;
  public $quelle_autor = null;
  public $quelle_verlag = null;

  // citation data
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

    if ( isset( $data['id'] ) )                   $this->id = (int) htmlspecialchars($data['id']);
    if ( isset( $data['vorname'] ) )              $this->vorname = htmlspecialchars($data['vorname']);
    if ( isset( $data['nachname'] ) )             $this->nachname = htmlspecialchars($data['nachname']);
    if ( isset( $data['geburtsdatum'] ) )         $this->geburtsdatum = htmlspecialchars($data['geburtsdatum']);
    if ( isset( $data['geburtsort'] ) )           $this->geburtsort = htmlspecialchars($data['geburtsort']);
    if ( isset( $data['todesdatum'] ) )           $this->todesdatum = htmlspecialchars($data['todesdatum']);
    if ( isset( $data['todesort'] ) )             $this->todesort = htmlspecialchars($data['todesort']);
    if ( isset( $data['k_beschreibung'] ) )       $this->k_beschreibung = htmlspecialchars($data['k_beschreibung']);
    if ( isset( $data['l_beschreibung'] ) )       $this->l_beschreibung = htmlspecialchars($data['l_beschreibung']);
    if ( isset( $data['titel'] ) )                $this->titel = htmlspecialchars($data['titel']);
    if ( isset( $data['geschlecht'] ) )           $this->geschlecht = htmlspecialchars($data['geschlecht']);

    if ( isset( $data['kategorie_id'] ) )         $this->kategorie_id = htmlspecialchars($data['kategorie_id']);
    if ( isset( $data['kategorie_name'] ) )       $this->kategorie_name = htmlspecialchars($data['kategorie_name']);

    if ( isset( $data['bild_id'] ) )              $this->bild_id = htmlspecialchars($data['bild_id']);
    if ( isset( $data['bild_pfad'] ) )            $this->bild_pfad = htmlspecialchars($data['bild_pfad']);
    if ( isset( $data['bild_beschreibung'] ) )    $this->bild_beschreibung = htmlspecialchars($data['bild_beschreibung']);
    if ( isset( $data['bild_link'] ) )            $this->bild_link = htmlspecialchars($data['bild_link']);
    if ( isset( $data['deleted_images_ids'] ) )   $this->deleted_images_ids = htmlspecialchars($data['deleted_images_ids']);
    if ( isset( $data['deleted_images_urls'] ) )  $this->deleted_images_urls = htmlspecialchars($data['deleted_images_urls']);

    if ( isset( $data['quelle_titel'] ) )         $this->quelle_titel = htmlspecialchars($data['quelle_titel']);
    if ( isset( $data['quelle_isbn'] ) )          $this->quelle_isbn = htmlspecialchars($data['quelle_isbn']);
    if ( isset( $data['quelle_link'] ) )          $this->quelle_link = htmlspecialchars($data['quelle_link']);
    if ( isset( $data['quelle_typ'] ) )           $this->quelle_typ = htmlspecialchars($data['quelle_typ']);
    if ( isset( $data['quelle_jahr'] ) )          $this->quelle_jahr = htmlspecialchars($data['quelle_jahr']);
    if ( isset( $data['quelle_autor'] ) )         $this->quelle_autor = htmlspecialchars($data['quelle_autor']);
    if ( isset( $data['quelle_verlag'] ) )        $this->quelle_verlag = htmlspecialchars($data['quelle_verlag']);

    if ( isset( $data['zitat_text'] ) )           $this->zitat_text = htmlspecialchars($data['zitat_text']);
    if ( isset( $data['zitat_quelle'] ) )         $this->zitat_quelle = htmlspecialchars($data['zitat_quelle']);
    if ( isset( $data['zitat_link'] ) )           $this->zitat_link = htmlspecialchars($data['zitat_link']);
    if ( isset( $data['zitat_jahr'] ) )           $this->zitat_jahr = htmlspecialchars($data['zitat_jahr']);
    if ( isset( $data['zitat_seite'] ) )          $this->zitat_seite = htmlspecialchars($data['zitat_seite']);
  }


  /**
  * Return a Person object corresponding to the specified Person ID
  *
  * @param int ID of the person
  * @return Person|false Person object or false, if the record is not found or there're problems
  */

  public static function getById( $id ) {
    // catch errors
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
            -- include categories, all persons have a category, therefore inner join
            INNER JOIN person_kategorie AS PK
              ON person.id = PK.person_id
            INNER JOIN kategorie AS KATEGORIE
              ON KATEGORIE.id = PK.kategorie_id

            -- include citations
            LEFT JOIN (
              SELECT 
                person.id as PersonId,
                GROUP_CONCAT(zitat.text SEPARATOR '|') AS zitat_text,
                GROUP_CONCAT(IFNULL(zitat.quelle, 'NULL') SEPARATOR '|') AS zitat_quelle,
                GROUP_CONCAT(IFNULL(zitat.link, 'NULL') SEPARATOR '|') AS zitat_link,
                GROUP_CONCAT(IFNULL(zitat.jahr, 'NULL') SEPARATOR '|') AS zitat_jahr,
                GROUP_CONCAT(IFNULL(zitat.seite, 'NULL') SEPARATOR '|') AS zitat_seite
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
                GROUP_CONCAT(IFNULL(bilder.beschreibung, 'NULL') SEPARATOR '|') AS bild_beschreibung,
                GROUP_CONCAT(IFNULL(bilder.link, 'NULL') SEPARATOR '|') AS bild_link,
                GROUP_CONCAT(bilder.pfad SEPARATOR '|') AS bild_pfad
               FROM person
               LEFT JOIN person_bilder
                  ON person.id = person_bilder.person_id
               LEFT JOIN bilder
                  ON bilder.id = person_bilder.bilder_id
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
    $conn = null;
    if ( $row ) return new Person( $row );
  }



  public static function getByKeyword( $keyword ) {
    // catch errors
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );

    $sql = "SELECT *
              FROM person

                -- include categories
                LEFT JOIN (
                  SELECT 
                    person.id as PersonId,
                    GROUP_CONCAT(kategorie.id SEPARATOR '|') AS kategorie_id,
                    GROUP_CONCAT(kategorie.name SEPARATOR '|') AS kategorie_name
                   FROM person
                   LEFT JOIN person_kategorie
                      ON person.id = person_kategorie.person_id
                   LEFT JOIN kategorie
                      ON kategorie.id = person_kategorie.kategorie_id
                   GROUP BY person.id
                  ) AS KATEGORIE on person.id = KATEGORIE.PersonId

                -- include images
                LEFT JOIN (
                  SELECT 
                    person.id as PersonId,
                    GROUP_CONCAT(bilder.id SEPARATOR '|') AS bild_id,
                    GROUP_CONCAT(IFNULL(bilder.beschreibung, 'NULL') SEPARATOR '|') AS bild_beschreibung,
                    GROUP_CONCAT(IFNULL(bilder.link, 'NULL') SEPARATOR '|') AS bild_link,
                    GROUP_CONCAT(bilder.pfad SEPARATOR '|') AS bild_pfad
                   FROM person
                   LEFT JOIN person_bilder
                      ON person.id = person_bilder.person_id
                   LEFT JOIN bilder
                      ON bilder.id = person_bilder.bilder_id
                   GROUP BY person.id
                  ) AS BILDER on person.id = BILDER.PersonId

              WHERE (person.id LIKE '%" . $keyword . "%') 
                OR (person.nachname LIKE '%" . $keyword . "%') 
                OR (person.vorname LIKE '%" . $keyword . "%')";

    $list = array();

    $st = $conn->prepare( $sql );
    $st->execute();

    while ( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
      $person = new Person( $row );
      $list[] = $person;
    }

    // echo '<pre>';
    // print_r($list);
    // echo '</pre>';

    // Get the total number of entries that match the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();

    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows['totalRows'][0] ) );
  }



  /**
  * Returns all (or range) of persons from the database
  *
  * @param int Optional Start row position (default 0)
  * @param int Optional The number of rows (default all)
  * @param string Optional The category id for filtering (default null)
  * @param string Optional The sorting column of persons (default "nachname ASC")
  * @return Array|false Two-dimentional array: results => array, a list of persons; totalRows => total number of persons
  */

  public static function getList( $startFrom=0, $numRows=1000000, $category_id=null, $order="nachname ASC" ) {
    // catch errors
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
              -- include images
              LEFT JOIN person_bilder PB
                ON PERSON.id = PB.person_id
              LEFT JOIN bilder BILDER
                ON BILDER.id = PB.bilder_id
              -- include categories
              INNER JOIN person_kategorie PK
                ON (PERSON.id = PK.person_id AND (:catId IS NULL OR PK.kategorie_id = :catId))
              INNER JOIN kategorie KATEGORIE
                ON KATEGORIE.id = PK.kategorie_id
            GROUP BY PERSON.id
            ORDER BY " . mysql_escape_string($order) . " LIMIT :startFrom, :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":startFrom", $startFrom, PDO::PARAM_INT );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->bindValue( ":catId", $category_id, PDO::PARAM_STR );
    $st->execute();

    $list = array();
    while ( $row = $st->fetch(PDO::FETCH_ASSOC) ) {
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
    // catch errors
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
  * Returns values of a set from the database
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
  * @param string current connection taken from an outer function
  * @param string a person id whose images will be deleted
  */
  public function insertImages($conn, $person_id) {
    $sql_image = "INSERT INTO bilder ( pfad ) VALUES ( :pfad )";
    $sql_relationships = "INSERT INTO person_bilder ( person_id, bilder_id ) VALUES ( :person_id, :bilder_id )";

    foreach ($_FILES['images']['name'] as $f => $name) {  

      // check image type for a security reasons
      $image_type = Person::test_image_type($_FILES['images']['tmp_name'][$f]);

      if ($_FILES['images']['error'][$f] == 4) {
          return false;                                                                                 // if no file uploaded
      }        
      else if ($_FILES['images']['error'][$f] == 0) {                                                   // upload is successfull
        if ( $_FILES['images']['size'][$f] < MIN_IMAGES_SIZE ) {                                        // skip if less as 11 Byte
          $message = "$name is too small.";
          return false;
        }
        else if ($_FILES['images']['size'][$f] > MAX_IMAGES_SIZE) {                                     // skip if more as 1000 KByte
          $message = "$name is too large.";
          return false;
        }
        else if ($image_type == false) {                                                                // skip invalid file formats
          $message = "$name has wrong format.";
          return false;
        }
        else {                                                                                          // No error found! Move uploaded files 
          // upload file to a folder
          move_uploaded_file($_FILES["images"]["tmp_name"][$f], IMAGES_PATH.$name);

          // Insert image to the database
          $st = $conn->prepare ( $sql_image );
          $st->bindValue( ":pfad", $name, PDO::PARAM_STR );
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
  * Check image type
  *
  * @param string $type - type of an image from $_FILES['images']['tmp_name']
  * @return image type | false 
  */
  public function test_image_type($type) {
    $number = exif_imagetype($type);
    switch ($number) {
      case 1:
      case IMAGETYPE_GIF:       return 'gif'; break;
      case 2:
      case IMAGETYPE_JPEG:      return 'jpg'; break;
      case 3:
      case IMAGETYPE_PNG:       return 'png'; break;
      case 4:
      case IMAGETYPE_SWF:       return false; break;
      case 5:
      case IMAGETYPE_PSD:       return false; break;
      case 6:
      case IMAGETYPE_BMP:       return false; break;
      case 7:
      case IMAGETYPE_TIFF_II:   return false; break;
      case 8:
      case IMAGETYPE_TIFF_MM:   return false; break;
      case 9:
      case IMAGETYPE_JPC:       return false; break;
      case 10:
      case IMAGETYPE_JP2:       return false; break;
      case 11:
      case IMAGETYPE_JPX:       return false; break;
      case 12:
      case IMAGETYPE_JB2:       return false; break;
      case 13:
      case IMAGETYPE_SWC:       return false; break;
      case 14:
      case IMAGETYPE_IFF:       return false; break;
      case 15:
      case IMAGETYPE_WBMP:      return false; break;
      case 16:
      case IMAGETYPE_XBM:       return false; break;
      case 17:
      case IMAGETYPE_ICO:       return false; break;
      default:                  return false; break;
    }
  }


  /**
  * Paste the current object in a database, set its properties.
  */
  public function insert() {

    // Does an object have ID?
    if ( !is_null( $this->id ) ) trigger_error ( 
      "Person::insert(): Attempt to insert a person that already has its ID property set (to $this->id).", E_USER_ERROR );

    // catch errors
    $opt = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );

    $sql_person = "INSERT INTO 
                    person ( vorname, nachname, geburtsdatum, todesdatum, geburtsort, 
                            todesort, titel, geschlecht, k_beschreibung, l_beschreibung ) 
                    VALUES ( :vorname, :nachname, :geburtsdatum, :todesdatum, :geburtsort, 
                            :todesort, :titel, :geschlecht, :k_beschreibung, :l_beschreibung );";

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
    // catch errors
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    // Does an object have ID?
    if ( is_null( $this->id ) ) trigger_error ( 
      "Person::update(): Attempt to update a person that does not have its ID property set.", E_USER_ERROR );
   
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $opt );
    
    // Update person
    $sql_person = "UPDATE person 
                    SET vorname=:vorname, nachname=:nachname, geburtsdatum=:geburtsdatum, 
                        todesdatum=:todesdatum, geburtsort=:geburtsort, todesort=:todesort, 
                        titel=:titel, geschlecht=:geschlecht, k_beschreibung=:k_beschreibung, 
                        l_beschreibung=:l_beschreibung 
                    WHERE id = :id";

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
      // Delete images from the database
      $sql_delete_images = "DELETE FROM bilder WHERE id in ($images_ids_to_delete)";
      $st = $conn->prepare ( $sql_delete_images );
      $st->execute();

      // Delete images from the folder
      foreach (explode("|", $images_urls_to_delete) as $url) {
        unlink(IMAGES_PATH.$url);     
      }
    }

    // Insert new mages
    Person::insertImages($conn, $person_id);

    $conn = null;
  }


  /**
  * Remove the current object form the database
  */
  public function delete() {

    // catch errors
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    // Does an object have ID?
    if ( is_null( $this->id ) ) trigger_error ( 
      "Person::delete(): Attempt to delete an Person object that does not have its ID property set.", E_USER_ERROR );

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
    //  check if image name is not empty
    if($file_name != '') {
      $image_path = $path .'/'. $file_name;
      $image = imagecreatefromjpeg($image_path);
      $cropped_image = $path.'/'.explode('.', $file_name)[0].'_'.$thumb_width.'_'.$thumb_height.'.jpg';

      //  check if cropped version exists
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
      // if image name empty - show default image
      return $path.'/no-image.jpg';
    } 
  } 
}
?>