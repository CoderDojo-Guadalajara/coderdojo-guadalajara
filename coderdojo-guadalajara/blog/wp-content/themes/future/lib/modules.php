<?php
/**********************************************
* Nav Menus
**********************************************/

register_nav_menu( 'future-primary-menu', __( 'Future Primary Menu', 'future' ) );

/**********************************************
* Sidebars
**********************************************/

add_action( 'widgets_init', 'future_sidebars' );

/** Register Sidebars */
function future_sidebars() {

	/** Available Sidebars */
	$sidebars = future_sidebars_init();
	foreach ( $sidebars as $key => $val ) {
		
		/** Arguments */
		$defaults = array(
		  'before_widget'	=> '<section id="%1$s" class="widget %2$s"><div class="widget-inside">',
		  'after_widget'	=> '</div></section>',
		  'before_title'	=> '<h3 class="widget-title">',
		  'after_title'	=> '</h3>'
		);
		$args = wp_parse_args( $sidebars[$key], $defaults );
		
		/* Register the sidebar. */
		register_sidebar( $args );
		
	}

}

/** Available Sidebars */
function future_sidebars_init() {

	/** Sidebars (Built-in) */
	$sidebars = array(
		
		'future-primary-sidebar' => array(
			'name' => __( 'Primary Sidebar', 'future' ),
			'id' => 'future-primary-sidebar',
			'description' => __( 'The main (primary) widget area used as a sidebar.', 'future' )
		),
		
		'future-footer-tail-sidebar' => array(
			'name' => __( 'Footer Tail Sidebar', 'future' ),
			'id' => 'future-footer-tail-sidebar',
			'description' => __( 'Widget area for footer tail.', 'future' )
		)
	
	);
	
	return $sidebars;
}