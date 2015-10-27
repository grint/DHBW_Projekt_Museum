<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

$username = isset( $_SESSION['admin_name'] ) ? $_SESSION['admin_name'] : "";

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


if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}


switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'viewPerson':
    viewPerson();
    break;
  case 'newPerson':
    newPerson();
    break;
  case 'viewModal':
    viewModal();
    break;
  case 'editPerson':
    editPerson();
    break;
  case 'deletePerson':
    deletePerson();
    break;
  default:
    listPersons();
}


function login() {

  $results = array();
  $results['pageTitle'] = "Admin Login";
  $results['formAction'] = "/admin/login";
  $results['sessionType'] = "admin";

  if ( isset( $_POST['login'] ) ) {

    // The user receives a login form: an attempt to authenticate the user

    if ( $_POST['admin_name'] == ADMIN_USERNAME && $_POST['admin_password'] == ADMIN_PASSWORD ) {

      // Login was successful: create a session and redirect to the administrator page
      $_SESSION['admin_name'] = ADMIN_USERNAME;
      header( "Location: admin.php" );

    } else {

      // Login failed: print an error message to the user
      $results['errorMessage'] = WRONG_LOGIN;
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

  } else {

    // This user has not yet received the form: withdrawal form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }

}


function logout() {
  unset( $_SESSION['admin_name'] );
  header( "Location: admin.php" );
}


function newPerson() {

  $results = array();
  $results['pageTitle'] = NEW_PERSON;
  $results['formAction'] = "newPerson";

  if ( isset( $_POST['saveChanges'] ) ) {

    // The user receives the editing form: save a new person
    $person = new Person;
    $person->storeFormValues( $_POST );
    $person->insert();
    header( "Location: /admin/changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // Resetting the results of editing: back to the list of persons
    header( "Location: /admin/" );
  } else {

    // This user has not yet received the edit form: withdrawal form
    $results['person'] = new Person;
    require( TEMPLATE_PATH . "/admin/editPerson.php" );
  }

}


function editPerson() {

  $results = array();
  $results['pageTitle'] = EDIT_PERSON;
  $results['formAction'] = "editPerson";

  if ( isset( $_POST['saveChanges'] ) ) {

    // The user received the edit form of the person: save changes

    if ( !$person = Person::getById( (int)$_POST['personId'] ) ) {
      header( "Location: /admin/personNotFound" );
      return;
    }

    $person->storeFormValues( $_POST );
    $person->update();
    header( "Location: /admin/changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User refused the edit results: return to the list of persons
    header( "Location: admin.php" );
  } else {

    // This user has not yet received the edit form: withdrawal form
    $results['person'] = Person::getById( (int)$_GET['personId'] );
    require( TEMPLATE_PATH . "/admin/editPerson.php" );
  }

}


function deletePerson() {

  if ( !$person = Person::getById( (int)$_GET['personId'] ) ) {
    header( "Location: /admin.php/personNotFound" );
    return;
  }

  $person->delete();
  header( "Location: /admin/personDeleted" );
}


function listPersons() {
  $results = array();
  $data = Person::getList();
  $results['persons'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = ALL_COMPUTER_SCIENTIST;

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "personNotFound" ) $results['errorMessage'] = PERSON_NOT_FOUND;
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = CHANGES_SAVED;
    if ( $_GET['status'] == "personDeleted" ) $results['statusMessage'] = PERSON_DELETED;
  }

  require( TEMPLATE_PATH . "/admin/listPersons.php" );
}

?>
