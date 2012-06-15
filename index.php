<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/** 
 * Define Application Constants
 * - Change APP_PATH if required.
 */
define('APP_PATH', 'App/');
require(APP_PATH . 'config/constants.php');


if (file_exists('Install')) {
	exit('Please remove the install directory from this installation');
} elseif ( ! defined('SITE_URL')) {
	exit('This website is not properly installed.');
}

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