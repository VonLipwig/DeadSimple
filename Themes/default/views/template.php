<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<!DOCTYPE html>
<html class="admin-enabled">
	<head>
		<title>My Title</title>
		<link href="<?=site_url('Themes/default/css/style.css')?>" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<?php if (is_admin()):?>
		<header class="admin clearfix">
			<a href="<?=site_url()?>" class="home">Home</a>

			<?php if ( ! isset($disable_create_button)):?>
			<a href="<?=site_url('admin/posts/create')?>" data-prevent-close class="create">Create Post</a>
			<?php endif?>

			<a href="<?=site_url('user/logout')?>" class="logout">Logout</a>
		</header>
		<?php else:?>
		<header class="admin clearfix">
			<a href="<?=site_url('user/login')?>" class="login">Login</a>
		</header>
		<?php endif?>

		<div class="container">
			<?=Notify::formatted()?>
			
			<?php $app->render($view)?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
		<script src="<?=site_url('Themes/default/js/ckeditor/ckeditor.js')?>"></script>
		<script src="<?=site_url('Themes/default/js/ckeditor/adapters/jquery.js')?>"></script>
		<script src="<?=site_url('Themes/default/js/scripts.js')?>"></script>
	</body>
</html>