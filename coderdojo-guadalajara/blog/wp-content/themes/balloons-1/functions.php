<?php		


/*
CUSTOM THEME OPTIONS
*/

if ( is_admin() ) {	
	require_once('options-page/balloons-theme-settings-basic.php');
}

function balloons_get_global_options(){
	$balloons_option = array();
	$balloons_option = get_option('balloons_options');
	return $balloons_option;
}

$balloons_option = balloons_get_global_options();


/*
DISABLE ADMIN BAR
*/
function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');


/*
DISABLE WP-PAGENAVI CSS
*/

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
	wp_deregister_style( 'wp-paginate' );
}


/*
MENU 
*/

add_theme_support( 'menus' );


/* 
SIDEBAR
*/

if ( function_exists('register_sidebar') )
	register_sidebar(array('name'=>'Footer Widgets',
        'before_widget' => '<div class="col1">',
   	    'after_widget' => '</div></div></div>',
 		'before_title' => '<h2>',
        'after_title' => '</h2><div class="content"><div class="text">'
	));



/* 
DISABLE SPECIFIC WIDGETS IN WORDPRESS BACKEND 
*/

add_action('widgets_init', 'remove_widgets', 20);

function remove_widgets() {
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Search');
}

?>