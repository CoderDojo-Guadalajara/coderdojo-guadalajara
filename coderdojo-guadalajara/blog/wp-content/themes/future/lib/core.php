<?php
/**********************************************
* Default Options
**********************************************/

function future_options_default()  {
	
	$default = array(
			
		'future_blog_layout' => 'content-sidebar',
		'future_nav_style' => 'numeric',
		
		'future_post_style' => 'content',
		'future_featured_image_control' => 'manual',
		
		'future_reset_control' => 0
		
	);
	
	return $default;
	
}

/**********************************************
* Theme Settings
**********************************************/

/** Loads the Future theme setting. */
function future_get_settings() {
	global $future;

	/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
	if ( !isset( $future->settings ) ) {
		$future->settings = apply_filters( 'future_options_filter', wp_parse_args( get_option( 'future_options', future_options_default() ), future_options_default() ) );
	}
	
	/** return settings. */
	return $future->settings;
}

/**********************************************
* Theme Data
**********************************************/

/** Function for getting the theme's data */
function future_theme_data() {
	global $future;
	
	/** If the parent theme data isn't set, let grab it. */
	if ( !isset( $future->theme_data ) ) {
		
		$future_theme_data = array();
		$theme_data = wp_get_theme( 'future' );
		$future_theme_data['Name'] = $theme_data->get( 'Name' );
		$future_theme_data['ThemeURI'] = $theme_data->get( 'ThemeURI' );
		$future_theme_data['AuthorURI'] = $theme_data->get( 'AuthorURI' );
		$future_theme_data['Description'] = $theme_data->get( 'Description' );
		$future_theme_data['Version'] = $theme_data->get( 'Version' );		
		
		$future->theme_data = $future_theme_data;
	
	}

	/** Return the parent theme data. */
	return $future->theme_data;
}

/**********************************************
* Content Sidebar Layout
**********************************************/

/** Function for getting the Blog & Portfolio content/sidebar layout */
function future_cs_layout( $args = array() ) {

	/** Global Variable */
	global $future;

	/** Defaults */
	$defaults = array( 
		'cs_layout_bone' => 'content_sidebar_wrapper_class',
		'echo' => true
	);		

	/** Parse Arguments */
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );
	
	/** If the cs layout isn't set, let grab it. */
	if ( !isset( $future->cs_layout_skeleton ) ) {
		
		/** Theme Settings */
		$future_options = future_get_settings();

		/** CS Layout */
		$cs_layout_skeleton = array();
		$cs_layout = 'future_blog_layout';

		/** CS Layout Bones */
		switch ( $future_options[$cs_layout] ) {
		  
		  case 'content':
		  $cs_layout_skeleton['cs_layout'] = 'content';
		  $cs_layout_skeleton['content_sidebar_wrapper_class'] = 'content-sidebar-wrapper content-wrapper';
		  $cs_layout_skeleton['content_column_class'] = 'col-lg-12';
		  $cs_layout_skeleton['sidebar_column_class'] = '';
		  break;

		  case 'sidebar-content':
		  $cs_layout_skeleton['cs_layout'] = 'sidebar-content';
		  $cs_layout_skeleton['content_sidebar_wrapper_class'] = 'content-sidebar-wrapper sidebar-content-wrapper';
		  $cs_layout_skeleton['content_column_class'] = 'col-lg-9 col-md-9 col-sm-8 col-xs-12 col-lg-push-3';
		  $cs_layout_skeleton['sidebar_column_class'] = 'col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-pull-9';
		  break;
		  
		  default:
		  $cs_layout_skeleton['cs_layout'] = 'content-sidebar';
		  $cs_layout_skeleton['content_sidebar_wrapper_class'] = 'content-sidebar-wrapper';
		  $cs_layout_skeleton['content_column_class'] = 'col-lg-9 col-md-9 col-sm-8 col-xs-12';
		  $cs_layout_skeleton['sidebar_column_class'] = 'col-lg-3 col-md-3 col-sm-4 col-xs-12';

		}

		$future->cs_layout_skeleton = $cs_layout_skeleton;
	
	}

	/** Return the requested layout skeleton. */
	if( $echo == true )	{
		echo $future->cs_layout_skeleton[$cs_layout_bone];
	} else {
		return $future->cs_layout_skeleton[$cs_layout_bone];
	}		

}

/**********************************************
* Use future_wp_link_pages instead of core wp_link_pages
* Little hack to wrap link_before and link_after
* Displays page links for paginated posts (i.e. includes the <!--nextpage-->.
* Quicktag one or more times). This tag must be within The Loop.
**********************************************/

function future_wp_link_pages($args = '') {
	$defaults = array(
		'before' => '<p>' . __( 'Pages:', 'future' ), 'after' => '</p>',
		'link_before' => '', 'link_after' => '',
		'next_or_number' => 'number', 'nextpagelink' => __( 'Next page', 'future' ),
		'previouspagelink' => __( 'Previous page', 'future' ), 'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
				$j = str_replace('%',$i,$pagelink);
				$output .= ' ';
				
				if ( ($i != $page) || ((!$more) && ($page==1)) ) {
					
					$output .= $link_before;
					$output .= _wp_link_page($i) . $j . '</a>';
					$output .= $link_after;
				
				} else {
					
					$output .= $link_before . '<span class="current">' . $j . '</span>' . $link_after;
				
				}				
				
			}
			
			$output .= $after;
		
		} else {
			
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page($i);
					$output .= $link_before. $previouspagelink . $link_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page($i);
					$output .= $link_before. $nextpagelink . $link_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo ) {
		echo $output;
	}

	return $output;
}


/**********************************************
* Content Width
**********************************************/

/** Function for setting the content width of a theme. */
function future_set_content_width( $width = '' ) {
	global $content_width;
	$content_width = absint( $width );
}

/** Function for getting the theme's content width. */
function future_get_content_width() {
	global $content_width;
	return $content_width;
}

/**********************************************
* Entry Single Post Class
**********************************************/

function future_entry_content_single_post_class() {

	$classes = array( 'entry-content entry-content-single' );
	$classes[] = ( get_post_format() != '' )? 'entry-content-' . get_post_format() : '';
	echo trim( join( ' ', $classes ) );

}

/**********************************************
* Images
**********************************************/

/** Future Get Image Id Manual */
function future_get_image_id_manual( $num = 0 ) {
	
	/** Global Object */
	global $post;
	
	/** WordPress Featured Image Set In the Post - Manual */
	if ( has_post_thumbnail() && ( $num === 0 ) ) {			
		return get_post_thumbnail_id();		
	}
	
	return false;

}

/** Future Get Image Id Auto */
function future_get_image_id_auto( $num = 0 ) {
	
	/** Global Object */
	global $post;
	
	/** Manual Check At Priority */
	$id = future_get_image_id_manual( $num );
	
	if( ! empty( $id ) ) {
		return $id;
	}
	
	/** Start Manual Mode */
	$image_ids = array_keys(
		get_children(
			array(
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			)
		)
	);

	if ( isset( $image_ids[$num] ) ) {
		return $image_ids[$num];
	}

	return false;
}

/** Future Get Image*/
function future_get_image( $args = array() ) {

	/** Arguments */
	$defaults = array( 
		'format' => 'html', 
		'size' => 'full', 
		'mode' => 'auto', 
		'num' => 0, 
		'attr' => ''
	);	
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );
	
	/** Featured Image Id */
	$id = '';
	if( $mode == 'manual' ) {		
		$id = future_get_image_id_manual( $num );			
	} else {	
		$id = future_get_image_id_auto( $num );	
	}
	
	/** Featured Image Validation */
	if( empty( $id ) ) {
		return false;
	}
	
	/** Format: html */
	if( $format == 'html' ) {
		return wp_get_attachment_image( $id, $size, false, $attr );
	}
	
	/** Format: src */
	if( $format == 'src' ) {
		$output = wp_get_attachment_image_src( $id, $size, false, $attr );
		return $output[0];		
	}
	
	/** return false */
	return false;
}

/**********************************************
* Filters
**********************************************/

/**
 * Filter 'wp_title'
 * Support for popular SEO plugins.
 */
add_filter( 'wp_title', 'future_wp_title', 10, 2 );
function future_wp_title( $title, $separator ) {
	
	/** Don't affect wp_title() calls in feeds. */
	if ( is_feed() ) {
		return $title;
	}
	
	/** 
	 * Support For SEO Plugins
	 * WPSEO_VERSION => http://wordpress.org/extend/plugins/wordpress-seo/
	 * AIOSEOP_VERSION => http://wordpress.org/extend/plugins/all-in-one-seo-pack/
	 */
	
	if( defined( 'WPSEO_VERSION' ) || defined( 'AIOSEOP_VERSION' ) ) {
		return $title;
	}

	/**
	 * The $paged global variable contains the page number of a listing of posts.
	 * The $page global variable contains the page number of a single post that is paged.
	 * We'll display whichever one applies, if we're not looking at the first page.
	 */
	global $paged, $page;

	if ( is_search() ) {		
		
		/** If we're a search, let's start over: */
		$title = sprintf( 'Search results for %s', '"' . get_search_query() . '"' );
		/** Add a page number if we're on page 2 or more: */
		if ( $paged >= 2 ) {
			$title .= " ". $separator ." " . sprintf( 'Page %s', $paged );
		}
		/** Add the site name to the end: */
		$title .= " ". $separator ." " . get_bloginfo( 'name', 'display' );
		/** We're done. Let's send the new title back to wp_title(): */
		return $title;
	
	}

	/** Otherwise, let's start by adding the site name to the end: */
	$title .= get_bloginfo( 'name', 'display' );

	/** If we have a site description and we're on the home/front page, add the description: */
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " ". $separator ." " . $site_description;
	}

	/** Add a page number if necessary: */
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $separator " . sprintf( 'Page %s', max( $paged, $page ) );
	}

	/** Return the new title to wp_title(): */
	return $title;
}

/**
 * Filter 'the_content_more_link'
 * Prevent Page Scroll When Clicking the More Link.
 */
add_filter( 'the_content_more_link', 'future_the_content_more_link_scroll' );
function future_the_content_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}

/**
 * Filter 'use_default_gallery_style'
 * Remove inline style.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filter 'comment_form_default_fields'
 * Modify comment form default fields.
 */
add_filter( 'comment_form_default_fields', 'future_comment_form_fields' );
function future_comment_form_fields( $args ) {
    
    $commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

    $args['author'] = '
    	<div class="form-group comment-form-author">
	      <label for="author">'. __( 'Name', 'future' ) . ( $req ? ' <span class="required">*</span>' : '' ) .'</label>
	      <input type="text" class="form-control" id="author" name="author" value="'. esc_attr( $commenter['comment_author'] ) .'" '. $aria_req .' placeholder="'. __( 'Name', 'future' ) .'">
	    </div>
    ';

    $args['email'] = '
    	<div class="form-group comment-form-email">
	      <label for="email">'. __( 'Email', 'future' ) . ( $req ? ' <span class="required">*</span>' : '' ) .'</label>
	      <input type="email" class="form-control" id="email" name="email" value="' . esc_attr( $commenter['comment_author_email'] ) .'" '. $aria_req .' placeholder="'. __( 'Email', 'future' ) .'">
	    </div>
    ';

    $args['url'] = '
    	<div class="form-group comment-form-url">
	      <label for="url">'. __( 'Website', 'future' ) .'</label>
	      <input type="text" class="form-control" id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'. __( 'Website', 'future' ) .'">
	    </div>
    ';

    return $args;
}

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) ) {
				
				/** Glyphicons by Default */
				$icon_class = 'glyphicon ' . $item->attr_title;
				$item_output .= '<a'. $attributes .'><span class="' . esc_attr( $icon_class ) . '"></span>&nbsp;';
			
			} else {
				$item_output .= '<a'. $attributes .'>';
			}

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}