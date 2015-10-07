<?php
class Future {
	
	/** Constructor */
	function __construct() {

		/** Standard Class */
		global $future;
		$future = new stdClass;
		
		/** Loader */
		add_action( 'after_setup_theme', array( $this, 'future_loader' ), 1 );
		
		/** Setup */
		add_action( 'after_setup_theme', array( $this, 'future_setup' ) );		

	}
	
	/** Loader */
	function future_loader() {

		/** Directory Location Constants */
		
		/** Sets the path to the parent theme directory. */
		define( 'FUTURE_DIR', trailingslashit( get_template_directory() ) );
		define( 'FUTURE_LIB_DIR', trailingslashit( FUTURE_DIR . 'lib' ) );
		
		define( 'FUTURE_ADMIN_DIR', trailingslashit( FUTURE_LIB_DIR . 'admin' ) );
		define( 'FUTURE_JS_DIR', trailingslashit( FUTURE_LIB_DIR . 'js' ) );
		define( 'FUTURE_CSS_DIR', trailingslashit( FUTURE_LIB_DIR . 'css' ) );
		
		/** URI Location Constants */
		
		/** Sets the path to the parent theme directory URI. */
		define( 'FUTURE_URI', esc_url( trailingslashit( get_template_directory_uri() ) ) );
		define( 'FUTURE_LIB_URI', esc_url ( trailingslashit( FUTURE_URI . 'lib' ) ) );
		
		define( 'FUTURE_ADMIN_URI', esc_url ( trailingslashit( FUTURE_LIB_URI . 'admin' ) ) );
		define( 'FUTURE_CSS_URI', esc_url ( trailingslashit( FUTURE_LIB_URI . 'css' ) ) );
		define( 'FUTURE_JS_URI', esc_url ( trailingslashit( FUTURE_LIB_URI . 'js' ) ) );		
		define( 'FUTURE_IMAGES_URI', esc_url ( trailingslashit( FUTURE_URI . 'images' ) ) );
		
		/** Core Classes / Functions */
		require_once( FUTURE_LIB_DIR . 'core.php' );

		/** Register Modules */
		require_once( FUTURE_LIB_DIR . 'modules.php' );
		
		/** Load Admin */
		if ( is_admin() ) {
			
			/** Admin Options */
			require_once( FUTURE_ADMIN_DIR . 'admin.php' );

		}
		
	}	
	
	/** Theme Setup */
	function future_setup() {
		
		/** Utility */
		require_once( FUTURE_LIB_DIR . 'utils.php' );
		
	}
	
}

/** Initiate Future */
new Future();