<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/** 
 * Define Application Constants
 * - Change APP_PATH if required.
 */
define('APP_PATH', 'App/');

define('SITE_URL', 'http://localhost/blog/');

define('SRC_PATH', APP_PATH . 'Src/');
define('CONFIG_PATH', APP_PATH . 'config/');
define('ROUTE_PATH', APP_PATH . 'routes/');
define('TEMPLATE_PATH', 'Themes/default/views/');
define('HELPER_PATH', APP_PATH . 'helpers/');


/**
 * Load Slim
 * Load Idiorm
 * Load Bcrypt
 * Load Helpers
 * Load Validation -- @todo This should only happen for post routes
 */
require(SRC_PATH . 'Slim/Slim.php');
require(SRC_PATH . 'idiorm.php');
require(SRC_PATH . 'bcrypt.php');
require(HELPER_PATH . 'general.php');
require(SRC_PATH . 'notify.php');
require(SRC_PATH . 'validation.php');

$Validation = new Validation;



/** 
 * Configure Database
 */
require(CONFIG_PATH . 'database.php');

/**
 * Load Slim
 */
$app = new Slim(array(
	'debug' => true,
	'templates.path' => TEMPLATE_PATH
));

/** 
 * Load Routes
 */
require(ROUTE_PATH . 'user.php');
require(ROUTE_PATH . 'admin.php');
require(ROUTE_PATH . 'frontend.php');

/**
 * Run Slim
 */
$app->run();