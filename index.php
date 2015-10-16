<?php

require( "config.php" );
session_start();
// require( TEMPLATE_PATH . "/lang/language.php" );

if(isSet($_GET['lang'])) {
  $GLOBALS['lang'] = $_GET['lang'];
  // register the session and set the cookie
  $_SESSION['lang'] = $GLOBALS['lang'];
  setcookie('lang', $GLOBALS['lang'], time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang'])) {
  $GLOBALS['lang'] = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang'])) {
  $GLOBALS['lang'] = $_COOKIE['lang'];
}
else {
  $GLOBALS['lang'] = 'de';
}
 
require( TEMPLATE_PATH . '/lang/lang.'.$GLOBALS['lang'].'.php' );


$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
  case 'allPersons':
    allPersons();
    break;
  case 'viewPerson':
    viewPerson();
    break;
  case 'viewModal':
    viewModal();
    break;
  default:
    homepage();
}

function allPersons() {
  $results = array();
  if (isset($_GET["page"])) { 
    $page  = $_GET["page"]; 
    $start_from = ($page - 1) * PERSONS_PER_PAGE; 
    $data = Person::getList($start_from, PERSONS_PER_PAGE);
  } 
  else { 
    $data = Person::getList(0, PERSONS_PER_PAGE);
  };

  $results['persons'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['totalPages'] = ceil($results['totalRows'] / PERSONS_PER_PAGE);
  $results['pageTitle'] = "Alle Informatiker";
  require( TEMPLATE_PATH . "/allPersons.php" );
}

function viewModal() {
  if ( !isset($_GET["personId"]) || !$_GET["personId"] ) {
    homepage();
    return;
  }
  $results = array();
  $results['person'] = Person::getById( (int)$_GET["personId"] );
  $results['pageTitle'] = $results['person']->nachname;
  require( TEMPLATE_PATH . "/viewModal.php" );
}

function viewPerson() {
  if ( !isset($_GET["personId"]) || !$_GET["personId"] ) {
    homepage();
    return;
  }
  $results = array();
  $results['person'] = Person::getById( (int)$_GET["personId"] );
  $results['pageTitle'] = $results['person']->nachname;
  require( TEMPLATE_PATH . "/viewPerson.php" );
}

function homepage() {
  $results = array();
  $data = Person::getList(0, HOMEPAGE_NUM_PERSONS );
  $results['persons'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Informatiker";
  require( TEMPLATE_PATH . "/homepage.php" );
}

?>
