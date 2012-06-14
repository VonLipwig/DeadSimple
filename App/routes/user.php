<?php if ( ! defined('APP_PATH')) exit('Permission Denied');

/** 
 * Check if user is an admin
 */
$authCheck = function() use ($app) {
	if ( ! is_admin()) {
		echo 'Get Out!';
		exit;
	}
};

/**
 * Show Login View
 */
$app->get('/user/login', function() use ($app) {
	// If user is logged in already -> redirect
	if ( isset($_SESSION['user'])) {
		Notify::store('Logged in users are not allowed to access the login form.');
		return $app->redirect(site_url());
	}

	// Show View
	if (is_ajax())
	{
		return $app->render('login.php');
	}
	else
	{
		return $app->render('template.php', array(
			'app' => $app,
			'view' => 'login.php'
		));
	}
});

/**
 * Process Login 
 */
$app->post('/user/login', function() use ($app, $Validation) {

	$Validation->check('email', 'required|email');
	$Validation->check('password', 'required');

	if ( ! $Validation->run()) {
		$Validation->notify();
		return $app->redirect(site_url('user/login'));
	}

	// If user is logged in already -> redirect
	if ( isset($_SESSION['user'])) {
		Notify::store('Logged in users are not allowed to access the login form.');
		return $app->redirect(site_url());
	}

	// Find user by email
	$user = ORM::for_table('users')->where('email', $_POST['email'])->find_one();

	// If user doesn't exist -> redirect
	if ( ! $user) {
		Notify::store('The login details provided are incorrect', 'error');
		return $app->redirect(site_url('user/login'));
	}

	// Check Password / Set session
	if (Bcrypt::check($_POST['password'], $user->hash)) {
		$_SESSION['user'] = true;
		return $app->redirect(site_url());
	}

	// Details are incorrect -> redirect
	Notify::store('The login details provided are incorrect', 'error');
	return $app->redirect(site_url('user/login'));
});

/**
 * Process Logout
 */
$app->get('/user/logout', $authCheck, function() use ($app) {
	
	// Unset session -> redirect
	unset($_SESSION['user']);
	return $app->redirect(site_url());
});