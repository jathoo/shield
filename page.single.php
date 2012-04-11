<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display('header'); ?>
	<div id="content" class="content main page">
		<h2><?php echo $post->title_out; ?></h2>
		<div class="content"><?php echo $post->content_out; ?></div>
	</div>
	<div id="sidebar" class="content secondary archives pseudize">
		<?php echo $theme->area('sidebar'); ?>
	</div>
<?php $theme->display('footer'); ?>