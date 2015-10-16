<?php
ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=localhost;dbname=museum;charset=utf8" );
define( "DB_USERNAME", "admin" );
define( "DB_PASSWORD", "admin" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_PERSONS", 6 );
define( "PERSONS_PER_PAGE", 1 );
define( "ADMIN_USERNAME", "einhorn" );
define( "ADMIN_PASSWORD", "1a2s3d4f" );
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
