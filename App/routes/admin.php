<?php if ( ! defined('APP_PATH')) exit('Permission Denied');

/**
 * Show Create post view.
 */
$app->get('/admin/posts/create', $authCheck, function() use ($app) {
	
	if (is_ajax())
	{
		return $app->render('admin/create_post.php');
	}
	else
	{
		return $app->render('template.php', array(
			'app' => $app,
			'disable_create_button' => true,
			'view' => 'admin/create_post.php'
		));
	}
});

/**
 * Process Create Post
 */
$app->post('/admin/posts/create', $authCheck, function() use ($app, $Validation) {
	
	$Validation->check('title', 'required');

	if ( ! $Validation->run()) {
		$Validation->notify();
		return $app->redirect(site_url('/admin/posts/create'));
	}

	// Save Post
	$post = ORM::for_table('posts')->create();
	$post->title = $_POST['title'];
	$post->content = $_POST['create-content'];
	$post->keep_raw('created');
	$post->created = 'NOW()';
	$post->save();

	$app->redirect(SITE_URL);
});

/**
 * Show Edit post view.
 */
$app->get('/admin/posts/edit/(:id)', $authCheck, function($id) use ($app) {

	// If post doesn't exist get out of here.
	$post = ORM::for_table('posts')->find_one($id);	
	if ( ! $post)
	{
		return is_ajax() ? false : $app->redirect(SITE_URL);
	}

	// Show View File
	if (is_ajax())
	{
		return $app->render('admin/edit_post.php', array(
			'post' => $post
		));
	}
	else
	{
		return $app->render('template.php', array(
			'app' => $app,
			'post' => $post,
			'view' => 'admin/edit_post.php'
		));
	}
});

/**
 * Process Edit Post
 */
$app->post('/admin/posts/edit/(:id)', $authCheck, function($id) use ($app, $Validation) {

	$Validation->check('title', 'required');

	if ( ! $Validation->run()) {
		$Validation->notify();
		return $app->redirect(site_url('/admin/posts/create'));
	}

	// Check Post Exists
	$post = ORM::for_table('posts')->find_one($id);
	if ($post)
	{
		$post->title = $_POST['title'];
		$post->content = $_POST['edit-content'];
		$post->save();
		return $app->redirect(site_url('admin/posts/edit/'.$id));
	}

	return $app->redirect(site_url());
});

/**
 * Show Delete post view
 */
$app->get('/admin/posts/delete/(:id)', $authCheck, function($id) use ($app) {

	// Check if post exists
	$post = ORM::for_table('posts')->find_one($id);
	if ( ! $post)
	{
		return is_ajax() ? false : $app->redirect(SITE_URL);
	}

	// Show View
	if (is_ajax())
	{
		return $app->render('admin/delete_post.php', array(
			'app' => $app,
			'post' => $post
		));
	}
	else
	{
		return $app->render('template.php', array(
			'app' => $app,
			'post' => $post,
			'view' => 'admin/delete_post.php'
		));
	}
});

/**
 * Process Delete Post
 */
$app->post('/admin/posts/delete/(:id)', $authCheck, function($id) use ($app) {
	$post = ORM::for_table('posts')->find_one($id);
	if ($post) {
		$post->delete();
	}
	$app->redirect(site_url());
});