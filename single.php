<?php
if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); }

if( !isset( $type ) ) {
	$type = 'entry';
}

$next = $post->ascend();
$previous= $post->descend();

$theme->display('header');
?>
	<div id="content" class="content primary single">
		<div class="pager entry single">
			<?php if($previous) { ?><a class="previous" href="<?php echo $previous->permalink; ?>" title="Read <?php echo $previous->title; ?>">&laquo; <strong>Previous</strong></a><?php } ?>
			<?php if($next) { ?><a class="next" href="<?php echo $next->permalink; ?>" title="Read <?php echo $next->title; ?>"><strong>Next</strong> &raquo;</a><?php } ?>
		</div>
			<div id="post-<?php echo $post->id; ?>" class="post <?php echo $post->statusname; ?>">
				<div class="field title info">
					<div class="label">Title</div>
					<div class="value"><h3 class="title"><a href="<?php echo $post->permalink; ?>" title="Permalink"><?php echo $post->title_out; ?></a></h3></div>
				</div>
				
				<div class="field date time info">
					<div class="label">Timestamp</div>
					<div class="value">
						Published at
						<abbr class="time" title="<?php echo $post->pubdate->get( 'g:i a \o\n F jS, Y' ); ?>"><?php echo $post->pubdate->get( 'h:i A' ); ?></abbr>
						on
						<span class="date">
							<a href="<?php echo URL::get('display_entries_by_date', array( 'year' => $post->pubdate->format('Y'), 'month' => $post->pubdate->format('m') )); ?>" title="Read more posts from <?php echo $post->pubdate->format('F Y') ?>"><?php $post->pubdate->out('F'); ?></a>
							<a href="<?php echo URL::get('display_entries_by_date', array('year' => $post->pubdate->format('Y'), 'month' => $post->pubdate->format('m'), 'day' => $post->pubdate->format('d'))); ?>" title="Read more posts from <?php echo $post->pubdate->format('F j, Y'); ?>"><?php echo $post->pubdate->format('j'); ?></a>,
							<a href="<?php echo URL::get('display_entries_by_date', array('year' => $post->pubdate->format('Y') )); ?>" title="Read more posts from <?php echo $post->pubdate->format('Y'); ?>"><?php echo $post->pubdate->format('Y'); ?></a>
						</span>
					</div>
				</div>
				<div class="field comments info">
					<div class="label"><?php echo _n( 'Comment', 'Comments', $post->comments->approved->count ); ?></div>
					<div class="value">
						There <?php echo _n( 'is', 'are', $post->comments->approved->count ); ?>
						<a href="<?php echo $post->permalink; ?>#comments"><?php echo $post->comments->approved->count; ?> <?php echo _n( 'comment', 'comments', $post->comments->approved->count ); ?></a>
						on this post. Add <a class="comment add" href="<?php echo $post->permalink; ?>#respond" title="Add a comment to this post">yours</a>.
					</div>
				</div>
				<div class="field tags info">
					<div class="label"><?php echo _n( 'Tag', 'Tags', count($post->tags) ); ?></div>
					<div class="value">
						<ul><?php $i = 1; foreach($post->tags as $key => $tag) { ?>
							<li><a class="global" href="http://technorati.com/tag/<?php echo $tag; ?>" rel="tag">[technorati]</a><a class="site" href="<?php echo URL::get('display_entries_by_tag', array('tag' => $key)); ?>" rel="tag" title="View more posts tagged &lsquo;<?php echo $tag; ?>&rsquo;"><?php echo $tag; ?></a><?php if($i == count($post->tags)) { ?><?php } elseif($i == (count($post->tags) -1 )) { ?><?php if($i == count($post->tags)) { ?><?php } elseif($i == (count($post->tags) -1 )) { ?><?php if (count($post->tags) != 2) { ?>,<?php } ?> and&nbsp; <?php } } else { ?>,&nbsp; <?php } ?></li>
							<?php $i++; } ?>
						</ul>
					</div>
				</div>
				
				<?php if( $type == 'link' ): ?>
				<div class="field visit link info">
					<div class="label">Link</div>
					<div class="value"><a class="visit" href="<?php echo $post->link; ?>" title="Visit this link">Visit</a></div>
				</div>
				<?php endif; ?>
				
				<?php if ( $loggedin ) { ?>
				<div class="field edit info">
					<div class="label">Actions</div>
					<div class="value"><a class="edit" href="<?php URL::out( 'admin', 'page=publish&id=' . $post->id); ?>" title="Edit this post">Edit</a></div>
				</div>
				<?php } ?>
				<div class="field content">
					<div class="label">Content</div>
					<div class="value">
						<?php echo $post->content_out; ?>
					</div>
				</div>
				<?php if(count($post->footnotes) > 0) { ?>
				<div class="field footnotes" id="footnotes">
					<div class="label">Notes</div>
					<div class="value">
						<ol>
					<?php foreach ( $post->footnotes as $i => $footnote ) {
						$append = '';
						if(is_array($footnote)) {
							$append .= '<li id="footnote-' . $post->id . '-' . $i . '" class="cite '. $footnote['type'] . '">';
							$append .= '<a href="' . $footnote['photo']['url'] . '" title="' . $footnote['photo']['title'] . '">Photo</a>';
							$append .= ' by <a href="' . $footnote['owner']['url'] . '" title="' . $footnote['owner']['name'] . '">' . $footnote['owner']['username'] . '</a>';
							$append .= ' on <a href="http://flickr.com">Flickr</a>';
							$append .= ' <a href="#footnote-link-' . $post->id . '-' . $i . '">&#8617;</a>';
							$append .= "</li>\n";
						} else {
							$append .= '<li id="footnote-' . $post->id . '-' . $i . '">';
							$append .=  $footnote;
							$append .= ' <a href="#footnote-link-' . $post->id . '-' . $i . '">&#8617;</a>';
							$append .= "</li>\n";
						}
						echo $append;
					} ?>
						</ol>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php
			$i= 0;
			$true_i= 0;
			if($post->comments->approved->count > 0):
			?>
			<div id="comments" class="comments post single pseudize">
				<div class="field heading">
					<div class="label"><h4><?php echo _n( 'Comment', 'Comments', $post->comments->approved->count ); ?></h4></div>
					<div class="value">
						There <?php echo _n( 'is', 'are', $post->comments->approved->count ); ?>
						<strong><?php echo $post->comments->approved->count; ?></strong>
						<?php echo _n( 'comment', 'comments', $post->comments->approved->count ); ?> on this post. You can add your own
						<a class="comment add" href="<?php echo $post->permalink; ?>#respond" title="Add a comment to this post">below</a>.
					</div>
				</div>
				<?php

				foreach($post->comments->approved as $comment) {
					if($i >= 4) {
						$i= 0;
					}
					
					$i++;
					$true_i++;
					
					if($comment->type == Comment::COMMENT):
						include('comment.comment.php');
					elseif($comment->type == Comment::PINGBACK):
						include('comment.pingback.php');
					elseif($comment->type == Comment::TRACKBACK):
						include('comment.pingback.php');
					endif;
					
				}
				?>
				<div id="comment-preview" class="comment preview scheme<?php echo $i; ?>" style="display:none;">
					<div class="field name namecontainer">
						<div class="label">Name</div>
						<div class="value"><h5 class="nameholder">NAME</h5></div>
					</div>
					<div class="field url urlcontainer">
						<div class="label">Site</div>
						<div class="value"><h5><a href="http://url.com" class="urlholder">URL</a></h5></div>
					</div>
					<div class="field date time info">
						<div class="label">Timestamp</div>
						<div class="value">
							<abbr class="time" title="<?php echo HabariDateTime::date_create()->format( 'g:i a \o\n F jS, Y' ); ?>"><?php echo HabariDateTime::date_create()->format( 'g:i A' ); ?></abbr>
							on
							<strong><?php echo HabariDateTime::date_create()->format( 'F j, Y' ); ?></strong>
						</div>
					</div>
					<div class="field content comment-contentcontainer">
						<div class="label">Content</div>
						<div class="value comment-contentholder">CONTENT</div>
					</div>
				</div>
			</div>
			<?php
			endif;
						
			if($i >= 4) {
				$i= 0;
			}
			
			?>
			
			<div id="respond" class="post respond single scheme<?php echo $i + 1; ?>">
				<div class="field heading">
					<div class="label"><h4>Respond</h4></div>
					<div class="value">
					<?php if ( Session::has_messages() ):
						Session::messages_out();
					else: ?><p>Respond to this entry with your remarkable insights.</p><? endif; ?></div>
				</div>
				<?php
				echo $post->comment_form()->out();
				?>
			</div>
			<div class="pager entry single">
				<?php if($previous) { ?><a class="previous" href="<?php echo $previous->permalink; ?>" title="Read <?php echo $previous->title; ?>">&laquo; <strong>Previous</strong></a><?php } ?>
				<?php if($next) { ?><a class="next" href="<?php echo $next->permalink; ?>" title="Read <?php echo $next->title; ?>"><strong>Next</strong> &raquo;</a><?php } ?>
			</div>
	</div>
	<div id="sidebar" class="content secondary home pseudize">
		<?php echo $theme->area('sidebar'); ?>
	</div>
<?php $theme->display('footer'); ?>