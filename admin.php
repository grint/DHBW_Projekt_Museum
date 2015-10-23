<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";


$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

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

  if ( isset( $_POST['login'] ) ) {

    // The user receives a login form: an attempt to authenticate the user

    if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {

      // Login was successful: create a session and redirect to the administrator page
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" );

    } else {

      // Login failed: print an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

  } else {

    // This user has not yet received the form: withdrawal form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }

}


function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}


function newPerson() {

  $results = array();
  $results['pageTitle'] = "New Person";
  $results['formAction'] = "newPerson";

  if ( isset( $_POST['saveChanges'] ) ) {

    // The user receives the editing form: save a new person
    $person = new Person;
    $person->storeFormValues( $_POST );
    $person->insert();
    header( "Location: admin.php?status=changesSaved" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // Resetting the results of editing: back to the list of persons
    header( "Location: admin.php" );
  } else {

    // This user has not yet received the edit form: withdrawal form
    $results['person'] = new Person;
    require( TEMPLATE_PATH . "/admin/editPerson.php" );
  }

}


function editPerson() {

  $results = array();
  $results['pageTitle'] = "Edit Person";
  $results['formAction'] = "editPerson";

  if ( isset( $_POST['saveChanges'] ) ) {

    // The user received the edit form of the person: save changes

    if ( !$person = Person::getById( (int)$_POST['personId'] ) ) {
      header( "Location: admin.php?error=personNotFound" );
      return;
    }

    $person->storeFormValues( $_POST );
    $person->update();
    header( "Location: admin.php?status=changesSaved" );

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
    header( "Location: admin.php?error=personNotFound" );
    return;
  }

  $person->delete();
  header( "Location: admin.php?status=personDeleted" );
}


function listPersons() {
  $results = array();
  $data = Person::getList();
  $results['persons'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Alle Informatiker";

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "personNotFound" ) $results['errorMessage'] = "Error: Informatiker not found.";
  }

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "personDeleted" ) $results['statusMessage'] = "Person deleted.";
  }

  require( TEMPLATE_PATH . "/admin/listPersons.php" );
}

?>
