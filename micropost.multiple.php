<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php if(count($posts) < 1): $theme->display('404'); endif; ?>
<?php if(!$ajax): ?>
	<?php $theme->display('header'); ?>
		<div id="content" class="content primary home">
			<h3 id="archive_title">Microblog</h3>
			<?php $theme->display('pager'); ?>
			<div id="post_feed">
				<?php $theme->display('entry.multiple.loop'); ?>
			</div>
			<?php $theme->display('pager'); ?>
		</div>
		<div id="sidebar" class="content secondary home pseudize">
			<?php echo $theme->area('sidebar', null, 'micropost.multiple'); ?>
		</div>
	<?php $theme->display('footer'); ?>
<?php else: ?>
	<?php $theme->display('entry.multiple.loop'); ?>
<?php endif; ?>