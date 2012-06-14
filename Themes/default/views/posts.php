<?php if ( ! defined('APP_PATH')) exit('Permission Denied');?>
<section class="posts">

	<?php if (count($posts)): ?>
		<?php foreach($posts as $post):?>
		<article class="post">
			<h3><a href="<?=site_url('post/'.$post->id)?>"><?php echo $post->title?></a></h3>
			<?php if (is_admin()):?>
			<section class="post-controls">
				<a class="edit" data-prevent-close href="<?=site_url('admin/posts/edit/'.$post->id)?>">Edit</a> | 
				<a class="delete" href="<?=site_url('admin/posts/delete/'.$post->id)?>">Delete</a>
			</section>
			<?php endif?>

			<?php echo $post->content?>
			<p><small>Posted by Jason on <?=readable_date($post->created)?>. <?=last_updated($post->created, $post->updated)?></small></p>
		</article>
		<?php endforeach?>
	<?php else:?>
	<article class="post">
		<h3>No Posts!</h3>
		<p>This blog currently does not have any content</p>
	</article>
	<?php endif?>


</section>