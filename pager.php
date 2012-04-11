<?php
$previous= $theme->get_prev_page();
$next= $theme->get_next_page();

if($next != NULL || $previous != NULL) {

?><div class="pager navigator multiple" id="pager_<?php echo new uuid; ?>">	
	<span class="previous<?php if($previous == NULL) { ?> none<?php } ?>"><a href="<?php echo $previous; ?>" title="Read previous page in time">&laquo; <strong>Previous</strong></a></span>
	<span class="next<?php if($next == NULL) { ?> none<?php } ?>"><a href="<?php echo $next; ?>" title="Read next page in time"><strong>Next</strong> &raquo;</a></span>
	<?php $theme->display('slider'); ?>
</div>
<?php } ?>