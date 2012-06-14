<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<article class="post">
	<h3><a class="home" href="<?=site_url()?>">Home</a> &bull; <?=$post->title?></a></h3>
	<?php if (is_admin()):?>
	<section class="post-controls">
		<a class="edit" data-prevent-close href="<?=site_url('admin/posts/edit/'.$post->id)?>">Edit</a> | 
		<a class="delete" href="<?=site_url('admin/posts/delete/'.$post->id)?>">Delete</a>
	</section>
	<?php endif?>

	<?php echo $post->content?>
	<p><small>Posted by Jason on <?=readable_date($post->created)?>. <?=last_updated($post->created, $post->updated)?></small></p>
</article>