<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<form action="<?=site_url('admin/posts/create')?>" method="POST">
	<h2>Create a Blog Post</h2>
	<section>
		<label>Title</label>
		<input type="text" name="title" required maxlength="100" />
	</section>
	<section>
		<label>Content</label>
		<textarea name="create-content" class="wysiwyg"></textarea>
	</section>
	<input type="submit" name="submit" value="Create" />
</form>