<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php if(count($posts) < 1): $theme->display('404'); endif; ?>
<?php if(!$ajax): ?>
	<?php $theme->display('header'); ?>
		<div id="content" class="content primary home">
			<?php if(isset($archive_title)): ?><h3 id="archive_title"><?php echo $archive_title; ?></h3><?php endif; ?>
			<?php $theme->display('pager'); ?>
			<div id="post_feed">
			<?php include('entry.multiple.loop.php'); ?>
			</div>
			<?php $theme->display('pager'); ?>
		</div>
		<div id="sidebar" class="content secondary home pseudize">
			<?php echo $theme->area('sidebar'); ?>
		</div>
	<?php $theme->display('footer'); ?>
<?php else: ?>
	<?php include('entry.multiple.loop.php'); ?>
<?php endif; ?>