<?php

global $instaapp_themename;
global $instaapp_shortname;

/************************************************
*  ENQUQUE CSS AND JAVASCRIPT
************************************************/
//ENQUEUE JQUERY 
function instaapp_script_enqueqe() {
	global $instaapp_shortname;
	if(!is_admin()) {
		wp_enqueue_script('instaapp_componentssimple_slide', get_template_directory_uri() .'/js/custom.js',array('jquery'),'1.0',1 );
		wp_enqueue_script("comment-reply");
	}    
}
add_action('init', 'instaapp_script_enqueqe');

//ENQUEUE STYLE FOR IE BROWSER
function instaapp_IE_enqueue_scripts() {
	global $is_IE;
	if($is_IE ) {
		if ( !is_admin() ) {
			wp_register_style( 'ie-style', get_template_directory_uri().'/css/ie-style.css', false, $theme->Version );
			wp_enqueue_style( 'ie-style' );
			wp_register_style( 'awesome-theme-stylesheet', get_template_directory_uri().'/css/font-awesome-ie7.css', false, $theme->Version );
			wp_enqueue_style( 'awesome-theme-stylesheet' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'instaapp_IE_enqueue_scripts' );

//ENQUEUE ADMIN SCRIPTS
if( !function_exists('instaapp_page_admin_enqueue_scripts') ){
    add_action('admin_print_scripts-appearance_page_ot-theme-options','instaapp_page_admin_enqueue_scripts');
    /**
     * Register scripts for admin panel
     * @return void
     */
    function instaapp_page_admin_enqueue_scripts(){	
		wp_enqueue_style( 'instaapp-admin-stylesheet', get_template_directory_uri().'/SketchBoard/css/instaapp-admin.css', false );
    }
}


//ENQUEUE FRONT SCRIPTS
function instaapp_theme_stylesheet()
{
	global $instaapp_themename;
	global $instaapp_shortname;
	if ( !is_admin() ) 
	{
		$theme = wp_get_theme();
		wp_enqueue_script('instaapp_colorboxsimple_slide',get_template_directory_uri() .'/js/jquery.prettyPhoto.js',array('jquery'),true,'1.0');
		wp_enqueue_script('instaapp_hoverIntent', get_template_directory_uri().'/js/hoverIntent.js',array('jquery'),true,'1.0');
		wp_enqueue_script('instaapp_superfish', get_template_directory_uri().'/js/superfish.js',array('jquery'),true,'1.0');
		wp_enqueue_script('instaapp_AnimatedHeader', get_template_directory_uri().'/js/cbpAnimatedHeader.js',array('jquery'),true,'1.0');
		
		wp_enqueue_script('instaapp_easing_slide',get_template_directory_uri().'/js/jquery.easing.1.3.js',array('jquery'),'1.0',true);
		wp_enqueue_script('instaapp_waypoints',get_template_directory_uri().'/js/waypoints.min.js',array('jquery'),'1.0',true );

		
		wp_enqueue_style( 'instaapp-style', get_stylesheet_uri() );
		wp_enqueue_style('instaapp-animation-stylesheet', get_template_directory_uri().'/css/instaapp-animation.css', false, $theme->Version);
		wp_enqueue_style('instaapp-colorbox-theme-stylesheet', get_template_directory_uri().'/css/prettyPhoto.css', false, $theme->Version);
		wp_enqueue_style( 'instaapp-awesome-theme-stylesheet', get_template_directory_uri().'/css/font-awesome.css', false, $theme->Version);
		
		/*SUPERFISH*/
		wp_enqueue_style( 'instaapp-ddsmoothmenu-superfish-stylesheet', get_template_directory_uri().'/css/superfish.css', false, $theme->Version);
		wp_enqueue_style( 'instaapp-bootstrap-responsive-theme-stylesheet', get_template_directory_uri().'/css/bootstrap-responsive.css', false, $theme->Version);
		
		/*GOOGLE FONTS*/
		wp_enqueue_style( 'googleFontsOpensans','//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700', false, $theme->Version);
	}
}
add_action('wp_enqueue_scripts', 'instaapp_theme_stylesheet');

function instaapp_head() {
	global $instaapp_shortname;
	$instaapp_favicon = "";
	$instaapp_meta = '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">'."\n";

	if(instaapp_get_option($instaapp_shortname.'_favicon')) {
		$instaapp_favicon = esc_url(instaapp_get_option($instaapp_shortname.'_favicon','instaapp'));
		$instaapp_meta .= "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"$instaapp_favicon\"/>\n";
	}
	echo $instaapp_meta;

	if(!is_admin()) {
		require_once(get_template_directory().'/includes/instaapp-custom-css.php');
	}
	
	}
	add_action('wp_head', 'instaapp_head');

//ENQUEUE FOOTER SCRIPT 
function instaapp_footer_script() {
	global $instaapp_shortname;	?>
    <style type="text/css">
		#main{background:none;}
		#wrapper {
			<?php #echo instaapp_bg_style($instaapp_shortname."_bg_style"); ?>
		}
	</style>
    <?php
}
add_action('wp_footer', 'instaapp_footer_script');