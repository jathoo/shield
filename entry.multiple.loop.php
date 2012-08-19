<?php foreach ( $posts as $post ) {
	$theme->post = $post;
	$templates = array();
	if( (isset($post->tags['quick'])) )
	{
		$templates[] = Post::type_name( $post->content_type ) . '.quick.loop';
		$templates[] = 'post.quick.loop';
	}
	$templates[] = Post::type_name( $post->content_type ) . '.loop';
	$templates[] = 'post.loop';
	
	$theme->display_fallback( $templates );
} ?>