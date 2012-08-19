<div id="entry-<?php echo $post->id; ?>" class="multi post entry-multi-list <?php echo $post->statusname; ?> <?php echo Post::type_name( $post->content_type ); ?>">
	<div class="head">
		<span class="date">
			<a href="<?php echo URL::get('display_entries_by_date', array( 'year' => $post->pubdate->format('Y'), 'month' => $post->pubdate->format('m') )); ?>" title="Read more posts from <?php echo $post->pubdate->format('F Y') ?>"><?php $post->pubdate->out('F'); ?></a>
			<a href="<?php echo URL::get('display_entries_by_date', array('year' => $post->pubdate->format('Y'), 'month' => $post->pubdate->format('m'), 'day' => $post->pubdate->format('d'))); ?>" title="Read more posts from <?php echo $post->pubdate->format('F j, Y'); ?>"><?php echo $post->pubdate->format('j'); ?></a>,
			<a href="<?php echo URL::get('display_entries_by_date', array('year' => $post->pubdate->format('Y') )); ?>" title="Read more posts from <?php echo $post->pubdate->format('Y'); ?>"><?php echo $post->pubdate->format('Y'); ?></a>
		</span>
		<h3 class="title"><a href="<?php echo $post->permalink; ?>" title="Visit <?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h3>
	</div>
	<div class="meta">
		<abbr class="time section" title="<?php echo $post->pubdate->get( 'g:i a \o\n F jS, Y' ); ?>"><a class="permalink section" href="<?php echo $post->permalink; ?>" title="<?php echo _t( 'Permalink' ); ?>"><?php echo $post->pubdate->get( 'h:i A' ); ?></a></abbr>
		
		<?php if(count($post->footnotes) > 0): ?>
		<a class="footnotes section" title="Read the <?php echo count($post->footnotes); ?> <?php echo _n( 'footnote', 'footnotes', count($post->footnotes) ); ?>" href="<?php echo $post->permalink; ?>#footnotes"><?php echo count($post->footnotes); ?> <?php echo _n( 'footnote', 'footnotes', count($post->footnotes) ); ?></a>
		<?php endif; ?>

	</div>
	<div class="content">
		<?php echo $post->content_out; ?>
	</div>
</div>