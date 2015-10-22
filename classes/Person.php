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

  public $bild_pfad = null;
  public $bild_beschreibung = null;
  public $bild_link = null;


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

    if ( isset( $data['bild_pfad'] ) )          $this->bild_pfad = $data['bild_pfad'];
    if ( isset( $data['bild_beschreibung'] ) )  $this->bild_beschreibung = $data['bild_beschreibung'];
    if ( isset( $data['bild_link'] ) )          $this->bild_link = $data['bild_link'];
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
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );

    $sql = "SELECT PERSON.*, 
              BILDER.pfad AS bild_pfad, 
              BILDER.beschreibung AS bild_beschreibung,
              BILDER.link AS bild_link
            FROM person PERSON
              INNER JOIN person_bilder PB
                ON PERSON.id = PB.person_id
              INNER JOIN bilder BILDER
                ON BILDER.id = PB.bilder_id
            WHERE PERSON.id = :id";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Person( $row );
  }


  /**
  * Returns all (or range) of objects in the database
  *
  * @param int Optional Start row position (default 0)
  * @param int Optional The number of rows (default all)
  * @param string Optional The sorting column of persons (default "nachname ASC")
  * @return Array|false Two-dimentional array: results => array, a list of persons; totalRows => total number of persons
  */

  public static function getList( $startFrom=0, $numRows=1000000, $order="nachname ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS PERSON.*, 
              BILDER.pfad AS bild_pfad, 
              BILDER.beschreibung AS bild_beschreibung,
              BILDER.link AS bild_link
            FROM person PERSON
              INNER JOIN person_bilder PB
                ON PERSON.id = PB.person_id
              INNER JOIN bilder BILDER
                ON BILDER.id = PB.bilder_id
            GROUP BY PERSON.id
            ORDER BY " . mysql_escape_string($order) . " LIMIT :startFrom, :numRows";

    $st = $conn->prepare( $sql );
    $st->bindValue( ":startFrom", $startFrom, PDO::PARAM_INT );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
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
  * Paste the current object in a database, set its properties.
  */

  public function insert() {

    // Does an object have ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Person::insert(): Attempt to insert an Person object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert person
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO person ( geburtsdatum, nachname, k_beschreibung, l_beschreibung ) VALUES ( :geburtsdatum, :nachname, :k_beschreibung, :l_beschreibung )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":geburtsdatum", $this->geburtsdatum, PDO::PARAM_INT );
    $st->bindValue( ":nachname", $this->nachname, PDO::PARAM_STR );
    $st->bindValue( ":k_beschreibung", $this->k_beschreibung, PDO::PARAM_STR );
    $st->bindValue( ":l_beschreibung", $this->l_beschreibung, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  /**
  * Update the current object in the database
  */

  public function update() {

    // Does an object have ID?
    if ( is_null( $this->id ) ) trigger_error ( "Person::update(): Attempt to update an Person object that does not have its ID property set.", E_USER_ERROR );
   
    // Update person
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE person SET geburtsdatum=:geburtsdatum, nachname=:nachname, k_beschreibung=:k_beschreibung, l_beschreibung=:l_beschreibung WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":geburtsdatum", $this->geburtsdatum, PDO::PARAM_INT );
    $st->bindValue( ":nachname", $this->nachname, PDO::PARAM_STR );
    $st->bindValue( ":k_beschreibung", $this->k_beschreibung, PDO::PARAM_STR );
    $st->bindValue( ":l_beschreibung", $this->l_beschreibung, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }


  /**
  * Remove the current object form the database
  */

  public function delete() {

    // Does an object have ID?
    if ( is_null( $this->id ) ) trigger_error ( "Person::delete(): Attempt to delete an Person object that does not have its ID property set.", E_USER_ERROR );

    // Remove person
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM person WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }



  /**
  * Make thumbnail of an image
  */
  public function cropImage($path, $file_name, $thumb_width, $thumb_height) {
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
  } 

}
?>
