<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); } 

class Shielded extends Theme
{
	var $defaults = array(
		'show_9rules_badge' => false,
		'background_image' => 'leaf'
		
	);
	
	/**
	 * On theme activation, set the default options and activate a default menu
	 */
	public function action_theme_activated()
	{
		$opts = Options::get_group( __CLASS__ );
		if ( empty( $opts ) ) {
			Options::set_group( __CLASS__, $this->defaults );
		}
	}
	
	/**
	 * Configuration form for the  theme
	 **/
	public function action_theme_ui( $theme )
	{
		$ui = new FormUI( __CLASS__ );
	
		$ui->append( 'static', 'style', '<style type="text/css">#shielded .formcontrol { line-height: 2.2em; }</style>');
	
		$ui->append( 'select', 'background_image', __CLASS__.'__background_image', _t( 'Background Image:'), 'optionscontrol_select', 'optionscontrol_select' );
		$ui->background_image->options = array(
			'flower' => _t('Flower'),
			'leaf' => _t('Leaf')
		);
		$ui->background_image->helptext = _t( 'Greyscale image to show in the background.' );
	
		$ui->append( 'checkbox', 'show_9rules_badge', __CLASS__.'__show_9rules_badge', _t( 'Show 9rules Badge:'), 'optionscontrol_checkbox' );
		$ui->show_9rules_badge->helptext = _t( 'Check to display a 9rules badge in the header.' );
	
	
		// Save
		$ui->append( 'submit', 'save', _t( 'Save' ) );
		$ui->set_option( 'success_message', _t( 'Options saved' ) );
		$ui->out();
	}
	
	/**
	 * Creates our blocks
	 */
	public function action_init()
	{
		$this->add_template( 'block.story', dirname(__FILE__) . '/block.story.php' );
		$this->add_template( 'block.promo', dirname(__FILE__) . '/block.promo.php' );
	}
	/**
	 * Execute on theme init to apply these filters to output
	 */
	public function action_init_theme () {
		
		// Stack::add( 'template_stylesheet', array( Site::get_url('theme') . '/css/style.css', 'screen' ), 'style' );
		Stack::add( 'template_stylesheet', array( Site::get_url('theme') . '/jtheme/ui.all.css', 'screen' ), 'jtheme', array('style'));
		Stack::add( 'template_stylesheet', array( Site::get_url('theme') . '/css/style.css', 'screen' ), 'style' );
		
		Stack::add( 'template_header_javascript', Site::get_url('scripts') . '/jquery.js', 'jquery' );
		Stack::add( 'template_header_javascript', Site::get_url('scripts') . '/jquery-ui.min.js', 'ui', array('jquery') );
		// Stack::add( 'template_header_javascript', Site::get_url('theme') . '/js/ui.slider.js', 'slider', array('jquery', 'ui') );
		// Stack::add( 'template_header_javascript', Site::get_url('theme') . '/js/ui.dialog.js', 'dialog',  array('jquery', 'ui'));
		Stack::add( 'template_header_javascript', Site::get_url('theme') . '/js/miranda.js', 'dialog',  array('jquery', 'ui', 'miranda'));
		Stack::add( 'template_header_javascript', Site::get_url('theme') . '/js/main.js', 'main',  array('jquery', 'ui', 'slider', 'miranda', 'dialog'));
		
		
		// Add custom form controls
		$this->add_template( 'commentcontrol_text', dirname(__FILE__) . '/commentcontrol_text.php' );
		$this->add_template( 'commentcontrol_textarea', dirname(__FILE__) . '/commentcontrol_textarea.php' );
		$this->add_template( 'commentcontrol_submit', dirname(__FILE__) . '/commentcontrol_submit.php' );
	}
	
	/**
	 * Customize comment form layout. Needs thorough commenting.
	 */
	public function action_form_comment( $form ) { 
		$form->cf_commenter->caption = 'Name';
				
		$form->cf_email->caption = 'Email';
		$form->cf_email->add_validator( 'validate_required' );
		$form->cf_email->help = '(will not be published)';
	
		$form->cf_url->caption = 'Website';
	
		$form->cf_content->caption = 'Response';
		
		$form->cf_submit->caption = 'Post';
		
		foreach( $form->controls as $control ) {
			// Utils::debug( $control->template );
			switch( $control->template ) {
				case 'formcontrol_text':
					$control->template = 'commentcontrol_text';
					break;
				case 'formcontrol_textarea':
					$control->template = 'commentcontrol_textarea';
					break;
				case 'formcontrol_submit':
					$control->template = 'commentcontrol_submit';
					break;
			}
		}
		// // 	
		// 	if( isset( $control->validators['validate_required'] ) ) {
		// 		$control->remove_validator( 'validate_required' );
		// 		$control->add_validator('validate_required', 'This field is required.');
		// 	}
		// 	
		// 	if( isset( $control->validators['validate_email'] ) ) {
		// 		$control->remove_validator( 'validate_email' );
		// 		$control->add_validator('validate_email', 'This must be a valid email address.');
		// 	}
		// 	
		// 	if( isset( $control->validators['validate_url'] ) ) {
		// 		$control->remove_validator( 'validate_url' );
		// 		$control->add_validator('validate_url', 'This must be a valid <acronym title="Uniform Resource Locator">URL</acronym>.');
		// 	}
		// }	
	
	}
	
	/**
	 * Add some variables to the template output
	 */
	public function add_template_vars()
	{	
		if(isset($this->vars_are_set)):
			return;
		endif;
		
		parent::add_template_vars();
		
		$opts = Options::get_group( __CLASS__ );
			
		$this->assign( 'show_9rules_badge', $opts['show_9rules_badge'] );
		$this->assign( 'background_image', $opts['background_image'] );
		
		$story_blocks = $this->get_blocks( 'stories', 0, $this );
		$stories = array();
		$i = 0;
		foreach( $story_blocks as $story )
		{
			$stories[$i] = $story->title;
			$i++;
		}
		$this->assign( 'stories', $stories );
		
		// Use theme options to set values that can be used directly in the templates
		$opts = Options::get_group( __CLASS__ );
		
		$this->assign( 'show_post_nav', $opts['show_post_nav'] );
		$this->assign( 'loggedin', User::identify()->loggedin );
		
		$locale = Options::get( 'locale' );
		if ( file_exists( Site::get_dir( 'theme', true ). $locale . '.css' ) ) {
			$this->assign( 'localized_css', $locale . '.css' );
		}
		else {
			$this->assign( 'localized_css', false );
		}
		
		// Utils::debug(  );
		$ajax = Controller::get_var('ajax');
		
		if( $ajax === 'yes' ) {
			$this->assign( 'ajax', true );
		} else {
			$this->assign( 'ajax', false );
		}

		// Utils::debug( $this );
		
		if(is_object($this->request)) {
			foreach($this->request as $name => $status) {
				if($status == TRUE) {
					$request = $name;
				}
			}
		} elseif( !is_string( $this->request ) ) {
			$request= 'display_lifestream';
		} else {
			$request = $this->request;
		}
		// 		
		
		$this->assign( 'request', $request );
				
		switch($request) {
			case 'display_page':
				if(  $this->post->tags->has('meta') ) {
					$na_section = 'about';
				}
				elseif (  $this->post->tags->has('writing') ) {
					$na_section = 'writing';
				}
				else {
					$na_section = $this->post->slug;
				}
												
				$na_title = $this->post->title;
				break;
			// case 'display_post':
			// case 'display_link':
			// case 'display_entry':
			// 	$theme->na_section= 'blog';
			// 	$theme->na_title= $theme->post->title;
			// 	break;
			// case 'display_entries_by_date':
			// 	$theme->na_section= 'blog';
			// 	$theme->na_title= NULL;
			// 	
			// 	if(isset($theme->day)):
			// 		$date= new HabariDateTime($theme->year . '-' . $theme->month . '-' . $theme->day);
			// 		$theme->na_title= $date->format('F j, Y');
			// 		$theme->archive_title= 'Archive of ' . $date->format('F j, Y');
			// 	elseif(isset($theme->month)):
			// 		$date= new HabariDateTime($theme->year . '-' . $theme->month . '-1');
			// 		$theme->na_title= $date->format('F Y');
			// 		$theme->archive_title= 'Archive of ' . $date->format('F Y');
			// 	elseif(isset($theme->year)):
			// 		$date= new HabariDateTime($theme->year . '-1-1');
			// 		$theme->na_title= $date->format('Y');
			// 		$theme->archive_title= 'Archive of ' . $date->format('Y');
			// 	endif;
			// 	
			// 	if(isset($theme->month)) {
			// 		
			// 		$month= $theme->month;
			// 		$year= $theme->year;
			// 		
			// 		$calendar_search= array();
			// 	
			// 		if($month != 1) {
			// 			$calendar_search['previous'] = array(
			// 				'year' => $year,
			// 				'month' => sprintf("%02d", $month - 1)
			// 			);
			// 		} else {
			// 			$calendar_search['previous'] = array(
			// 				'year' => $year -1,
			// 				'month' => 12
			// 			);
			// 		}
			// 				
			// 		if($month == date('m')) {
			// 			$calendar_search['next'] = false;
			// 		} elseif($month != 12) {
			// 			$calendar_search['next'] = array(
			// 				'year' => $year,
			// 				'month' => sprintf("%02d", $month + 1)
			// 			);
			// 		} else {
			// 			$calendar_search['next'] = array(
			// 				'year' => $year +1,
			// 				'month' => sprintf("%02d", 1)
			// 			);
			// 		}
			// 	
			// 		$theme->calendar_search= $calendar_search;
			// 	
			// 	}
			// 				
			// 	break;
			// case 'display_entries_by_tag':
			// 	$tag= $theme->tag;
			// 
			// 	$theme->na_section= 'blog';
			// 	$theme->na_title= '&#8220;' . $tag . '&#8221;';
			// 	$theme->archive_title= 'Tag Archive of &#8220;' . $tag . '&#8221;';
			// 				
			// 	break;
			// case 'display_lifestream':
			// 	$theme->na_section= 'life';
			// 	$theme->na_title= 'Lifestream';
			// 	break;
			case 'display_404':
				$na_section = NULL;
				$na_title = NULL;
				break;
			default:
				$na_section = 'blog';
				$na_title = NULL;
				break;
		}
		
		$this->assign( 'na_section', $na_section );
		$this->assign( 'na_title', $na_title );
		
		// $theme->vars_are_set = true;
		
		// if ( !$this->template_engine->assigned( 'pages' ) ) {
		// 	$this->assign( 'pages', Posts::get( 'page_list' ) );
		// }
		// $this->assign( 'post_id', ( isset( $this->post ) && $this->post->content_type == Post::type( 'page' ) ) ? $this->post->id : 0 );
	
		// if ( $this->request->display_entries_by_tag ) {
		// 	if ( count( $this->include_tag ) && count( $this->exclude_tag ) == 0 ) {
		// 		$this->tags_msg = _t( 'Displaying posts tagged: %s', array( Format::tag_and_list( $this->include_tag ) ) );
		// 	}
		// 	else if ( count( $this->exclude_tag ) && count( $this->include_tag ) == 0 ) {
		// 		$this->tags_msg = _t( 'Displaying posts not tagged: %s', array( Format::tag_and_list( $this->exclude_tag ) ) );
		// 	}
		// 	else {
		// 		$this->tags_msg = _t( 'Displaying posts tagged: %s and not %s', array( Format::tag_and_list( $this->include_tag ), Format::tag_and_list( $this->exclude_tag ) ) );
		// 	}
		// }
			
		// Add FormUI template placing the input before the label
		// $this->add_template( 'charcoal_text', dirname( __FILE__ ) . '/formcontrol_text.php' );
	}
	
	
	/**
	*Provides a link to the previous page
	*/
	public function get_prev_page()
	{
		$theme = $this;
		
		$settings= array();

		// If there's no next page, skip and return null
		$settings['page']= (int) ( $theme->page + 1);
		$items_per_page = isset($theme->posts->get_param_cache['limit']) ?
			$theme->posts->get_param_cache['limit'] :
			Options::get('pagination');
		$total= Utils::archive_pages( $theme->posts->count_all(), $items_per_page );
		if ( $settings['page'] > $total ) {
			return null;
		}

		return URL::get(null, $settings, false);
	}
	 
	/**
	*Provides a link to the next page
	*/
	public function get_next_page()
	{
		$theme= $this;
		
		$settings= array();

		// If there's no previous page, skip and return null
		$settings['page']= (int) ( $theme->page - 1);
		if ($settings['page'] < 1) {
			return null;
		}

		return URL::get(null, $settings, false);
	}
	
	/**
	 * Helper to handle feed URLs
	 * TODO: this needs to be generalized somehow
	 */
	public static function feed($type) {
		$base= 'http://feedproxy.google.com/newlyancient/';
		
		if($type == 'all') {
			$type= 'full';
		}
		
		return $base . $type;
	}
		
	// /**
	//  * Convert a post's tags array into a usable list of links
	//  *
	//  * @param array $array The tags array from a Post object
	//  * @return string The HTML of the linked tags
	//  */
	// public function filter_post_tags_out( $array )
	// {
	// 	$fn = create_function( '$a', 'return "<a href=\\"" . URL::get("display_entries_by_tag", array( "tag" => $a->tag_slug) ) . "\\" rel=\\"tag\\">" . $a->tag . "</a>";' );
	// 	$array = array_map( $fn, (array)$array );
	// 	$out = implode( ' ', $array );
	// 	return $out;
	// }
	
	public function theme_post_comments_link( $theme, $post )
	{
		$c = $post->comments->approved->count;
		return 0 == $c ? _t( 'No Comments' ) : sprintf( _n( '%1$d Comment', '%1$d Comments', $c ), $c );
	}
	
	public function filter_post_content_excerpt( $return )
	{
		return strip_tags( $return );
	}
	
	// public function theme_search_prompt( $theme, $criteria, $has_results )
	// {
	// 	$out =array();
	// 	$keywords = explode( ' ', trim( $criteria ) );
	// 	foreach ( $keywords as $keyword ) {
	// 		$out[]= '<a href="' . Site::get_url( 'habari', true ) .'search?criteria=' . $keyword . '" title="' . _t( 'Search for ' ) . $keyword . '">' . $keyword . '</a>';
	// 	}
	// 	
	// 	if ( sizeof( $keywords ) > 1 ) {
	// 		if ( $has_results ) {
	// 			return sprintf( _t( 'Search results for \'%s\'' ), implode( ' ', $out ) );
	// 			exit;
	// 		}
	// 		return sprintf( _t( 'No results found for your search \'%1$s\'' ) . '<br>'. _t( 'You can try searching for \'%2$s\'' ), $criteria, implode( '\' or \'', $out ) );
	// 	}
	// 	else {
	// 		return sprintf( _t( 'Search results for \'%s\'' ), $criteria );
	// 		exit;
	// 	}
	// 	return sprintf( _t( 'No results found for your search \'%s\'' ), $criteria );
	// 
	// }
	
	// public function theme_search_form( $theme )
	// {
	// 	return $theme->fetch( 'searchform' );
	// }
	
	/**
	 * Add a story block to the list of available blocks
	 */
	public function filter_block_list($block_list)
	{
		$block_list['story'] = _t('Story');
		$block_list['promo'] = _t('Promo');
		return $block_list;
	}
	
	/**
	 * Handle the configuration for our story block
	 */
	public function action_block_form_story( $form, $block )
	{
		// $form is already assigned to a FormUI instance
		$form->append( 'text', 'story_url', $block, _t( 'URL' ) );
		$form->append( 'text', 'story_image', $block, _t( 'Background Image URL' ) );
		$form->append( 'textarea', 'story_text', $block, _t( 'Story Text', 'shielded' ) );
		// No need to append a submit button as there is always a default form
		// No need to return values from an action hook
	}
	
	/**
	 * Handle the output for our promo block
	 */
	public function action_block_content_promo( $block )
	{
		// Utils::debug( $block );
		
		$block->index = $block->_area_index;
		$block->url = $block->field_load( 'promo_url' );
		$block->text = $block->field_load( 'promo_text' );
	}
	
	/**
	 * Handle the configuration for our story block
	 */
	public function action_block_form_promo( $form, $block )
	{
		// $form is already assigned to a FormUI instance
		$form->append( 'text', 'promo_url', $block, _t( 'URL' ) );
		$form->append( 'textarea', 'promo_text', $block, _t( 'Promo Text', 'shielded' ) );
		// No need to append a submit button as there is always a default form
		// No need to return values from an action hook
	}
	
	/**
	 * Handle the output for our story block
	 */
	public function action_block_content_story( $block )
	{
		// Utils::debug( $block );
		
		$block->index = $block->_area_index;
		$block->url = $block->field_load( 'story_url' );
		$block->text = $block->field_load( 'story_text' );
		$block->image = $block->field_load( 'story_image' );
	}
	
	/**
	 * Produce a menu for the Charcoal menu block from all of the available pages
	 */
	// public function action_block_content_charcoal_menu($block, $theme)
	// {
	// 	$menus = array('home' => array(
	// 		'link' => Site::get_url( 'habari' ), 
	// 		'title' => Options::get( 'title' ), 
	// 		'caption' => _t('Blog'), 
	// 		'cssclass' => $theme->request->display_home ? 'current_page_item' : '',
	// 	));
	// 	$pages = Posts::get( 'page_list' );
	// 	foreach($pages as $page) {
	// 		$menus[] = array(
	// 			'link' => $page->permalink, 
	// 			'title' => $page->title, 
	// 			'caption' => $page->title, 
	// 			'cssclass' => (isset($theme->post) && $theme->post->id == $page->id) ? 'current_page_item' : '',
	// 		);
	// 	}
	// 	$block->menus = $menus;
	// }

}
?>
