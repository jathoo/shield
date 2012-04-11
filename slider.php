<?php
// Implement this later, along with AJAX
if( 1 == 2):
?>
<div class="page_selector">
	<div class="slider"></div>

	<div class="the_pages">
	<span class="current"><?php echo $page; ?></span>
	<?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?>
	</div>
	
	<h4>Page <strong><?php echo $page; ?></strong></h4>
</div>
<?php endif; ?>