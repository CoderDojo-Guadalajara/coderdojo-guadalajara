<?php
/* **************************************************************************************************** */
// Define Constants
/* **************************************************************************************************** */

$get_wp_version = get_bloginfo('version');
$theme_data = wp_get_theme();
define('OPTIONS_PATH', get_template_directory_uri() . '/nimbus/');
define('THEME_NAME', $theme_data['Name']);
define('THEME_NAME_CLEAN', str_replace(" ", "_", strtolower(THEME_NAME)));
define('THEME_OPTIONS', 'wp_simple_options');
define('THEME_SLUG', 'simple');
define('SALESPAGEURL', 'http://www.nimbusthemes.com/wordpress-themes/simple/');
define('SUPPORTINFOURL', 'http://www.nimbusthemes.com/support/');
define('ALLTHEMES', 'http://www.nimbusthemes.com/join/');
define('DEMOURL', 'http://preview.nimbusthemes.com/?theme=simple');
define('GUIDEURL', 'http://www.nimbusthemes.com/user-guides/');
define('ISFREE', TRUE);

/* **************************************************************************************************** */
// Load Admin Panel
/* **************************************************************************************************** */

require_once(get_template_directory() . '/nimbus/options.php');
require_once(get_template_directory() . '/nimbus/options_arr.php');


/* **************************************************************************************************** */
// Flush Rewrite on Activation
/* **************************************************************************************************** */

function nimbus_rewrite_flush() {
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'nimbus_rewrite_flush');


/* **************************************************************************************************** */
// Setup Theme
/* **************************************************************************************************** */

add_action('after_setup_theme', 'nimbus_setup');

if (!function_exists('nimbus_setup')){

    function nimbus_setup() {


       // Localization

        $lang_local = get_template_directory() . '/lang';
        load_theme_textdomain('nimbus', $lang_local);

        // Register Thumbnail Sizes

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1170, 9999, true);
        add_image_size('nimbus_270_170', 270, 170, true);
        add_image_size('nimbus_740_420', 740, 420, true);
        add_image_size('nimbus_105_90', 105, 90, true);
        add_image_size('nimbus_1140_420', 1140, 420, true);
        add_image_size('nimbus_1130_410', 1130, 410, true);

        // Load feed links

        add_theme_support('automatic-feed-links');

        // Support Custom Background

        $nimbus_custom_background_defaults = array(
            'default-color' => 'ffffff'
        );
        add_theme_support( 'custom-background', $nimbus_custom_background_defaults );
        
        // Set Content Width

        global $content_width;
        if ( ! isset( $content_width ) ) {
            $content_width = 720;
        }

        // Register Menus

        register_nav_menu('primary', __('Primary Menu', 'nimbus'));
        
    }
}


/* **************************************************************************************************** */
// Set posts per page
/* **************************************************************************************************** */

add_action( 'pre_get_posts', 'nimbus_posts_per_page', 1 );

if (!function_exists('nimbus_posts_per_page')){
    function nimbus_posts_per_page( $query ) {

        if ( is_admin() || ! $query->is_main_query() )
            return;

        if ( is_home() || is_archive() || is_author() || is_search() ) {
            $query->set( 'posts_per_page', nimbus_get_option('posts_on_blog') );
            return;
        }

    }
}

/* **************************************************************************************************** */
// Do Title 
/* **************************************************************************************************** */

add_action('wp_title', 'nimbus_title');
  
function nimbus_title() {
    global $wp_query;
    $title = get_bloginfo('name');
    $seporate = ' | ';
    if (is_front_page()) {
        $title = get_bloginfo('name');
    } else if (is_feed()) {
        $title = '';
    } else if (is_page() || is_single()) {
        $postid = $wp_query->post->ID;
        $title = the_title('','',false) . $seporate . get_bloginfo('name');
    }
    wp_reset_query();
    return $title;
}

/* **************************************************************************************************** */
// Check if pagination is needed
/* **************************************************************************************************** */

if (!function_exists('nimbus_show_pagination')){
    function nimbus_show_pagination() {
        global $wp_query;
        return ($wp_query->max_num_pages > 1);
    }
}

/* **************************************************************************************************** */
// Modify Search Form
/* **************************************************************************************************** */

if (!function_exists('nimbus_modify_search_form')){
    function nimbus_modify_search_form($form) {
        $form = '<form method="get" id="searchform" action="' . home_url() . '/" >';
        if (is_search()) {
            $form .='<input type="text" value="' . esc_attr(apply_filters('the_search_query', get_search_query())) . '" name="s" id="s" />';
        } else {
            $form .='<input type="text" value="Search" name="s" id="s"  onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;"/>';
        }
        $form .= '<input type="image" id="searchsubmit" src="' . get_template_directory_uri() . '/images/search_icon.png" />
                </form>';
        return $form;
    }
}
add_filter('get_search_form', 'nimbus_modify_search_form');


/* **************************************************************************************************** */
// Override gallery style
/* **************************************************************************************************** */

add_filter( 'use_default_gallery_style', '__return_false' );




/* **************************************************************************************************** */
// Set Content Width On full_width.php Template
/* **************************************************************************************************** */

function nimbus_adjust_content_width() {
    global $content_width;
    if ( is_page_template( 'full_width.php' ) ) {
        $content_width = 1140;
    }    
}
add_action( 'template_redirect', 'nimbus_adjust_content_width' );


/* **************************************************************************************************** */
// Register Sidebars
/* **************************************************************************************************** */

add_action('widgets_init', 'nimbus_register_sidebars');

if (!function_exists('nimbus_register_sidebars')){
    function nimbus_register_sidebars() {
        register_sidebar(array(
            'name' => __('Default Page Sidebar', 'nimbus'),
            'id' => 'sidebar_pages',
            'description' => __('Widgets in this area will be displayed in the sidebar on the pages.', 'nimbus'),
            'before_widget' => '<div id="%1$s" class="widget %2$s widget sidebar_editable">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'name' => __('Default Blog Sidebar', 'nimbus'),
            'id' => 'sidebar_blog',
            'description' => __('Widgets in this area will be displayed in the sidebar on the blog, archives, and the frontpage if the frontpage is set to show latest posts.', 'nimbus'),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'name' => __('Footer Left', 'nimbus'),
            'id' => 'footer-left',
            'description' => __('Widgets in this area will be shown in the left footer column.', 'nimbus'),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'name' => __('Footer Center', 'nimbus'),
            'id' => 'footer-center',
            'description' => __('Widgets in this area will be shown in the center footer column.', 'nimbus'),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'name' => __('Footer Right', 'nimbus'),
            'id' => 'footer-right',
            'description' => __('Widgets in this area will be shown in the right footer column.', 'nimbus'),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        ));
        register_sidebar(array(
            'name' => __('Frontpage Sidebar', 'nimbus'),
            'id' => 'sidebar_fp',
            'description' => __('Widgets in this area will be shown on the side of the frontpage content area.', 'nimbus'),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget_title">',
            'after_title' => '</h3>'
        ));
        // create 50 alternate sidebar widget areas for use on post and pages
        $i = 1;
        while ($i <= 50) {
            register_sidebar(array(
                'name' => __('Alternate Sidebar #', 'nimbus') . $i,
                'id' => 'sidebar_' . $i,
                'description' => __('Widgets in this area will be displayed in the sidebar for any posts, pages or portfolio items that are taged with sidebar', 'nimbus') . $i . '.',
                'before_widget' => '<div class="widget">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget_title">',
                'after_title' => '</h3>'
            ));
            $i++;
        }
    }
}

/* **************************************************************************************************** */
// Excerpt Modifications
/* **************************************************************************************************** */

// Excerpt Length

add_filter('excerpt_length', 'nimbus_excerpt_length');
if (!function_exists('nimbus_excerpt_length')){
    function nimbus_excerpt_length($length) {
        return 40;
    }
}

// Excerpt More

add_filter('excerpt_more', 'nimbus_excerpt_more');

if (!function_exists('nimbus_excerpt_more')){
    function nimbus_excerpt_more($more) {
        return '';
    }
}

// Add to pages

add_action('init', 'nimbus_add_excerpts_to_pages');

if (!function_exists('nimbus_add_excerpts_to_pages')){
    function nimbus_add_excerpts_to_pages() {
        add_post_type_support('page', 'excerpt');
    }
}

/* **************************************************************************************************** */
// Enable Threaded Comments
/* **************************************************************************************************** */

add_action('wp_enqueue_scripts', 'nimbus_threaded_comments');

function nimbus_threaded_comments() {
    if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
        wp_enqueue_script('comment-reply');
    }
}

/* **************************************************************************************************** */
// Modify Comments Output
/* **************************************************************************************************** */

if (!function_exists('nimbus_comment')){
    function nimbus_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li <?php comment_class(); ?> id="li_comment_<?php comment_ID() ?>">
            <div id="comment_<?php comment_ID(); ?>" class="comment_wrap clearfix">
                <?php echo get_avatar($comment, $size = '75'); ?>
                <div class="comment_content">
                    <p class="left"><strong><?php comment_author_link(); ?></strong><br />
                    <?php echo(get_comment_date()) ?> <?php edit_comment_link(__('(Edit)', 'nimbus'), '  ', '') ?></p>
                    <p class="right"><?php comment_reply_link(array_merge($args, array('reply_text' => __('Leave a Reply', 'nimbus'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
                    <div class="clear"></div>
                    <?php
                    if ($comment->comment_approved == '0') {
                    ?>
                        <em><?php _e('Your comment is awaiting moderation.', 'nimbus') ?></em>
                    <?php
                    }
                    ?>
                    <?php comment_text() ?>
                </div>
                <div class="clear"></div>
            </div>
    <?php
    }
}


/* **************************************************************************************************** */
// Modify Ping Output
/* **************************************************************************************************** */

if (!function_exists('nimbus_ping')){
    function nimbus_ping($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li id="comment_<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
    <?php
    }
}


/* **************************************************************************************************** */
// Modify Comment Text Fields
/* **************************************************************************************************** */

add_filter('comment_form_default_fields', 'nimbus_comment_fields');

if (!function_exists('nimbus_comment_fields')){
    function nimbus_comment_fields($fields) {

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ( $req ? " aria-required='true'" : '' );

        $fields['author'] = '<div class="row"><div class="col-md-4 comment_fields"><p class="comment-form-author">' . '<label for="author">' . __('Name', 'nimbus') . '</label> ' . ( $req ? '<span class="required">*</span><br />' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';
        $fields['email'] = '<p class="comment-form-email"><label for="email">' . __('Email', 'nimbus') . '</label> ' . ( $req ? '<span class="required">*</span><br />' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';
        $fields['url'] = '<p class="comment-form-url"><label for="url">' . __('Website', 'nimbus') . '</label><br />' . '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p></div> ';

        return $fields;
    }
}


/* **************************************************************************************************** */
// Modify Avatar Classes
/* **************************************************************************************************** */

add_filter('get_avatar','nimbus_avatar_class');

if (!function_exists('nimbus_avatar_class')){
    function nimbus_avatar_class($class) {
        $class = str_replace("class='avatar", "class='avatar img-responsive", $class) ;
        return $class;
    }
}

/* **************************************************************************************************** */
// Add Post Link Classes
/* **************************************************************************************************** */

add_filter('next_post_link', 'nimbus_posts_link_next_class');

if (!function_exists('nimbus_posts_link_next_class')){
    function nimbus_posts_link_next_class($format){
         $format = str_replace('href=', 'class="post_next btn" href=', $format);
         return $format;
    }
}

add_filter('previous_post_link', 'nimbus_posts_link_prev_class');

if (!function_exists('nimbus_posts_link_prev_class')){
    function nimbus_posts_link_prev_class($format) {
         $format = str_replace('href=', 'class="post_prev btn" href=', $format);
         return $format;
    }
}

/* **************************************************************************************************** */
// Add next_posts Link Classes
/* **************************************************************************************************** */

add_filter('next_posts_link_attributes', 'nimbus_posts_link_class');
add_filter('previous_posts_link_attributes', 'nimbus_posts_link_class');

if (!function_exists('nimbus_posts_link_class')){
    function nimbus_posts_link_class() {
        return 'class="btn"';
    }
}

/* **************************************************************************************************** */
// Add Image Classes ##Look for way to apply to exsisting
/* **************************************************************************************************** */

add_filter('get_image_tag_class','nimbus_add_image_class');

if (!function_exists('nimbus_add_image_class')){
    function nimbus_add_image_class($class){
        $class .= ' img-responsive';
        return $class;
    }
}


/* **************************************************************************************************** */
// Register Featured Image Options Box
/* **************************************************************************************************** */

add_action("admin_init", "nimbus_featured_image_options_meta_box");

function nimbus_featured_image_options_meta_box() {

    add_meta_box("featured_image_options_meta_box", __('Nimbus Featured Image Options', 'nimbus'), "nimbus_call_featured_image_options_meta_box", "page", "side", "high");
    add_meta_box("featured_image_options_meta_box", __('Nimbus Featured Image Options', 'nimbus'), "nimbus_call_featured_image_options_meta_box", "post", "side", "high");
}

function nimbus_call_featured_image_options_meta_box() {

    global $post, $wp_query;

    $custom = get_post_custom($post->ID);
    if (isset($custom["on_page_checked"])) {
        $on_page_checked = $custom["on_page_checked"][0];
    }



    echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';


    if (( get_option('page_on_front') ==  $post->ID )) {
    ?>
        <p><?php _e('There are no image options because this page is set as the Front Page', 'nimbus') ?></p>
    <?php
    } else {
    ?>


        <p><?php _e('Remember you need to attach a Featured Image for these setting to take effect.', 'nimbus') ?></p>

        <table>
                <tr><td><label><input type="checkbox" name="on_page_checked" value="true" <?php if (( get_post_meta($post->ID, 'include_image_on_page', true) == "true" ) || ( get_post_status ( $post->ID ) == 'auto-draft' )) { ?> checked <?php } ?> /></label></td><td>Include Image at the Top of the Page</td></tr>
        </table>


    <?php }

}

/* **************************************************************************************************** */
// Save Featured Image Options Box
/* **************************************************************************************************** */


add_action('save_post', 'nimbus_save_featured_image_options_meta_box');

function nimbus_save_featured_image_options_meta_box($post_id) {

    global $post;

    // verify nonce

    if (isset($_POST['meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }

    // check autosave

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if (isset($_POST['post_type'])) {

        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }


    if (isset($_POST['on_page_checked'])) {
        update_post_meta($post_id, 'include_image_on_page', $_POST['on_page_checked']);
    } else {
        delete_post_meta($post_id, 'include_image_on_page');
    }
}



/* **************************************************************************************************** */
// Register Featured Post Meta Box
/* **************************************************************************************************** */

add_action("admin_init", "nimbus_featured_post_options_meta_box");

function nimbus_featured_post_options_meta_box() {
    add_meta_box("featured_post_options_meta_box", __('Nimbus Featured Post Options', 'nimbus'), "nimbus_call_featured_post_options_meta_box", "post", "side", "high");
}

function nimbus_call_featured_post_options_meta_box() {

    global $post, $wp_query;

    $custom = get_post_custom($post->ID);
    if (isset($custom["featured_post"])) {
        $featured_post = $custom["featured_post"][0];
    }



    echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    ?>
        <p><?php _e('Setting this post as featured will cause it to display on the frontpage in the featured post location. This will only take effect if this is the most recently published featured post.', 'nimbus') ?></p>
        <table>
                <tr><td><label><input type="checkbox" name="featured_post" value="true" <?php if (get_post_meta($post->ID, 'featured_post', true) == "true") { ?> checked <?php } ?> /></label></td><td>Set as Featured Post</td></tr>
        </table>
    <?php

}

/* **************************************************************************************************** */
// Save Featured Post Meta Box
/* **************************************************************************************************** */


add_action('save_post', 'nimbus_save_featured_post_options_meta_box');

function nimbus_save_featured_post_options_meta_box($post_id) {

    global $post;

    // verify nonce

    if (isset($_POST['meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }

    // check autosave

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if (isset($_POST['post_type'])) {

        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }

    if (isset($_POST['featured_post'])) {
        update_post_meta($post_id, 'featured_post', $_POST['featured_post']);
    } else {
        delete_post_meta($post_id, 'featured_post');
    }
}


/* **************************************************************************************************** */
// Register Banner Content Metabox
/* **************************************************************************************************** */

add_action('add_meta_boxes', 'nimbus_banner_meta_box');

function nimbus_banner_meta_box() {
    global $post;
    $unique_template = get_post_meta($post->ID, '_wp_page_template', TRUE);

    if (( get_option('page_on_front') ==  $post->ID ) || ($unique_template == 'alt_frontpage.php')) {
        add_meta_box("banner_meta_box", __('Nimbus Frontpage Banner Panel', 'nimbus'), "nimbus_call_banner_meta_box", "page", "normal", "high");
    }
}

function nimbus_call_banner_meta_box($post) {

    wp_nonce_field(plugin_basename(__FILE__), 'banner_meta_box');

    if (get_post_meta($post->ID, 'frontpage_banner_content', true)) {
        $value = get_post_meta($post->ID, 'frontpage_banner_content', false);
    } else {
        $value[0] = '';
    }

    wp_editor($value[0], 'frontpage_banner_content');
}

/* **************************************************************************************************** */
// Save Banner Content Metabox
/* **************************************************************************************************** */

add_action('save_post', 'nimbus_banner_save_postdata');

function nimbus_banner_save_postdata($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (( isset($_POST['banner_meta_box']) ) && (!wp_verify_nonce($_POST['banner_meta_box'], plugin_basename(__FILE__)) ))
        return;

    if (( isset($_POST['post_type']) ) && ( 'page' == $_POST['post_type'] )) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (isset($_POST['frontpage_banner_content'])) {
        update_post_meta($post_id, 'frontpage_banner_content', $_POST['frontpage_banner_content']);
    }
}

/* **************************************************************************************************** */
// Register Sidebar Select Box
/* **************************************************************************************************** */

add_action("admin_init", "nimbus_sidebar_meta_box");

function nimbus_sidebar_meta_box() {

    add_meta_box("sidebar_meta_box", __('Nimbus Sidebar Options', 'nimbus'), "nimbus_call_sidebar_meta_box", "page", "side", "high");
    add_meta_box("sidebar_meta_box", __('Nimbus Sidebar Options', 'nimbus'), "nimbus_call_sidebar_meta_box", "post", "side", "high");
}

function nimbus_call_sidebar_meta_box() {

    global $post;

    $custom = get_post_custom($post->ID);
    if (isset($custom["alt_sidebar_select"])) {
        $alt_sidebar_select = $custom["alt_sidebar_select"][0];
    } else {
        $alt_sidebar_select = "";
    }
    echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    ?>

    <p><?php __('Enter the number of the alternate sidebar you would like to apply. Leave blank to use default.', 'nimbus') ?></p>
    <table>
        <tr><td><label><?php _e('Sidebar #', 'nimbus') ?></label></td><td><input type="text" name="alt_sidebar_select" style="width:35px;" value="<?php echo $alt_sidebar_select; ?>" size="20" maxlength="2" /></td></tr>
    </table>
    <?php
}

/* **************************************************************************************************** */
// Save Sidebar Select Box
/* **************************************************************************************************** */

add_action('save_post', 'nimbus_save_sidebar_meta_box');

function nimbus_save_sidebar_meta_box($post_id) {

    global $post;

    // verify nonce

    if (isset($_POST['meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }

    // check autosave

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if (isset($_POST['post_type'])) {
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }

    if (isset($_POST['alt_sidebar_select'])) {
        update_post_meta($post_id, 'alt_sidebar_select', $_POST['alt_sidebar_select']);
    }
}


/* **************************************************************************************************** */
// Load Admin CSS
/* **************************************************************************************************** */

add_action('admin_print_styles', 'nimbus_admin_styles');

if (!function_exists('nimbus_admin_styles')){
    function nimbus_admin_styles() {
        if (is_admin()) {
            wp_enqueue_style('thickbox');
            wp_register_style("admin_css", get_template_directory_uri() . "/css/admin.css", array(), "1.0", "all");
            wp_enqueue_style('admin_css');
        }
    }
}

/* **************************************************************************************************** */
// Load Public Scripts
/* **************************************************************************************************** */

add_action('wp_enqueue_scripts', 'nimbus_public_scripts');

if (!function_exists('nimbus_public_scripts')){
    function nimbus_public_scripts() {
        if (!is_admin()) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '2.2.2');
            wp_enqueue_script('bootstrap');
        }
    }
}


/* **************************************************************************************************** */
// Load Public Scripts in Conditional
/* **************************************************************************************************** */

add_action('wp_head', 'nimbus_public_scripts_conditional');

if (!function_exists('nimbus_public_scripts_conditional')){
    function nimbus_public_scripts_conditional() {
    ?>
        <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
        <![endif]-->
    <?php
    }
}


/* **************************************************************************************************** */
// Load Public CSS
/* **************************************************************************************************** */


add_action('wp_print_styles', 'nimbus_public_styles');

if (!function_exists('nimbus_public_styles')){
    function nimbus_public_styles() {
        if (!is_admin()) {
            wp_register_style("bootstrap", get_template_directory_uri() . "/css/bootstrap.min.css", array(), "1.0", "all");
            wp_enqueue_style('bootstrap');
            wp_register_style("bootstrap_fix", get_template_directory_uri() . "/css/bootstrap-fix.css", array(), "1.0", "all");
            wp_enqueue_style('bootstrap_fix');
            wp_register_style( 'font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css", array(), "1.0", "all");
            wp_enqueue_style( 'font-awesome' );
            wp_register_style( 'nimbus-style', get_bloginfo( 'stylesheet_url' ), false, get_bloginfo('version') );
            wp_enqueue_style( 'nimbus-style' );
        }
    }
}


/* **************************************************************************************************** */
// Scripts to footer
/* **************************************************************************************************** */

add_action('wp_footer', 'nimbus_wp_footer');

if (!function_exists('nimbus_wp_footer')){
    function nimbus_wp_footer() {
    ?>
        <script>
        jQuery(window).load(function() {
            jQuery('button, input[type="button"], input[type="reset"], input[type="submit"]').addClass('btn <?php echo nimbus_get_option('nimbus_button_color');?>');
            jQuery('a.btn').addClass('<?php echo nimbus_get_option('nimbus_button_color');?>');
        });
        </script>
    <?php
    }
}


/* **************************************************************************************************** */
// Register Post Types
/* **************************************************************************************************** */

// None

/* **************************************************************************************************** */
// Register Post Type Taxonomies
/* **************************************************************************************************** */

// None

/* **************************************************************************************************** */
// Register Gravatar
/* **************************************************************************************************** */

add_filter('avatar_defaults', 'nimbus_gravatar');

function nimbus_gravatar($avatar_defaults) {
    $myavatar = nimbus_get_option('gravatar');
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}


/* **************************************************************************************************** */
// Nav Walker Class Based on: (see below)
/* **************************************************************************************************** */

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
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
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

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if (strcasecmp($item->title, 'divider') == 0 && $depth === 1) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if (strcasecmp($item->attr_title, 'disabled') == 0) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if($args->has_children) {	$class_names .= ' dropdown'; }
			if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title ) 	   ? $item->title 	   : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';

			//If item has_children add atts to a
			if($args->has_children && $depth === 0) {
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

			if(! empty( $item->attr_title )){
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			} else {
				$item_output .= '<a'. $attributes .'>';
			}

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ($args->has_children && $depth === 0) ? ' <span class="caret"></span></a>' : '</a>';
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

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }

        $id_field = $this->db_fields['id'];

        //display this element
        if ( is_object( $args[0] ) ) {
           $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
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
        } else {
            $args = array(
                'depth'       => 2,
                'sort_column' => 'menu_order, post_title',
                'menu_class'  => 'fallback_cb',
                'include'     => '',
                'exclude'     => '',
                'echo'        => true,
                'show_home'   => 'Home',
                'link_before' => '',
                'link_after'  => ''
            );
            wp_page_menu($args);
        }
    }

}

/* **************************************************************************************************** */
// Clear Helper/s
/* **************************************************************************************************** */

function n_clear() {
echo "<div class='clear'></div>";
}
