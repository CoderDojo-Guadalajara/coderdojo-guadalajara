<?php
global $instaapp_themename;
global $instaapp_shortname;

/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', '_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {

global $instaapp_themename;
global $instaapp_shortname;
  
   /**
    * Get a copy of the saved settings array. 
    */
	$saved_settings = get_option( 'option_tree_settings', array() );

	// If using image radio buttons, define a directory path
	$imagepath  =  get_template_directory_uri() . '/images/';
	$sktsiteurl = home_url('/');
	$sktsitenm  = get_bloginfo('name');
	
	// BACKGROUND DEFAULTS
	$background_defaults = array(
		'background-color'     => '#000000',
		'background-image'     => '',
		'background-repeat'    => 'repeat-y',
		'background-position'  => 'center top',
		'background-attachment'=>'fixed' 
	);
	
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
		'content'       => array( 
			array(
				'id'        => 'general_help',
				'title'     => 'General',
				'content'   => '<p>Help content goes here!</p>'
			)
		),
		'sidebar'     => '<p>Sidebar content goes here!</p>'
		),
		'sections'        => array(
			array(
				'title'   => __( 'General Settings', 'instaapp' ),
				'id'      => 'general_default'
			),			
			array(
				'title'   => __( 'Header Settings', 'instaapp' ),
				'id'      => 'header_settings'
			), 
			array(      
				'title'   => __( 'Top Bar Settings', 'instaapp' ),
				'id'      => 'head_topbar_settings'
			),
		 	array(
				'title'   => __( 'Breadcrumb Settings', 'instaapp' ),
				'id'      => 'breadcrumb_settings'
			),
			array(
				'title'   => __( 'Home Page Featured Section', 'instaapp' ),
				'id'      => 'home_feature_settings'
			),
			array(
				'title'   => __( 'Home Page Parallax Section', 'instaapp' ),
				'id'      => 'home_parallax_settings'
			),				
			array(
				'title'   => __( 'Blog Settings', 'instaapp' ),
				'id'      => 'blog_settings'
			),
			array(      
				'title'   => __( 'Footer Settings', 'instaapp' ),
				'id'      => 'footer_section'
			),
		),
		
		'settings'        => array(

		//==================================================================
		// GENERAL SETTINGS SECTION STARTS =================================
		//==================================================================
		
		array(
			'id'          => 'instaapp_welcome_speach',
			'label'       => 'Welcome to Instaapp',
			'desc'        => '<h1>Welcome to Instaapp</h1>
			<p>Thank you for using Instaapp. Get started below and go through the left tabs to set up your website.</p>',
			'std'         => '',
			'type'        => 'textblock',
			'section'     => 'general_default',
			'rows'        => '',
			'post_type'   => '',
			'taxonomy'    => '',
			'class'       => ''
		),
		array(
			'label'       => __( 'Primary Color Scheme', 'instaapp'),
			'id'          => $instaapp_shortname.'_primary_color_scheme',
			'type'        => 'colorpicker',
			'desc'        => 'Set primary theme color.',
			'std'         => '#FFE12B',
			'section'     => 'general_default'
		),
		array(
			'label'       => __( 'Upload Favicon', 'instaapp'),
			'id'          => $instaapp_shortname.'_favicon',
			'type'        => 'upload',
			'desc'        => 'This creates a custom favicon for your website.',
			'std'         => '',
			'section'     => 'general_default'
		),
		
		
		//------ END GENERAL SETTINGS SECTION ------------------------------

		//==================================================================
		// BREADCRUMB SETTINGS SECTION STARTS ==========================
		//==================================================================
		
		array(
			'label'       => __( 'Choose Page Title & Breadcrumb Background Color & Image', 'instaapp'),
			'id'          => $instaapp_shortname.'_bread_background',
			'std'         => array(
				'background-color'      => '#939393',
				'background-repeat'     => 'no-repeat',
				'background-attachment' => 'scroll',
				'background-position'   => 'center center',
				'background-size'       => 'auto',
				'background-image'      => $imagepath.'title-bg.png',
			),
			'desc'        => __( 'Upload image & color for page title background.', 'instaapp' ),
			'type'        => 'background',
			'section'     => 'breadcrumb_settings'
		),

		
		//==================================================================
		// HEADER TOP BAR SETTINGS SECTION STARTS ==========================
		//==================================================================
		
		array(
			'id'          => 'head_social_icons',
			'label'       => 'Social Follow Icons',
			'desc'        => '<h2><b>Social Follow Icons</b></h2>
			<p>Add your social profile URL( eg: <b>http://facebook.com/SketchThemes</b> )</p>',
			'std'         => '',
			'type'        => 'textblock',
			'section'     => 'head_topbar_settings',
		),
		array(
			'label'       => 'Linkedin Link',
			'id'          => $instaapp_shortname.'_linkedin_link',
			'type'        => 'text',
			'desc'        => 'Enter Linkedin link.',
			'std'         => '#',
			'section'     => 'head_topbar_settings'
		),			
		array(
			'label'       => 'Tumblr Link',
			'id'          => $instaapp_shortname.'_tumblr_link',
			'type'        => 'text',
			'desc'        => 'Enter Tumblr link.',
			'std'         => '#',
			'section'     => 'head_topbar_settings'
		),
		array(
			'label'       => 'Twitter Link',
			'id'          => $instaapp_shortname.'_twitter_link',
			'type'        => 'text',
			'desc'        => 'Enter Twitter link.',
			'std'         => '#',
			'section'     => 'head_topbar_settings'
		),
		array(
			'label'       => 'Facebook Link',
			'id'          => $instaapp_shortname.'_fbook_link',
			'type'        => 'text',
			'desc'        => 'Enter Facebook Link.',
			'std'         => '#',
			'section'     => 'head_topbar_settings'
		),
		array(
			'label'       => 'Google Plus ID',
			'id'          => $instaapp_shortname.'_gplus_link',
			'type'        => 'text',
			'desc'        => 'Enter Google plus Id.',
			'std'         => '#',
			'section'     => 'head_topbar_settings'
		),
		array(
			'id'          => 'option_divider',
			'label'       => '',
			'type'        => 'textblock',
			'section'     => 'head_topbar_settings',
		),
	  	array(
			'label'       => 'Call Us Text',
			'id'          => $instaapp_shortname.'_head_callus',
			'type'        => 'text',
			'desc'        => 'Add your contact number ( eg: <b>Call Us - 123456789</b> )',
			'std'         => '+1-888-888-888',
			'section'     => 'head_topbar_settings'
		),
		
		//------ END SOCIAL LINKS SETTINGS SECTION -------------------------
		
		
		//==================================================================
		// HEADER SETTINGS SECTION STARTS ==================================
		//==================================================================
		
		array(
			'label'       => __( 'Change Logo', 'instaapp'),
			'id'          => $instaapp_shortname.'_logo_img',
			'type'        => 'upload',
			'desc'        => 'This creates a custom logo for your website.',
			'std'         => '',
			'section'     => 'header_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_logo_alt',
			'label'       => __( 'Logo ALT Text', 'instaapp'),
			'desc'        => 'Enter logo image alt attribute text.',
			'std'         => 'Instaapp Theme',
			'type'        => 'text',
			'section'     => 'header_settings'
		),	
		array(
			'id'          => $instaapp_shortname.'_moblie_menu',
			'label'       => __( 'Mobile Menu Activate Width', 'instaapp'),
			'desc'        => __( 'Layout width after which mobile menu will get activated', 'instaapp' ),
			'std'         => '1026',
			'type'        => 'numeric-slider',
			'section'     => 'header_settings',
			'rows'        => '',
			'post_type'   => '',
			'taxonomy'    => '',
			'min_max_step'=> '100,1180,1'
		),
	    array(
			'label'       => __( 'Home page Image', 'instaapp'),
			'id'          => $instaapp_shortname.'_frontslider_stype',
			'type'        => 'upload',
			'desc'        => 'Choose image for home page. Size: Width 1600px and Height 500px.',
			'std'         =>  $imagepath.'slider-1.jpg',
			'section'     => 'header_settings'
		),
		
		//------ END HEADER SETTINGS SECTION -------------------------------
		
		//==================================================================
		// HOME FEATURED SETTINGS SECTION STARTS ========================s======
		//==================================================================	
		array(
			'id'          => $instaapp_shortname.'_featured_heading',
			'label'       => __( 'Featured Section Heading', 'instaapp'),
			'desc'        => 'Enter heading for featured box section.',
			'std'         => 'What We Do',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb1_first_part_heading',
			'label'       => __( 'First Featured Box Heading', 'instaapp'),
			'desc'        => 'Enter heading for first featured box.',
			'std'         => 'Secure Booking',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb1_first_icon_class',
			'label'       => __( 'First Featured Box Icon Class', 'instaapp'),
			'desc'        => 'Enter First Featured Box Class.',
			'std'         => 'fa-calendar',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'label'       => 'First Featured Box Content',
			'id'          => $instaapp_shortname.'_fb1_first_part_content',
			'type'        => 'textarea-simple',
			'desc'        => 'Enter content for first featured box.',
			'std'         => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb1_first_part_link',
			'label'       => __( 'First Featured Box Link', 'instaapp'),
			'desc'        => 'Enter link for first featured box.',
			'std'         => '#',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb2_second_part_heading',
			'label'       => __( 'Second Featured Box Heading', 'instaapp'),
			'desc'        => 'Enter heading for second featured box.',
			'std'         => 'Reliable Service',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb2_second_icon_class',
			'label'       => __( 'Second Featured Box Icon Class', 'instaapp'),
			'desc'        => 'Enter Second Featured Box Class.',
			'std'         => 'fa-cogs',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'label'       => 'Second Featured Box Content',
			'id'          => $instaapp_shortname.'_fb2_second_part_content',
			'type'        => 'textarea-simple',
			'desc'        => 'Enter content for second featured box.',
			'std'         => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb2_first_part_link',
			'label'       => __( 'Second Featured Box Link', 'instaapp'),
			'desc'        => 'Enter link for second featured box.',
			'std'         => '#',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb3_third_part_heading',
			'label'       => __( 'Third Featured Box Heading', 'instaapp'),
			'desc'        => 'Enter heading for third featured box.',
			'std'         => 'No Hidden Charges',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb3_third_icon_class',
			'label'       => __( 'Third Featured Box Icon Class', 'instaapp'),
			'desc'        => 'Enter Third Featured Box Class.',
			'std'         => 'fa-eye-slash',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
		array(
			'label'       => 'Third Featured Box Content',
			'id'          => $instaapp_shortname.'_fb3_third_part_content',
			'type'        => 'textarea-simple',
			'desc'        => 'Enter content for third featured box.',
			'std'         => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been',
			'section'     => 'home_feature_settings'
		),
		array(
			'id'          => $instaapp_shortname.'_fb3_third_part_link',
			'label'       => __( 'Third Featured Box Link', 'instaapp'),
			'desc'        => 'Enter link for third featured box.',
			'std'         => '#',
			'type'        => 'text',
			'section'     => 'home_feature_settings'
		),
			
		//------ END HOME FEATURED SETTINGS SECTION ---------------------

		//==================================================================
		// PARALLAX SETTINGS SECTION STARTS ==================================
		//==================================================================

		array(
			'label'       => __( 'Parallax Section Background Image (size: width * height (1600x * 1000px) )', 'instaapp'),
			'id'          => $instaapp_shortname.'_fullparallax_image',
			'type'        => 'upload',
			'desc'        => 'Upload background image for parallax section.',
			'std'         =>  $imagepath.'1600x1000.png',
			'section'     => 'home_parallax_settings'
		),
		array(
			'label'       =>  __( 'Parallax Section Content', 'instaapp'),
			'id'          => $instaapp_shortname.'_para_content_left',
			'type'        => 'textarea',
			'desc'        => 'Enter content for parallax section',
			'std'         => 'Phasellus facilisis, nunc in laciniaauctor, eros lacus aliquet velit, quis lobortis risus nunc nec nisi maecans et turpis vitae velit.volutpat porttitor
a sit amet est.Phasellus facilisis, nunc in lacinia auctor, eros lacus aliquet velit, quis lobortis risus nunc nec nisi maecans et turpis
vitae velit.volutpat porttitor a sit amet est.Phasellus facilisis, nunc in lacinia auctor, eros lacus aliquet velit, quis lobortis risus nunc nec nisi maecans et turpis
vitae velit.volutpat porttitor a sit amet est.',
			'section'     => 'home_parallax_settings'
		),
		
		//------ END PARALLAX SETTINGS SECTION -------------------------------

		//==================================================================
		// BLOG SETTINGS SECTION STARTS ====================================
		//==================================================================	

		array(
			'id'          => $instaapp_shortname.'_blogpage_heading',
			'label'       => __( 'Enter Blog Page Title', 'instaapp'),
			'desc'        => 'Enter Blog Page Title text.',
			'std'         => 'Blog',
			'type'        => 'text',
			'section'     => 'blog_settings'
		),
			
		//------ END BLOG SETTINGS SECTION ---------------------------------
		
		//==================================================================
		// FOOTER SETTINGS SECTION STARTS ==================================
		//==================================================================
		
		array(
			'label'       => 'Copyright Text',
			'id'          => $instaapp_shortname.'_copyright',
			'type'        => 'textarea',
			'desc'        => 'You can use HTML for links etc..',
			'std'         => 'Copyright text here',
			'section'     => 'footer_section'
		),			
		
		//------ END FOOTER SETTINGS SECTION -------------------------------
		
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}

?>