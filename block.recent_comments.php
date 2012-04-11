<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); } ?>
<div class="module recent comments">
	<h3><?php echo $content->title; ?></h3>
	<a class="feed" href="<?php echo $theme->feed('comments'); ?>" title="Atom feed of latest comments">Comments Feed</a>
	
	<ol class="items pseudize">

		<?php
		$comments = $content->recent_comments;
		foreach ( $comments as $comment ):
		?>
		<li class="item clear">
			<a href="<?php echo $comment->post->permalink; ?>#comment-<?php echo $comment->id; ?>" class="comment"><span class="name"><?php echo $comment->name; ?></span> <span class="conjunction">on</span>
			<span class="date"><?php echo $comment->date->format('M j'); ?></span> </a>
			<a href="<?php echo $comment->post->permalink; ?>" class="post"><span class="title"><?php echo $comment->post->title; ?></span></a>
		</li>
		<?php endforeach; ?>

	</ol>
	
	<div class="clear foot"></div>
</div>