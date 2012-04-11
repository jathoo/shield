<li class="story story<?php echo $content->index; ?> <?php echo $content->css_classes; ?>" id="story<?php echo $content->index; ?>" style="background-image:url('<?php echo $content->image; ?>');">
	<div class="info">
		<h3><a href="<?php echo $content->url ;?>" class="section"><?php echo $content->title; ?></a></h3>
		<p><?php echo $content->text; ?></p>
		<a class="action" href="<?php echo $content->url; ?>">&rarr;</a>
	</div>
</li>