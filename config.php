<?php
ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=localhost;dbname=museum;charset=utf8" );
define( "DB_USERNAME", "it" );
define( "DB_PASSWORD", "nekane27" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_PERSONS", 6 );
define( "PERSONS_PER_PAGE", 6 );
define( "USER_USERNAME", "user" );
define( "USER_PASSWORD", "user" );
define( "ADMIN_USERNAME", "einhorn" );
define( "ADMIN_PASSWORD", "1a2s3d4f" );
define( "VALID_IMAGES", serialize (array("jpeg","jpg","png","gif")) );
define( "MAX_IMAGES_SIZE", 1024*1000 ); // 1000 kb
define( "IMAGES_PATH", "/home/hamster/WWW/dhbw-museum/img/persons/" ); // on server - /img/persons/
require( CLASS_PATH . "/Person.php" );
require( CLASS_PATH . "/Log.php" );

function handleException($ex) {
  $log = new MyLogPHP('./site_errors.log');
  $log->error($ex->getMessage());
  showError();
}

function showError() {
  require( "error.php" );
}

set_exception_handler( 'handleException' );

?>
