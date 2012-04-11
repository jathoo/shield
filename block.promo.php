<div class="module text <?php echo $content->css_classes . Utils::slugify($content->title); ?>">
	<h3><a href="<?php echo $content->url; ?>"><?php echo $content->title; ?> <span class="icon info">More</span></a></h3>
	<p><?php echo $content->text; ?></p>
	<a class="more" href="<?php echo $content->url; ?>"><?php echo _t( 'Read More' ); ?> &raquo;</a>
</div>
