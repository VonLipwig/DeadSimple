<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<form action="<?=site_url('admin/posts/delete/'.$post->id)?>" method="POST">
	<p>Are you sure you wish to delete <strong><?=$post->title?></strong></p>
	<input type="submit" name="submit" value="Delete" />
</form>