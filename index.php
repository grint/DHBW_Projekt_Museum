<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$user_name = isset( $_SESSION['user_name'] ) ? $_SESSION['user_name'] : "";
$admin_name = isset( $_SESSION['admin_name'] ) ? $_SESSION['admin_name'] : "";

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

if ( $action != "login" && $action != "logout" && !$user_name  && !$admin_name ) {
  login();
  exit;
}

$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'allPersons':
    allPersons();
    break;
  case 'viewPerson':
    viewPerson();
    break;
  case 'viewModal':
    viewModal();
    break;
  case 'search':
    search();
    break;
  default:
    homepage();
}

function login() {
  $results = array();
  $results['pageTitle'] = "User Login";
  $results['formAction'] = "index.php?action=login";
  $results['sessionType'] = "user";

  if ( isset( $_POST['login'] ) ) {

    // The user receives a login form: an attempt to authenticate the user
    if ( $_POST['user_name'] == USER_USERNAME && $_POST['user_password'] == USER_PASSWORD ) {
      // Login as user was successful: create a session and redirect to the main page
      $_SESSION['user_name'] = USER_USERNAME;
      header( "Location: index.php" );

    } else if ( $_POST['user_name'] == ADMIN_USERNAME && $_POST['user_password'] == ADMIN_PASSWORD ) {
      // Login as admin was successful: create a session and redirect to the main page
      $_SESSION['user_name'] = USER_USERNAME;
      $_SESSION['user_name'] = ADMIN_USERNAME;
      header( "Location: index.php" );

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
  unset( $_SESSION['user_name'] );
  unset( $_SESSION['admin_name'] );
  header( "Location: index.php" );
}



function allPersons() {
  $results = array();

  if (isset($_GET["page"])) { 
    $page  = $_GET["page"]; 
    $start_from = ($page - 1) * PERSONS_PER_PAGE; 
    $data = Person::getList($start_from, PERSONS_PER_PAGE);
  } 
  else if (isset($_GET["category"])) { 
    $category  = $_GET["category"]; 
    $data = Person::getList(0, PERSONS_PER_PAGE, $category);
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



function search() {



  $results = array();

  if (isset($_GET['q'])) {
    // remove any html/javascript and converto to lower
    $query = strtolower(strip_tags(trim($_GET['q'])));
   
    if ($query !== "" && strlen($query) >= 1) {
      $data = Person::getByKeyword(htmlspecialchars($query)); // prevent sql injection.

      $results['persons'] = $data['results'];
      $results['totalRows'] = $data['totalRows'];
      $results['pageTitle'] = "Suche";
    }
  }

  require( TEMPLATE_PATH . "/search.php" );
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
