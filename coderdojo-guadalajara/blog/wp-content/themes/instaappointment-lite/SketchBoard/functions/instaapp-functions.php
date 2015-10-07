<?php
global $instaapp_themename;
global $instaapp_shortname;

if ( !class_exists( 'OT_Loader' )){	
	//THEME SHORTNAME	
	$instaapp_shortname = 'instaapp';	
	$instaapp_themename = 'Instaapp';	
	define('INSTAAPP_ADMIN_MENU_NAME','InstaAppointment');
}

/***************** EXCERPT LENGTH ************/
function instaapp_excerpt_length($length) {
	return 100;
}
add_filter('excerpt_length', 'instaapp_excerpt_length');

/***************** READ MORE ****************/
function instaapp_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'instaapp_excerpt_more');

/************* CUSTOM PAGE TITLE ***********/
add_filter( 'wp_title', 'instaapp_title' );
function instaapp_title($title)
{
	$instaapp_title = $title;
	if ( is_home() && !is_front_page() ) {
		$instaapp_title .= get_bloginfo('name');
	}

	if ( is_front_page() ){
		$instaapp_title .=  get_bloginfo('name');
		$instaapp_title .= ' | '; 
		$instaapp_title .= get_bloginfo('description');
	}

	if ( is_search() ) {
		$instaapp_title .=  get_bloginfo('name');
	}

	if ( is_author() ) { 
		global $wp_query;
		$curauth = $wp_query->get_queried_object();	
		$instaapp_title .= __('Author: ','instaapp');
		$instaapp_title .= $curauth->display_name;
		$instaapp_title .= ' | ';
		$instaapp_title .= get_bloginfo('name');
	}

	if ( is_single() ) {
		$instaapp_title .= get_bloginfo('name');
	}

	if ( is_page() && !is_front_page() ) {
		$instaapp_title .= get_bloginfo('name');
	}

	if ( is_category() ) {
		$instaapp_title .= get_bloginfo('name');
	}

	if ( is_year() ) { 
		$instaapp_title .= get_bloginfo('name');
	}
	
	if ( is_month() ) {
		$instaapp_title .= get_bloginfo('name');
	}

	if ( is_day() ) {
		$instaapp_title .= get_bloginfo('name');
	}

	if (function_exists('is_tag')) { 
		if ( is_tag() ) {
			$instaapp_title .= get_bloginfo('name');
		}
		if ( is_404() ) {
			$instaapp_title .= get_bloginfo('name');
		}					
	}
	
	return $instaapp_title;
}

/**
 * SETS UP THE CONTENT WIDTH VALUE BASED ON THE THEME'S DESIGN.
 */

if ( ! isset( $content_width ) ){
    $content_width = 900;
}


/********************************************************
	#DEFINE REQUIRED CONSTANTS HERE# &
	#OPTIONAL: SET 'OT_SHOW_PAGES' FILTER TO FALSE#.
	#THIS WILL HIDE THE SETTINGS & DOCUMENTATION PAGES.#
*********************************************************/

//CHECK AND FOUND OUT THE THEME VERSION AND ITS BASE NAME
if(function_exists('wp_get_theme')){
    $instaapp_theme_data = wp_get_theme(get_option('template'));
    $instaapp_theme_version = $instaapp_theme_data->Version;  
}

define( 'INSTAAPP_OPTS_FRAMEWORK_DIRECTORY_URI', trailingslashit(get_template_directory_uri() . '/SketchBoard/includes/') );	
define( 'INSTAAPP_OPTS_FRAMEWORK_DIRECTORY_PATH', trailingslashit(get_template_directory() . '/SketchBoard/includes/') );
define( 'INSTAAPP_THEME_VERSION',$instaapp_theme_version);	
	
add_filter( 'ot_show_pages', '__return_false' );

// REQUIRED: SET 'OT_THEME_MODE' FILTER TO TRUE.
add_filter( 'ot_theme_mode', '__return_true' );

// DISABLE ADD NEW LAYOUT SECTION FROM OPTIONS PAGE.
add_filter( 'ot_show_new_layout', '__return_false' );

// REQUIRED: INCLUDE OPTIONTREE.
require_once get_template_directory() . '/SketchBoard/includes/ot-loader.php';

// THEME OPTIONS
require_once get_template_directory() . '/SketchBoard/includes/options/theme-options.php';


/********************************************
	GET THEME OPTIONS VALUE FUNCTION
*********************************************/
function instaapp_get_option( $option_id, $default = '' ){
	return ot_get_option( $option_id, $default = '' );
}


function instaapp_bg_style($background) {
	$bg_style = NULL;

	if ($background) {
		if($background['background-image']){
			
			$bg_style = 'background:';
			
			if ($background['background-color']) {
				$bg_style .= $background['background-color'];
			}
			if ($background['background-image']) {
				$bg_style .= ' url('.$background['background-image'].')';
			}
			if ($background['background-repeat']) {
				$bg_style .= ' '.$background['background-repeat'];
			}
			if ($background['background-attachment']) {
				$bg_style .= ' '.$background['background-attachment'];
			}
			if ($background['background-position']) {
				$bg_style .= ' '.$background['background-position'];
			}
			if ($background['background-size']) {
				$bg_style .= ' / '.$background['background-size']. ';';
			}

		} else{
			if ($background['background-color']) {
				$bg_style .= 'background:'.$background['background-color'];
			}
		}
	}

	return $bg_style;
}


/*********************************************
*   LIMIT WORDS
*********************************************/
function instaapp_slider_limit_words($string, $word_limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $word_limit));
}
