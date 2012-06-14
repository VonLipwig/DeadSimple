<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<form action="<?=site_url('admin/posts/edit/'.$post->id)?>" method="POST">
	<h2>Edit Blog Post</h2>
	<section>
		<label>Post Title</label>
		<input type="text" name="title" value="<?=$post->title?>" maxlength="100" />
	</section>
	<section>
		<label>Content</label>
		<textarea name="edit-content" class="wysiwyg"><?=$post->content?></textarea>
	</section>
	<input type="submit" name="submit" value="Save" />
</form>