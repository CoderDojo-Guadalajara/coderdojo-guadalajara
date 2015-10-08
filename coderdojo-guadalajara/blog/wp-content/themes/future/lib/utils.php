<?php
/**********************************************
* Theme Support
**********************************************/

/** Content Width */
future_set_content_width( 760 );

/** Translations */
load_theme_textdomain( 'future', FUTURE_DIR . 'languages' );

/** Feed Links. */
add_theme_support( 'automatic-feed-links' );

/** Post Formats */
add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'video' ) );

/** Post Thumbnails */
add_theme_support( 'post-thumbnails' );

/**
 * Archive Image
 * Post Types: post
 * For 2 Column (Blog) Layout: future-image-featured
 * For 1 Column (Blog) Layout: future-image-featured-onecol
 */
add_image_size( 'future-image-featured', 600, 300, true );
add_image_size( 'future-image-featured-onecol', 750, 300, true );

/**********************************************
* Custom Background / Header
**********************************************/

/** Custom Header */
add_theme_support( 'custom-header', array(
	
	'default-image' => '%s/images/headers/header-default.png',
	'random-default' => false,
	'width' => apply_filters( 'future_header_image_width', 108 ),
	'height' => apply_filters( 'future_header_image_height', 80 ),
	'flex-width' => true,
	'flex-height' => true,
	'default-text-color' => '',
	'header-text' => false,
	'wp-head-callback' => 'future_header_style',
	'admin-head-callback' => 'future_admin_header_style',
	'admin-preview-callback' => 'future_admin_header_image'
	
) );

/** Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI. */
register_default_headers( array(
	
	'future' => array(
		'url' => '%s/images/headers/header-default.png',
		'thumbnail_url' => '%s/images/headers/header-default-thumb.png',
		'description' => __( 'Future', 'future' )
	)

) );

/** Styles the header image and text displayed on the blog. */
function future_header_style() {
}

/** Styles the header image displayed on the Appearance > Header admin panel. */
function future_admin_header_style() {
?>
<style type="text/css">
.appearance_page_custom-header #header-image-wrapper {
	width: 940px;
	height: 80px;
	overflow: hidden;
	border: none;
	background-color: #e21c2b;
}

#header-image-wrapper img {
	max-width: 100%;
	height: auto;
}

#header-custom-text-wrapper {
	margin: 18px 0;
}

#header-custom-text-wrapper a {
	text-decoration: none;
}

#header-custom-text-wrapper .site-name  {
	display: block;
	font-family: 'Oswald', sans-serif;
	font-size: 28px; 
	line-height: 34px;
	padding: 5px 0 0 15px;	
}

#header-custom-text-wrapper .site-name a  {
	color: #fff; 
}

#header-custom-text-wrapper .site-description {
	display: block;
}
</style>
<?php
}

/** Styles the header image and text displayed on the blog preview. */
function future_admin_header_image() {
?>
<div id="header-image-wrapper">	
  <?php if ( get_header_image() ) : ?>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" onclick="return false;"><img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
  <?php else: ?>
  <div id="header-custom-text-wrapper">
    <span class="site-name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" onclick="return false;" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>    
  </div><!-- end of #logo -->
  <?php endif; ?>
</div>

<?php
}

/**********************************************
* Template Tags
**********************************************/

/** Future Entry Meta Separator */
function future_entry_meta_sep() {
	
	$output = '<span class="entry-meta-sep"> \ </span>';
	return $output;

}

/** Future Post Sticky */
function future_post_sticky() {
	
	$output = '';
	
	if ( is_sticky() ) { 
		$output = sprintf( '<span class="entry-meta-post-sticky"><span class="entry-meta-icon %2$s"></span> %1$s</span>%3$s', __( 'Featured', 'future' ), 'glyphicon glyphicon-pushpin', future_entry_meta_sep() );
	}
	
	return $output;

}

/** Future Post Format */
function future_post_format() {
	
	$output = '';
	$post_format = get_post_format();	
	
	if ( ! empty( $post_format ) ) { 
		
		switch( $post_format ) {
			
			case 'aside':
			$icon = 'glyphicon glyphicon-file';
			break;
			
			case 'audio':
			$icon = 'glyphicon glyphicon-music';
			break;
			
			case 'chat':
			$icon = 'glyphicon glyphicon-comment';
			break;
			
			case 'gallery':
			$icon = 'glyphicon glyphicon-th';
			break;
			
			case 'image':
			$icon = 'glyphicon glyphicon-picture';
			break;
			
			case 'link':
			$icon = 'glyphicon glyphicon-link';
			break;
			
			case 'quote':
			$icon = 'glyphicon glyphicon-tower';
			break;
			
			case 'video':
			default:
			$icon = 'glyphicon glyphicon-facetime-video';
		}
		
		$output = sprintf( '<span class="entry-meta-post-format"><span class="entry-meta-icon %2$s"></span> %1$s</span>%3$s', ucfirst( strtolower( $post_format ) ), $icon, future_entry_meta_sep() );
	
	}
	
	return $output;

}

/** Future Post Date */
function future_post_date() {
	
	/** Output */
	$output = sprintf( '<time class="entry-meta-post-time entry-time updated" itemprop="datePublished" datetime="%2$s"><span class="entry-meta-icon %5$s"></span> <a href="%3$s" title="%1$s" rel="bookmark">%1$s</a></time>', esc_attr( get_the_date() ), esc_attr( get_the_time( 'c' ) ), esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), 'fa fa-calendar' );
	return $output;

}

/** Future Post Author */
function future_post_author() {
	
	/** Output */
	$output = sprintf( '%4$s<span class="entry-meta-post-author entry-author vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><span class="entry-meta-icon %3$s"></span> <a href="%1$s" class="entry-author-link" title="%2$s" itemprop="url" rel="author"><span class="entry-author-name fn" itemprop="name">%2$s</span></a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ), 'fa fa-user', future_entry_meta_sep() );
	return $output;

}

/** Future Post Edit Link */
function future_post_edit_link() {

	/** Manipulation */	
	ob_start();
	if ( in_array( get_post_type(), array( 'post', 'attachment', 'future_portfolio' ) ) ) :
	edit_post_link( __( 'Edit', 'future' ), sprintf( '%1$s<span class="entry-meta-post-edit"><span class="entry-meta-icon fa fa-pencil"></span> ', future_entry_meta_sep() ), '</span>' );
	else:
	edit_post_link( __( 'Edit', 'future' ), '<span class="entry-meta-post-edit"><span class="entry-meta-icon fa fa-pencil"></span> ', '</span>' );
	endif;
	$output = ob_get_clean();
	
	return $output;

}

/** Future Post Comments */
function future_post_comments() {
	
	if ( ( ! comments_open() || post_password_required() ) ) {
		return;
	}

	ob_start();
	comments_number( __( '0 Comment', 'future' ), __( '1 Comment', 'future' ), __( '% Comments', 'future' ) );
	$comments = ob_get_clean();

	if( $comments == '0 Comment' ) {
		return;
	}
	
	/** Output */
	$comments = sprintf( '<a href="%1$s" title="%2$s">%2$s</a>', esc_url( get_comments_link() ), $comments );
	$output = sprintf( '%3$s<span class="entry-meta-post-comments"><span class="entry-meta-icon %2$s"></span> %1$s</span>', $comments, 'fa fa-comment', future_entry_meta_sep() );
	return $output;
}

/** Future Post Categories */
function future_post_category() {
	
	$categories_list = get_the_category_list( ', ' );
	if ( ! $categories_list ) {
		return;
	}
		
	$output = sprintf( '<span class="entry-meta-post-categories"><span class="entry-meta-icon %2$s"></span> %1$s</span>', $categories_list, 'fa fa-folder-open' );
	return $output;
}

/** Future Post Tags */
function future_post_tags() {
	
	$tags_list = get_the_tag_list( '', ', ' );
	if ( ! $tags_list ) {
		return;
	}
		
	$output = sprintf( '%3$s<span class="entry-meta-post-tags"><span class="entry-meta-icon %2$s"></span> %1$s</span>', $tags_list, 'fa fa-tags', future_entry_meta_sep() );
	return $output;
}

/** Future Post Style */
function future_post_style() {
	
	$future_options = future_get_settings();	
	if( $future_options['future_post_style'] == 'excerpt' ) {	
		the_excerpt();	
	} else {		
		the_content();	
	}

}

/** 
 * Future Featured Image
 *
 * Usage: For BLOG Featued Image ONLY
 *
 * @param string $size Featued Image Size.
 * @param string $wrapper_class Featued Image Wrapper to make it Responsive.
 */
function future_featured_image( $args = array() ) {
	
	/** Defaults */
	$defaults = array( 
		'size' => 'future-image-featured',
		'wrapper_class' => 'entry-featured-image-wrapper' 
	);

	/** Theme Settings */
	$future_options = future_get_settings();

	/** Should we proceed? */
	if( $future_options['future_featured_image_control'] == 'no' ) {
		return;
	}

	/** Featured Image according to Layout */
	if( future_cs_layout( array( 'cs_layout_bone' => 'cs_layout', 'echo' => false ) ) == 'content' ) {
		$args['size'] = 'future-image-featured-onecol';
		$args['wrapper_class'] = 'entry-featured-image-onecol-wrapper';
	}

	/** Parse Arguments */
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );	
	
	$img = future_get_image( array( 'format' => 'html', 'size' => $size, 'mode' => $future_options['future_featured_image_control'], 'attr' => array( 'class' => 'entry-featured-image img-responsive' ) ) );
	if( empty( $img ) ) {		
		return;
	}
	
	printf( '<div class="%1$s"><a href="%2$s" title="%3$s">%4$s</a></div>', $wrapper_class, esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), $img );

}

/** Future Link Pages */
function future_link_pages() {
	
	/** Theme Settings */
	$future_options = future_get_settings();	
	
	if( is_single() || $future_options['future_post_style'] == 'content' ) {
	
		$wrapper_class = 'pagination-wrapper pagination-wrapper-link-pages';
		if( is_single() ) {
			$wrapper_class .= ' pagination-wrapper-link-pages-single';
		}

		$paginated_post = future_wp_link_pages( array( 
			
			'before' => '<div class="'. $wrapper_class .'"><ul class="pagination page-numbers">',
			'after' => '</ul></div>',
			'link_before' => '<li>',
			'link_after' => '</li>',
			'echo' => 0
			
			)
		);
		
		return $paginated_post;
	
	}
}

/** Future Loop Navigation */
function future_loop_nav() {

	/** Global Data */
	global $wp_query;

	/** Pagination Logic */
	if ( $wp_query->max_num_pages > 1 ) {
		
		$future_options = future_get_settings();
		
		if ( $future_options['future_nav_style'] == 'numeric' ) {		
			
			future_loop_nav_numeric();		
		
		} else {
			
			future_loop_nav_next_prev();		
		
		}
	
	}

}

/** Future Loop Navigation Numeric */
function future_loop_nav_numeric() {
	
	/** Paginate Links Args */
	global $wp_query;
	$big = 999999999; // Need an unlikely integer
	$args = array(
		'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text'    => __( '&laquo;', 'future' ),
		'next_text'    => __( '&raquo;', 'future' ),
		'type' => 'array'
	);	
?>
<div class="pagination-wrapper pagination-wrapper-paginate">
  <?php 
  	$page_links = paginate_links( $args );
  	$pagination = "<ul class='pagination page-numbers'>\n\t<li>";
	$pagination .= join( "</li>\n\t<li>", $page_links );
	$pagination .= "</li>\n</ul>\n";
	echo $pagination;
  ?>
</div>
<?php	
}

/** Future Loop Navigation Next/Prev */
function future_loop_nav_next_prev() {	
?>
<ul class="pager pagination-wrapper pagination-wrapper-np">
  <li class="previous">
    <?php echo get_previous_posts_link( __( '&larr; Newer', 'future' ) ); ?>
  </li>
  <li class="next">
    <?php echo get_next_posts_link( __( 'Older &rarr;', 'future' ) ); ?>
  </li>
</ul>
<?php
}

/** Future Loop Navigation Singular Post */
function future_loop_nav_singular_post() {
	
	ob_start();
	previous_post_link( '%link', __( '&larr; Previous Post', 'future' ) );
	$previous_post_link = ob_get_clean();
	  
	ob_start();
	next_post_link( '%link', __( 'Next Post &rarr;', 'future' ) );
	$next_post_link = ob_get_clean();
	  
	$previous_post_link = ( empty( $previous_post_link ) )? '&nbsp;' : $previous_post_link;	
	$next_post_link = ( empty( $next_post_link ) )? '&nbsp;' : $next_post_link;

?>
<ul class="pager pagination-wrapper pagination-wrapper-single">
  <li class="previous">
    <?php echo $previous_post_link; ?>
  </li>
  <li class="next">
    <?php echo $next_post_link; ?>
  </li>
</ul>
<?php
}

/** Future Loop Navigation Singular */
function future_loop_nav_singular() {
	global $post;
?>
<div class="entry-post-parent-link-wrapper">
  <a href="<?php echo get_permalink( $post->post_parent ); ?>" class="btn btn-primary"><?php _e( '&larr; Return to', 'future' ); ?> <?php echo get_the_title( $post->post_parent ); ?></a>
</div>
<?php
}

/** Future Loop Navigation Singular Attachment */
function future_loop_nav_singular_attachment() {
	
	ob_start();
	previous_image_link( 'thumbnail' );
	$previous_image_link = ob_get_clean();
	  
	ob_start();
	next_image_link( 'thumbnail' );
	$next_image_link = ob_get_clean();

?>
<ul class="pager pager-images pagination-wrapper pagination-wrapper-attachment">
  <li class="previous">
    <?php echo $previous_image_link; ?>
  </li>
  <li class="next">
    <?php echo $next_image_link; ?>
  </li>
</ul>
<?php
}

/** Future Author */
function future_author() {
if ( get_the_author_meta( 'description' ) ) :
$author_posts_url = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );		
?>
<section class="entry-post-author-wrapper author-box" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">  
  <div class="entry-post-author-body panel panel-default">
    
    <div class="entry-post-author-title author-box-title panel-heading">
      <?php printf( __( 'About <span itemprop="name">%1$s</span>', 'future' ), get_the_author() ); ?>
    </div>
    
    <div class="entry-post-author-body-inside panel-body">      
      
      <div class="entry-post-author-avatar">
	    <a class="thumbnail" href="<?php echo $author_posts_url; ?>">
	      <?php echo get_avatar( get_the_author_meta( 'user_email' ), 64, '', get_the_author() ); ?>
	    </a>
	  </div>      
      <div class="entry-post-author-description author-box-content" itemprop="description">
        <?php the_author_meta( 'description' ); ?>
      </div>    
    
    </div>
  
  </div>
</section>
<?php
endif;
}

/** Future Footer Tail */
add_action( 'future_footer', 'future_footer_tail' );
function future_footer_tail() {
	
/** Theme Data & Settings */
$future_theme_data = future_theme_data();
$future_options = future_get_settings();

/** Footer Copyright Logic */
$future_copyright_code = __( '&copy; Copyright', 'future' ) . date( ' Y ' ) . ' - <a href="'. esc_url( home_url( '/' ) ) .'">'. get_bloginfo( 'name' ) .'</a>';	
?>
<div class="footer-tail-sidebars widget-inverse">
  <div class="container">  
    <div class="row">    
    
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php if ( ! dynamic_sidebar( 'future-footer-tail-sidebar' ) ): ?>
	    <section class="widget widget_text">
	      <div class="widget-inside">	        
	        <div class="textwidget"><?php echo $future_copyright_code; ?></div>
	      </div>
	    </section>
	    <?php endif; ?>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	    <section class="widget widget_text">
	      <div class="widget-inside">	        
	        <div class="textwidget theme-info">
	          <a href="<?php echo $future_theme_data['AuthorURI']; ?>">Free WordPress Themes</a> &sdot; <?php _e( 'Powered by', 'future' ); ?> <a href="http://wordpress.org/" title="WordPress">WordPress</a>
	        </div>
	      </div>
	    </section>
      </div>   
  
    </div>
  </div>
</div>
<?php	
}

/**********************************************
* Comments
**********************************************/

/** Future Comment List */
function future_comment( $comment, $args, $depth ) {
  
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback':
		case 'trackback':
?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		  <article id="div-comment-<?php comment_ID(); ?>" class="pingback-wrapper">
		    <div class="comment-body panel panel-default">
			  <div class="comment-body-inside panel-body">		  		
		  		<?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'future' ), '<span class="comment-meta-edit-link edit-link">', '</span>' ); ?>
			  </div>
		  	</div>
		  </article>
		<?php		
		break;
		default:
		?>
			
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		  
		  <article id="div-comment-<?php comment_ID(); ?>" class="comment-wrapper" itemprop="comment" itemscope="itemscope" itemtype="http://schema.org/UserComments">		  	
			<div class="comment-body panel panel-default">
			  
				<header class="comment-header panel-heading">
		          
					<div class="comment-author" itemprop="creator" itemscope="itemscope" itemtype="http://schema.org/Person">

						<div class="comment-author-avatar-wrapper">
					  	  <div class="comment-author-avatar-wrapper-inside thumbnail">
						 	  <?php
					          $avatar_size = 48;
					          if ( '0' != $comment->comment_parent ) {
					          	$avatar_size = 48;
					          }                            
					          echo get_avatar( $comment, $avatar_size );
							  ?>
						  </div>
						</div>

						<?php
						$author = get_comment_author();
						$url = get_comment_author_url();
						
						if ( ! empty( $url ) && 'http://' !== $url ) {
							$author = sprintf( '<a href="%1$s" rel="external nofollow" itemprop="url">%2$s</a>', esc_url( $url ), $author );
						}

						printf( '<span class="comment-author-title fn" itemprop="name">%1$s</span> <span class="says">%2$s</span>', $author, __( 'says', 'future' ) );
						?>
					
					</div>
					
					<div class="comment-meta">
					    <?php printf( '<time class="comment-meta-time pubdate" datetime="%2$s" itemprop="commentTime"><a href="%1$s" title="%2$s">%3$s</a></time>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( '%1$s at %2$s', get_comment_date(), get_comment_time() ) ); ?>
					    <?php edit_comment_link( __( 'Edit', 'future' ), '<span class="comment-meta-edit-link edit-link">', '</span>' ); ?>
					    <?php if ( $comment->comment_approved == '0' ) : ?>
						<div class="comment-meta-awaiting-moderation comment-awaiting-moderation"><em><?php _e( 'Your comment is awaiting moderation.', 'future' ); ?></em></div>
					    <?php endif; ?>
					</div>
		        
		        </header>

				<div class="comment-body-inside panel-body">		        
			        <div class="comment-content" itemprop="commentText">
			    	  <?php comment_text(); ?>
			        </div>
		      
			        <div class="comment-reply reply">
					  <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'future' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				    </div>		      
		    	</div>
		    
		    </div>
		  </article>			

		<?php
		break;
	
	} // switch ( $comment->comment_type )

}

/**********************************************
* Nav Menus
**********************************************/

/** Primary Menu */
function future_primary_menu_cb() {
	
	echo '<div class="collapse navbar-collapse navbar-header-collapse">
      <ul class="nav navbar-nav navbar-right">
      	<li class="active"><a href="'. admin_url( 'nav-menus.php?action=locations' ) .'">'. __( 'Please Assign Menu: Appearance > Menus > Manage Locations', 'future' ) .'</a></li>
      </ul>
      </div
      ';		 

}

function future_primary_menu() {
	
	if ( has_nav_menu( 'future-primary-menu' ) ) {

	  $args = array(
	  
			'container'       => 'div', 
			'container_class' => 'collapse navbar-collapse navbar-header-collapse', 
			'menu'            => 'future-primary-menu',
			'theme_location'  => 'future-primary-menu',
			'menu_class'      => 'nav navbar-nav navbar-right',
			'depth'           => 2,
			'fallback_cb'     => 'future_primary_menu_cb',
			'walker'          => new wp_bootstrap_navwalker()
				  
	  );
	
	  wp_nav_menu( $args );
	
	} else {
	
	  future_primary_menu_cb();	
	
	}

}

/**********************************************
* Filters
**********************************************/

/** Sets the post excerpt length. */
add_filter( 'excerpt_length', 'future_excerpt_length' );
function future_excerpt_length( $length ) {
	return 25;
}

/** Returns a "Read more" link for content */
add_filter( 'the_content_more_link', 'future_content_more_link', 10, 2 );
function future_content_more_link( $more_link, $more_link_text ) {
	return str_replace( array( 'more-link', $more_link_text ), array( 'entry-more-link entry-more-link-content btn btn-primary', '<span>'. __( 'Read More', 'future' ) .'</span>' ), $more_link );
}

/** Returns a "Read more" link for excerpts */
function future_continue_reading_link() {
	return '<span class="entry-more-link-wrapper"><a href="'. esc_url( get_permalink() ) . '" class="entry-more-link entry-more-link-excerpt btn btn-primary"><span>'. __( 'Read More', 'future' ) .'</span></a></span>';
}

/** Replaces "[...]" (appended to automatically generated excerpts) with future_continue_reading_link(). */
add_filter( 'excerpt_more', 'future_auto_excerpt_more' );
function future_auto_excerpt_more( $more ) {
	return ' <span class="ellipsis">&hellip;</span> ' . future_continue_reading_link();
}	

/** Adds a pretty "Read more" link to custom post excerpts. */
add_filter( 'get_the_excerpt', 'future_custom_excerpt_more' );
function future_custom_excerpt_more( $output ) {
	
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= ' <span class="ellipsis">&hellip;</span> ' . future_continue_reading_link();
	}
	return $output;

}

/**********************************************
* Media
**********************************************/

/** Enqueue Scripts */
add_action( 'wp_enqueue_scripts', 'future_media' );

/** Enqueue Scripts */
function future_media() {

	/** Theme Settings */
	$future_options = future_get_settings();

	/** Enqueue JS Files */	
	
	/** Plugins */
	wp_enqueue_script( 'future-js-plugins', esc_url( FUTURE_JS_URI . 'plugins.js' ), array( 'jquery' ), '1.0', true );

	/** Bootstrap */
	wp_enqueue_script( 'future-js-bootstrap', esc_url( FUTURE_JS_URI . 'bootstrap.min.js' ), array( 'jquery' ), '3.0.3', true );
	
	/** Comment Reply */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** Custom Script */
	wp_enqueue_script( 'future-js-custom', esc_url( FUTURE_JS_URI . 'custom.js' ), array( 'jquery' ), '1.0', true );
	
	/** Enqueue CSS Files */
	
	/** Skeleton */
	wp_enqueue_style( 'future-css-bootstrap', esc_url( FUTURE_CSS_URI . 'bootstrap.css' ) );
	
	/** Theme Stylesheet */
	wp_enqueue_style( 'future-css-style', esc_url( get_stylesheet_uri() ) );

}

/** Dynamic Scripts */
add_action( 'wp_head', 'future_media_dynamic' );
function future_media_dynamic() {
?>
<!--[if lt IE 9]>
	<script src="<?php echo esc_url( FUTURE_JS_URI . 'respond.min.js' ); ?>"></script>
<![endif]-->
<?php
}