<?php if ( ! defined('APP_PATH')) exit('Permission Denied');

/**
 * Return the site url + whatever extension
 */
function site_url($path='') {
	return SITE_URL . $path;
}

/**
 * Check if user is an administrator or not
 */
function is_admin() {
	return isset($_SESSION['user']);
}

/**
 * Check if request is an ajax request
 */
function is_ajax() {
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
}

/**
 * Return Human Readable Date
 */
function readable_date($date, $strtotime=true) {
	$time = ($strtotime) ? strtotime($date) : $date;

	return date("F j, Y", strtotime($time));
}

/**
 * If created is not the same as updated show the last update time.
 */
function last_updated($created, $updated) {
	if ($created != $updated) {
		return 'Last updated on ' . date("F j, Y", strtotime($updated)) .'.';
	}
}