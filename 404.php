<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<?php $theme->display('header'); ?>
	<div id="content" class="content page main meta fourohfour">
		<h3>Sorry...</h3>
		<div class="content">
			<p>I couldn&apos;t find the page you were looking for. I looked and I looked, but it just isn&apos;t here. What is a poor web serve to do these days? I try so hard, logging so many requests, but it is gets so tiring... I haven&apos;t had a vacation in years! Can we pretend this never happened? Please? What if you try going <a href="javascript:go(-1);">back</a>? It is really embarrassing... I can&apos;t imagine what I&apos;m going to say to the guys down at the ISP. Here, I&apos;ll even give you a search box. Will that help? Please say it will. Please.</p>
			<div id="fourohfour-search">
				<form action="<?php Site::out_url( 'habari' ); ?>/search" method="get">
					<label for="s">Search:</label>
					<input id="s" type="text" value="" name="criteria"/>
					<input id="searchsubmit" type="submit" value="Go!"/>
				</form>
			</div>
			<p class="unimportant">This is what the folks in the biz call a <strong>404 error</strong>. It has been reported, so you can rest assured that Morgante will fix the issue. He&apos;ll probably be thoroughly upset with me for screwing up so badly. Maybe you can put in a good word for me? He can probably find what you were looking for as well. Just <a href="<?php echo Site::get_url('habari'); ?>/contact">contact</a> him and he&apos;ll be glad to help.</p>
		</div>
	
		<p>
	</div>
	<div id="sidebar" class="content secondary archives pseudize">
		<?php echo $theme->area('sidebar'); ?>
	</div>
<?php $theme->display('footer'); ?>