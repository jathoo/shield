<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); } 

class Shield extends Theme
{
	
	/**
	 * Execute on theme init to apply these filters to output
	 */
	public function action_init_theme()
	{
		$this->add_template( 'block.recent_comments', dirname( __FILE__ ) . '/block.recent_comments.php' );
	}
	

}
?>
