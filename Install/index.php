<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

define('APP_PATH', true);

require('resources/bcrypt.php');
require('resources/idiorm.php');

/**
 * Check Database is correct
 */
function check_db() {
	$db_correct = false;

	if ($_POST['db_name']) {
		$dsn = 'mysql:dbname='.$_POST['db_name'].';host='.$_POST['db_host'];
		$user = $_POST['db_user'];
		$password = $_POST['db_pass'];

		try {
		    $dbh = new PDO($dsn, $user, $password);
		    $db_correct = true;
		} catch (PDOException $e) {
		    $db_correct = false;
		}
	}

	return $db_correct;
}


if (isset($_GET['check'])) {
	if ( ! check_db()) {
		echo '<p class="error">The database connection details are incorrect</p>';
	}

	exit;
}

if (isset($_POST) && count($_POST)) {
	if ( ! isset($_POST['install'])) {
		if ( check_db()) {
			$install_path = str_replace(array(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, array_pop(explode(DIRECTORY_SEPARATOR, getcwd()))), '', getcwd());
			$config_path = $install_path . 'App/config/';

			// Write DB configuration file
			$database_string = '<?php if ( ! defined("APP_PATH")) exit("Permission Denied");

/**
 * Configure Database Connection
 */
ORM::configure("mysql:host='.$_POST['db_host'].';dbname='.$_POST['db_name'].'");
ORM::configure("username", "'.$_POST['db_user'].'");
ORM::configure("password", "'.$_POST['db_pass'].'");';

			$db_path = $config_path . 'database.php';
			if (is_writable($db_path)) {
			    if ( ! $handle = fopen($db_path, 'w')) {
			        exit('Failed to write database config file.');
			    }

			    if (fwrite($handle, $database_string) === FALSE) {
			        exit('Failed to write database config file.');
			    }

			    fclose($handle);
			} else {
			    exit('Failed to write database config file.');
			}

			// Install Database
			$dsn = 'mysql:dbname='.$_POST['db_name'].';host='.$_POST['db_host'];
			$user = $_POST['db_user'];
			$password = $_POST['db_pass'];
		    $dbh = new PDO($dsn, $user, $password);

			require('resources/install_schema.php');

			// Write User / Password
			$pass = BCrypt::hash($_POST['password']);
			$dbh->query("INSERT INTO `users` (email, hash) VALUES('{$_POST['email']}', '{$pass}')");

			// Constants
			$constant_path = $config_path . 'constants.php';

			if ( substr($_POST['url'], -1) !== '/') {
				$_POST['url'] .= '/';
			} 
			$constant_string = file_get_contents($constant_path) . "\n";
			$constant_string .= 'define("SITE_URL", "'.$_POST['url'].'");';

			if (is_writable($constant_path)) {
			    if ( ! $handle = fopen($constant_path, 'w')) {
			        exit('Failed to write constants config file.');
			    }

			    if (fwrite($handle, $constant_string) === FALSE) {
			        exit('Failed to write constants config file.');
			    }

			    fclose($handle);
			} else {
			    exit('Failed to write constants config file.');
			}

			echo 'Installed!';
			exit;
		} else {
			exit('Some details are incorrect. Please enable JavaScript to view the errors.');
		}
	} else {
		exit('False Submission detected.');
	}
}


require('resources/install.php');