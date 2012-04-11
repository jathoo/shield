<div id="comment-<?php echo $comment->id; ?>" class="comment approved scheme<?php echo $i; ?> number<?php echo $true_i; ?> type-pingback">
	<div class="field site">
		<div class="label">Site</div>
		<div class="value"><h5><a href="<?php echo $comment->url; ?>" title="Visit <?php echo $comment->name; ?>"><?php echo $comment->name; ?></a></h5></div>
	</div>
	<?php if(1 == 1) { ?><div class="field url">
		<div class="label">URL</div>
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
		<div class="label">Context</div>
		<div class="value">
			<?php echo $comment->content; ?>
		</div>
	</div>
</div>