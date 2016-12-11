<?php

// load the system config 
require_once('config/system.php');

// register the autoloaders
require_once('framework/autoloader.php');
require 'vendor/autoload.php';
require_once('framework/lib/notorm/NotORM.php');

// create a new instance of the app and bootstrap it
$app = new Core\App();
$app->bootstrap();

// load the helper functions
require_once('framework/helpers.php');

// load the routing
require_once('framework/routes.php');
