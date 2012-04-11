<div id="comment-<?php echo $comment->id; ?>" class="comment approved scheme<?php echo $i; ?> number<?php echo $true_i; ?> type-comment">
	<div class="field name">
		<div class="label">Name</div>
		<div class="value"><h5><?php if($comment->url != '') { ?><a href="<?php echo $comment->url; ?>" title="Visit the site of <?php echo $comment->name; ?>"><?php echo $comment->name_out; ?></a><?php } else { echo $comment->name_out; } ?></h5></div>
	</div>
	<?php if($comment->url != '') { ?><div class="field url">
		<div class="label">Site</div>
		<div class="value"><a href="<?php echo $comment->url; ?>" title="Visit the site of <?php echo $comment->name; ?>"><?php echo $comment->url_out; ?></a></div>
	</div><?php } ?>
	<div class="field date time info">
		<div class="label">Timestamp</div>
		<div class="value">
			<a class="time" title="<?php echo $comment->date->get( 'g:i a \o\n F jS, Y' ); ?>" href="<?php echo $post->permalink; ?>#comment-<?php echo $comment->id; ?>"><strong><?php echo $comment->date->get( 'g:i A' ); ?></strong>
			on
			<strong><?php echo $comment->date->get( 'F j, Y' ); ?></strong></a>
		</div>
	</div>
	<div class="field content">
		<div class="label">Content</div>
		<div class="value">
			<?php echo $comment->content_out; ?>
		</div>
	</div>
</div>