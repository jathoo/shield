<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title><?php Options::out( 'title' ) ?><?php if(isset($na_title)) { ?> &middot; <?php echo $na_title; ?><?php } ?></title>
	<meta name="generator" content="Habari">
	
	<?php
	// handle later
	if( 1 == 2):
	?>
	<link rel="alternate" type="application/atom+xml" title="Atom Feed (Combined)" href="<?php echo $theme->feed('all'); ?>">
	<link rel="alternate" type="application/atom+xml" title="Atom Feed (Links)" href="<?php echo $theme->feed('links'); ?>">
	<link rel="alternate" type="application/atom+xml" title="Atom Feed (Entries)" href="<?php echo $theme->feed('entries'); ?>">
	<?php endif; ?>
	
	<link rel="edit" type="application/atom+xml" title="Atom Publishing Protocol" href="<?php URL::out( 'atompub_servicedocument' ); ?>">
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php URL::out( 'rsd' ); ?>">
	
	<link rel="icon" type="image/ico" href="<?php Site::out_url( 'habari' ); ?>/favicon.ico" />
	
	<style type="text/css" media="screen">
		body {
			background:#FFFFFF url('<?php echo Site::get_url('theme'); ?>/images/backgrounds/<?php echo $background_image; ?>_1.jpg') fixed no-repeat right bottom;
		}
	</style>
	
	<?php echo $theme->header(); ?>
		
</head>
<body class="<?php echo $shield_tags . ' ' . $na_section . ' ' . Utils::slugify(Options::get('title')); ?><?php if( $logo_image ): ?> logo<?php endif; ?>">
<div id="grid_overlay">
	<div class="grid">&nbsp;</div>
</div>
<div id="borders">
&nbsp;
</div>
<div id="page">
	<div id="header" class="section">
		<div id="branding">
			<h1>
				<a href="<?php Site::out_url( 'habari' ); ?>" title="Pick up your heart at home">
				<?php if( $logo_image ): ?><img src="<?php echo $logo_image; ?>" /><?php endif; ?>
				<?php if( Options::get( 'title' ) == 'Newly Ancient'): ?><span class="newly">Newly</span> <span class="ancient">Ancient</span><?php else: Options::out( 'title' ); endif; ?>
				</a>
			</h1>
			<div class="box">
				<?php if($show_9rules_badge): ?><a class="ninerules" href="http://9rules.com" title="I am a member of the 9rules blog community">9rules</a><?php endif; ?>
				<a class="subscribe" href="<?php echo $theme->feed('all'); ?>" title="Subscribe to latest posts">Subscribe</a>
				<div id="search" class="habari internal">
					<?php Plugins::act( 'theme_searchform_before' ); ?>
					<form method="get" id="searchform" action="<?php URL::out('display_search'); ?>"><div>
				    	<label for="s">Search:</label>
						<input type="text" id="s" name="criteria" value="<?php if ( isset( $criteria ) ) { echo htmlentities($criteria, ENT_COMPAT, 'UTF-8'); } ?>">
						<input type="submit" id="searchsubmit" value="Go!">
					</div></form>
				</div>
			</div>
		</div>
		<div id="navigation">
			<ol id="nav_main">
				<?php foreach( $shield_sections as $slug => $section ): ?>
				<li class="<?php echo $slug; if( $section['active'] ): ?> active<?php endif; ?>"><a href="<?php echo $section['url']; ?>"><span><?php echo $section['title']; ?></span></a></li>
				<?php endforeach; ?>
				<?php if( 1 == 2 ): ?>
				<li class="about first<?php if(isset($na_section) && $na_section == 'about') { echo ' active'; } ?>"><a href="<?php Site::out_url( 'habari' ); ?>/about" title="Find out who is responsible for this mess"><span>About</span></a></li>
				<li class="archive<?php if(isset($na_section) && $na_section == 'archive') { echo ' active'; } ?>"><a href="<?php Site::out_url( 'habari' ); ?>/archive" title="Dig into the past"><span>Archive</span></a></li>
				<li class="blog<?php if(isset($na_section) && $na_section == 'blog') { echo ' active'; } ?>"><a href="<?php Site::out_url( 'habari' ); ?>" title="Read my latest musings"><span>Blog</span></a></li>
				<li class="life<?php if(isset($na_section) && $na_section == 'life') { echo ' active'; } ?>"><a href="<?php Site::out_url( 'habari' ); ?>/stream" title="Stalk me across the web, down a stream"><span>Life</span></a></li>
				<li class="poetry last<?php if(isset($na_section) && $na_section == 'writing') { echo ' active'; } ?>"><a href="<?php Site::out_url( 'habari' ); ?>/writing" title="Explore my creative side"><span>Writing</span></a></li>
				<?php endif; ?>
			</ol>
			<div id="spinner">Loading...</div>
			<ol id="stories">
				<?php echo $theme->area('stories'); ?>
			</ol>
			<ol id="stories-nav">
				<?php foreach( $stories as $index => $stitle): ?>
				<li class="story story<?php echo $index; ?>"><a href="#story<?php echo $index; ?>"><?php echo $stitle; ?></a></li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>