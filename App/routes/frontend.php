<?php if ( ! defined('APP_PATH')) exit('Permission Denied');

/**
 * Show All Posts
 */
$app->get('/', function() use ($app) {
	return $app->render('template.php', array(
		'app' => $app,
		'posts' => ORM::for_table('posts')->order_by_desc('id')->find_many(),
		'view' => 'posts.php'
	));
});

/**
 * Show single post
 */
$app->get('/post/(:id)', function($id) use ($app) {

	// Find Post
	$post = ORM::for_table('posts')->find_one($id);
	if ($post)
	{
		// Show View
		return $app->render('template.php', array(
			'app' => $app,
			'post' => $post,
			'view' => 'post.php'
		));
	} 
	else
	{
		$app->redirect_to(site_url());
	}
});