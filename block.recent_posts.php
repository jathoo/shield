<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); } ?>
<div class="module recent posts entries">
	<h3><?php echo $content->title; ?></h3>
	<a class="feed" href="<?php echo $theme->feed('entries'); ?>" title="Atom feed of latest entires"></a>
	<ol class="items entries">
	<?php
	$posts = $content->recent_posts; 
	foreach( $posts as $post): ?>
		<li class="item">
			<a class="permalink" href="<?php echo $post->permalink; ?>" title="<?php printf(_t('Posted at %1$s'), $post->pubdate->get('g:i a \o\n F jS, Y')); ?>">
				<span class="title"><?php echo $post->title; ?></span>
				<span class="date"><?php echo $post->pubdate->get('M j'); ?></span>
			</a>
			<a href="<?php echo $post->permalink; ?>#comments" class="comments count" title="<?php printf(_n('%1$d comment', '%1$d comments', $post->comments->approved->comments->count), $post->comments->approved->comments->count); ?>"><?php echo $post->comments->approved->comments->count; ?></a>
		</li>
	<?php endforeach; ?>
	</ol>
</div>