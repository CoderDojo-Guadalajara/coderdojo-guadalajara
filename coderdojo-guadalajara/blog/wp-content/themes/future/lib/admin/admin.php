<?php
class FutureAdmin {
		
		/** Properties */
		private $future_menu_slug;
		private $future_options_page_hook;
		
		/** Constructor Method */
		function __construct() {
	
			/** Let Set Properties */
			$this->future_menu_slug = 'future-options';
			$this->future_options_page_hook = 'appearance_page_' . $this->future_menu_slug;
			
			/** Admin Hooks */
			add_action( 'admin_menu', array( $this, 'future_options_page' ) );
			add_action( 'admin_init', array( $this, 'future_options' ) );
			add_action( 'admin_init', array( $this, 'future_options_init' ), 12 );			
			add_action( 'load-'. $this->future_options_page_hook, array( $this, 'future_options_page_contextual_help' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'future_enqueue_scripts' ) );
	
		}	
		
		/** Future Options Page */
		function future_options_page() {
			add_theme_page ( esc_html( __( 'Future Options', 'future' ) ), esc_html( __( 'Future Options', 'future' ) ), 'edit_theme_options',	$this->future_menu_slug, array( $this, 'future_options_do_page' ) );			
		}
		
		/** Future Options Page */
		function future_options_do_page() {
			require_once( FUTURE_ADMIN_DIR . 'page.php' );
		}
		
		/** Future Options */		
		function future_options() {
		
			/** Register theme settings. */
			register_setting( 'future_options_group', 'future_options', array( $this, 'future_options_validate' ) );
			
			/** Blog Section */
			add_settings_section( 'future_section_blog', 'Blog Options', array( $this, 'future_section_blog_cb' ), 'future_section_blog_page' );			
			
			add_settings_field( 'future_field_blog_layout', __( 'Blog Layout', 'future' ), array( $this, 'future_field_blog_layout_cb' ), 'future_section_blog_page', 'future_section_blog' );
			add_settings_field( 'future_field_nav_style', __( 'Navigation Style', 'future' ), array( $this, 'future_field_nav_style_cb' ), 'future_section_blog_page', 'future_section_blog' );
			
			/** Post Section */
			add_settings_section( 'future_section_post', 'Post Options', array( $this, 'future_section_post_cb' ), 'future_section_post_page' );
			
			add_settings_field( 'future_field_post_style', __( 'Post Style', 'future' ), array( $this, 'future_field_post_style_cb' ), 'future_section_post_page', 'future_section_post' );
			add_settings_field( 'future_field_featured_image_control', __( 'Post Featured Image', 'future' ), array( $this, 'future_field_featured_image_control_cb' ), 'future_section_post_page', 'future_section_post' );
			
			/** General Section */
			add_settings_section( 'future_section_general', 'General Options', array( $this, 'future_section_general_cb' ), 'future_section_general_page' );
			
			add_settings_field( 'future_field_reset_control', __( 'Reset Theme Options', 'future' ), array( $this, 'future_field_reset_control_cb' ), 'future_section_general_page', 'future_section_general' );
		
		}
		
		/** Future Contextual Help. */
		function future_options_page_contextual_help() {
			
			/** Get the parent theme data. */
			$theme = future_theme_data();
			$AuthorURI = $theme['AuthorURI'];
			$ThemeURI = $theme['ThemeURI'];
		
			/** Get the current screen */
			$screen = get_current_screen();
			
			/** Add theme reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'future-theme',
				'title' => __( 'Theme Support', 'future' ),
				'content' => implode( '', file( FUTURE_ADMIN_DIR . 'help/support.html' ) ),				
				
				)
			);
			
			/** Add license reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'future-license',
				'title' => __( 'License', 'future' ),
				'content' => implode( '', file( FUTURE_ADMIN_DIR . 'help/license.html' ) ),				
				
				)
			);
			
			/** Add changelog reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'future-changelog',
				'title' => __( 'Changelog', 'future' ),
				'content' => implode( '', file( FUTURE_ADMIN_DIR . 'help/changelog.html' ) ),				
				
				)
			);
			
			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'future' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Future Project', 'future' ) . '</a></p>';
			}
			if ( !empty( $ThemeURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $ThemeURI ) . '" target="_blank">' . __( 'Future Official Page', 'future' ) . '</a></p>';
			}			
			$screen->set_help_sidebar( $sidebar );
			
		}
		
		/** Future Enqueue Scripts */
		function future_enqueue_scripts( $hook ) {
			
			/** Load Scripts For Future Options Page */
			if( $hook === $this->future_options_page_hook ) {
				
				/** Load Admin Scripts */
				wp_enqueue_script( 'future-admin-js-theme-options', esc_url( FUTURE_ADMIN_URI . 'theme-options.js' ), array( 'jquery' ) );
				
				/** Load Admin Stylesheet */
				wp_enqueue_style( 'future-admin-css-theme-options', esc_url( FUTURE_ADMIN_URI . 'theme-options.css' ) );
				
			}
				
		}
		
		/** Loads the Future theme setting. */
		function future_get_admin_settings() {
			global $future;

			/* If the settings array hasn't been set, call get_option() to get an array of theme settings. */
			if ( !isset( $future->settings_admin ) ) {
				$future->settings_admin = apply_filters( 'future_options_admin_filter', wp_parse_args( get_option( 'future_options', future_options_default() ), future_options_default() ) );
			}
			
			/** return settings. */
			return $future->settings_admin;
		}
		
		/** Future Options Init */
		function future_options_init() {
			
			$future_options = get_option( 'future_options' );
			if( !is_array( $future_options ) ) {
				update_option( 'future_options', future_options_default() );
			}
		
		}
		
		/** Future Options Range */
		
		/* Boolean Yes | No */		
		function future_boolean_pd() {			
			return array ( 
				1 => __( 'yes', 'future' ), 
				0 => __( 'no', 'future' )
			);		
		}
		
		/* Content Sidebar Layout Range */		
		function future_content_sidebar_layout_pd() {			
			return array ( 
				'content' => __( 'Content', 'future' ), 
				'content-sidebar' => __( 'Content - Sidebar', 'future' ),
				'sidebar-content' => __( 'Sidebar - Content', 'future' )
			);			
		}

		/* Nav Style Range */		
		function future_nav_style_pd() {			
			return array ( 
				'numeric' => __( 'Numeric', 'future' ), 
				'older-newer' => __( 'Older / Newer', 'future' )
			);			
		}
		
		/* Post Style Range */		
		function future_post_style_pd() {			
			return array ( 
				'content' => __( 'Content', 'future' ), 
				'excerpt' => __( 'Excerpt', 'future' )
			);			
		}
		
		/* Featured Image Range */		
		function future_featured_image_pd() {			
			return array( 
				'manual' => __( 'Use Featured Image', 'future' ), 
				'auto' => __( 'Use Featured Image Automatically', 'future' ), 
				'no' => __( 'No Featured Image', 'future' )
			);			
		}
		
		/** Future Options Validation */				
		function future_options_validate( $input ) {
			
			/** Default */
			$default = future_options_default();
			
			/** Future Predefined */
			$future_boolean_pd = $this->future_boolean_pd();
			$future_content_sidebar_layout_pd = $this->future_content_sidebar_layout_pd();
			$future_nav_style_pd = $this->future_nav_style_pd();
			$future_post_style_pd = $this->future_post_style_pd();
			$future_featured_image_pd = $this->future_featured_image_pd();			
			
			/* Validation: future_blog_layout */
			if ( ! array_key_exists( $input['future_blog_layout'], $future_content_sidebar_layout_pd ) ) {
				 $input['future_blog_layout'] = $default['future_blog_layout'];
			}

			/* Validation: future_nav_style */
			if ( ! array_key_exists( $input['future_nav_style'], $future_nav_style_pd ) ) {
				 $input['future_nav_style'] = $default['future_nav_style'];
			}
			
			/* Validation: future_post_style */			
			if ( ! array_key_exists( $input['future_post_style'], $future_post_style_pd ) ) {
				 $input['future_post_style'] = $default['future_post_style'];
			}
			
			/* Validation: future_featured_image_control */			
			if ( ! array_key_exists( $input['future_featured_image_control'], $future_featured_image_pd ) ) {
				 $input['future_featured_image_control'] = $default['future_featured_image_control'];
			}
			
			/* Validation: future_reset_control */
			if ( ! array_key_exists( $input['future_reset_control'], $future_boolean_pd ) ) {
				 $input['future_reset_control'] = $default['future_reset_control'];
			}
			
			/** Reset Logic */
			if( $input['future_reset_control'] == 1 ) {
				$input = $default;
			}			
			
			return $input;
		
		}
		
		/** Blog Section Callback */				
		function future_section_blog_cb() {
			echo '<div class="future-section-desc">
			  <p class="description">'. __( 'Customize blog by using the following settings.', 'future' ) .'</p>
			</div>';
		}
		
		/* Blog Layout Callback */		
		function future_field_blog_layout_cb() {
			
			$future_options = $this->future_get_admin_settings();
			$items = $this->future_content_sidebar_layout_pd();
			
			echo '<select id="future_blog_layout" name="future_options[future_blog_layout]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $future_options['future_blog_layout'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select blog layout. i.e. Categories, Tags, Archives etc', 'future' ) .'</small></div>';
		
		}

		/* Nav Style Callback */		
		function future_field_nav_style_cb() {
			
			$future_options = $this->future_get_admin_settings();
			$items = $this->future_nav_style_pd();
			
			echo '<select id="future_nav_style" name="future_options[future_nav_style]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $future_options['future_nav_style'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select navigation style.', 'future' ) .'</small></div>';
		
		}
		
		/** Post Section Callback */				
		function future_section_post_cb() {
			echo '<div class="future-section-desc">
			  <p class="description">'. __( 'Customize posts by using the following settings.', 'future' ) .'</p>
			</div>';
		}
		
		/* Post Style Callback */		
		function future_field_post_style_cb() {
			
			$future_options = $this->future_get_admin_settings();
			$items = $this->future_post_style_pd();
			
			echo '<select id="future_post_style" name="future_options[future_post_style]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $future_options['future_post_style'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select post style.', 'future' ) .'</small></div>';
		
		}
		
		/* Featured Image Callback */		
		function future_field_featured_image_control_cb() {
			
			$future_options = $this->future_get_admin_settings();
			$items = $this->future_featured_image_pd();
			
			echo '<select id="future_featured_image_control" name="future_options[future_featured_image_control]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $future_options['future_featured_image_control'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( '<strong>Use Featured Image:</strong> which is set in the post.', 'future' ) .'</small></div>';
			echo '<div><small>'. __( '<strong>Use Featured Image Automatically:</strong> from the images uploaded to the post.', 'future' ) .'</small></div>';
			echo '<div><small>'. __( '<strong>No Featured Image:</strong> for the post.', 'future' ) .'</small></div>';
		
		}
		
		/** General Section Callback */				
		function future_section_general_cb() {
			echo '<div class="future-section-desc">
			  <p class="description">'. __( 'Here are the general settings to customize your blog.', 'future' ) .'</p>
			</div>';
		}
		
		/* Reset Control Callback */		
		function future_field_reset_control_cb() {
			
			$future_options = get_option('future_options');			
			$items = $this->future_boolean_pd();			
			echo '<label><input type="checkbox" id="future_reset_control" name="future_options[future_reset_control]" value="1" /> '. __( 'Reset Theme Options.', 'future' ) .'</label>';
		
		}
}

/** Initiate Admin */
new FutureAdmin();