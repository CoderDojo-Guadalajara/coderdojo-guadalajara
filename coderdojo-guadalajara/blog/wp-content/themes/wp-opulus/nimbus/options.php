<?php
/* * *************************************************************************************************** */
// Create Theme Options page 
// Print required JS and CSS files
// Help for Theme Options page
/* * *************************************************************************************************** */

add_action('admin_menu', 'nimbus_add_theme_options_page');

function nimbus_add_theme_options_page() {

    // Create Theme Options page 

    $theme_options_page = add_theme_page(THEME_NAME . __(' Theme Options', 'nimbus'), THEME_NAME . __(' Theme Options', 'nimbus'), 'edit_theme_options', 'nimbus-options', 'nimbus_page_render');

    if (!$theme_options_page) {
        return;
    }

    // Print required JS and CSS files

    add_action('admin_print_styles-' . $theme_options_page, 'nimbus_options_styles');

    add_action('admin_print_scripts-' . $theme_options_page, 'nimbus_options_scripts');

}

/* * *************************************************************************************************** */
// Enqueue admin JS
/* * *************************************************************************************************** */

function nimbus_options_scripts() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-form');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('jquery-ui-sortable');
    wp_register_script('jquery_cookie', get_template_directory_uri() . '/nimbus/js/jquery.cookies.2.2.0.js', array('jquery'), '1.0');
    wp_enqueue_script('jquery_cookie');
    wp_register_script('options', get_template_directory_uri() . '/nimbus/js/options.js', array('wp-color-picker','jquery'), '1.0');
    wp_enqueue_script('options');
    wp_register_script('fancybox', get_template_directory_uri() . '/nimbus/js/jquery-fancybox-1-3-4.js', array('jquery'), '1.3.4');
    wp_enqueue_script('fancybox');
    wp_enqueue_media();
    
}

/* * *************************************************************************************************** */
// Enqueue admin CSS
/* * *************************************************************************************************** */

function nimbus_options_styles() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/nimbus/css/option_page_style.css');
    wp_enqueue_style('fancybox', get_template_directory_uri() . '/nimbus/css/jquery.fancybox-1.3.4.css');
    wp_register_style( 'font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css", array(), "1.0", "all");
    wp_enqueue_style( 'font-awesome' );
    wp_enqueue_style('lato', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
    wp_enqueue_style('osans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
    wp_enqueue_style('thickbox');
}

/* * *************************************************************************************************** */
// Include Resources on init
/* * *************************************************************************************************** */


add_action('admin_init', 'nimbus_require_resources');

function nimbus_require_resources() {

    require_once get_template_directory() . '/nimbus/options_engine.php';
    require_once get_template_directory() . '/nimbus/options_security.php';
    require_once get_template_directory() . '/nimbus/demo/load_demo.php';
}

/* * *************************************************************************************************** */
// Register Settings on init
/* * *************************************************************************************************** */

add_action('admin_init', 'nimbus_register_settings_on_init');

function nimbus_register_settings_on_init() {

    register_setting('nimbus_option_group', THEME_OPTIONS, 'nimbus_options_sanitize');
    
}


/* * *************************************************************************************************** */
// Render options page
/* * *************************************************************************************************** */

if (!function_exists('nimbus_page_render')) {



    function nimbus_page_render() {

        ?>
        <div id="options_container">
            <div class="newsletter">
            <p>get the newsletter! <a class='nimbus_button_nl' target='_blank' href='http://eepurl.com/A2701'>Sign Up!</a></p> 
            </div>
            <div class="social_button fb">
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=528943183877095&version=v2.0";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-like" data-href="https://www.facebook.com/nimbusthemes" data-colorscheme="light" data-layout="button_count" data-show-faces="false"></div>
            </div>
            <div class="social_button twit">
                <a href="https://twitter.com/nimbusthemes" class="twitter-follow-button" data-show-count="true" data-show-screen-name="false">Follow @nimbusthemes</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div class="social_button goog">
                <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/111351631103795825699" data-rel="publisher"></div>
                <script type="text/javascript">
                  (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/platform.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                  })();
                </script>
            </div>
            
            <div class="clear"></div>
            <a href="http://www.nimbusthemes.com"><img id="panel_logo" src="<?php echo get_template_directory_uri(); ?>/nimbus/images/nimbus-panel.jpg" alt='Nimbus Panel'  /></a>
            <div id="options_wrapper">   
                <div id="options_header">    
                    <img src="<?php if (ISFREE) { echo get_template_directory_uri() . '/nimbus/images/upgrade-panel.jpg'; } else { echo get_template_directory_uri() . '/nimbus/images/panel.jpg'; } ?>" id="options_banner" />
                    <?php if (ISFREE) { ?>
                    <a id="upgrade_in_banner" target="_blank" class="nimbus_button_big_pink" href="<?php echo SALESPAGEURL; ?>?utm_source=<?php echo THEME_NAME_CLEAN; ?>&utm_medium=theme&utm_content=upgrade_in_banner_button&utm_campaign=<?php echo THEME_NAME_CLEAN; ?>">Upgrade Now!</a>
                    <?php } ?>
                </div>
                <div id="options_content">    
                    <div id="tab_wrapper">    
                        <ul id="tabs">
                            <?php nimbus_tab_engine(); ?>
                        </ul>
                    </div>
                    <div id="form_wrapper">
                        <form action="options.php" method="post" id="nimbus_form">
                            <div id="options_buttons_top">
                                <a id="demo_options_top" target="_blank" class="nimbus_button_big_gray" href="<?php echo DEMOURL; ?>&utm_source=<?php echo THEME_NAME_CLEAN; ?>&utm_medium=theme&utm_content=demo_button&utm_campaign=<?php echo THEME_NAME_CLEAN; ?>">View Demo</a>
                                <a id="support_options_top" target="_blank" class="nimbus_button_big_gray" href="<?php echo SUPPORTINFOURL; ?>?utm_source=<?php echo THEME_NAME_CLEAN; ?>&utm_medium=theme&utm_content=support_button&utm_campaign=<?php echo THEME_NAME_CLEAN; ?>">Get Help</a>   
                                <?php 
                                submit_button( 'Save', 'nimbus_button_big_blue', 'update', false, array( 'id' => 'update_options_top'));
                                ?>
                            </div>
                            <?php
                            settings_errors();
                            settings_fields('nimbus_option_group');
                            nimbus_field_engine();
                            ?>
                            <div class="clear20"></div>
                            <div id="options_buttons_bottom">
                                <?php 
                                $reset_confirm = __('Are you sure you want to reset? ALL SAVED SETTINGS WILL BE LOST!', 'nimbus');
                                submit_button( 'Reset', 'nimbus_button_big_lgray', 'reset', false, array( 'id' => 'reset_options_top', 'onclick' => 'return confirm( \'' . $reset_confirm . '\')'));
                                ?>
                                <a id="demo_options_bottom" target="_blank" class="nimbus_button_big_gray" href="<?php echo DEMOURL; ?>&utm_source=<?php echo THEME_NAME_CLEAN; ?>&utm_medium=theme&utm_content=demo_button&utm_campaign=<?php echo THEME_NAME_CLEAN; ?>">View Demo</a>
                                <a id="support_options_bottom" target="_blank" class="nimbus_button_big_gray" href="<?php echo SUPPORTINFOURL; ?>?utm_source=<?php echo THEME_NAME_CLEAN; ?>&utm_medium=theme&utm_content=support_button&utm_campaign=<?php echo THEME_NAME_CLEAN; ?>">Get Help</a>   
                                <?php 
                                submit_button( 'Save', 'nimbus_button_big_blue', 'update', false, array( 'id' => 'update_options_top'));
                                ?>
                            </div>
                        </form>
                    </div>
                    <div class="clear20"></div>
                </div> 
            </div> 
        </div>
        <div style="clear:both;"></div>
        <?php
    }
}


/* * *************************************************************************************************** */
// On options form submit do:
/* * *************************************************************************************************** */

function nimbus_options_sanitize($input) {

    global $NIMBUS_OPTIONS_ARR;

    // Do if selected reset button
    if (isset($_POST['reset'])) {
        $alert = __('Default options restored.', 'nimbus');
        add_settings_error('nimbus-options', 'restore_defaults', $alert, 'updated fade');
        return nimbus_return_defaults();
    }
    
    // Do if selected loaddemo button
    if (isset($_POST['loaddemo'])) {
        $alert = __('Demo content is loaded', 'nimbus');
        add_settings_error('nimbus-options', 'demo_loaded', $alert, 'updated fade');
        nimbus_load_demo_content();
    }

    // Do if selected save button
    if (isset($_POST['update'])) {
        $clean = array();
        $options = $NIMBUS_OPTIONS_ARR;
        foreach ($options as $option) {
            if (!isset($option['id'], $option['type']) || ($option['type'] == 'tab') || ($option['type'] == 'item_html')) {
                continue;
            }
            $id = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($option['id']));
            
            // Set checkbox to false if it wasn't sent in the $_POST
            if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
                $input[$id] = false;
            }

            // Set each item in the multicheck to false if it wasn't sent in the $_POST
            if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
                foreach ( $option['options'] as $key => $value ) {
                    $input[$id][$key] = false;
                }
            }
            
            // Apply filters
            if (isset($input[$id])) {
                if (has_filter('nimbus_filter_' . $option['type'])) {
                    $clean[$id] = apply_filters('nimbus_filter_' . $option['type'], $input[$id], $option);
                } else {
                    $clean[$id] = $input[$id];
                }
            }
        }
        $alert = __('Options saved.', 'nimbus');
        add_settings_error('nimbus-options', 'save_options', $alert, 'updated fade');
        return $clean;
    }
}

/* * *************************************************************************************************** */
// Return default options
/* * *************************************************************************************************** */

function nimbus_return_defaults() {

    global $NIMBUS_OPTIONS_ARR;
    $defaults_return = array();
    $options = $NIMBUS_OPTIONS_ARR;
    foreach ((array) $options as $option) {
        if (!isset($option['id'], $option['default'])) {
            continue;
        }
        $defaults_return[$option['id']] = $option['default'];
    }
    return $defaults_return;
}

/* * *************************************************************************************************** */
// Helper to return options.
/* * *************************************************************************************************** */

if (!function_exists('nimbus_get_option')) {
    function nimbus_get_option($option_data, $default_data = false) {
        global $NIMBUS_OPTIONS_ARR;
        $options = get_option(THEME_OPTIONS);
        $default_options = $NIMBUS_OPTIONS_ARR;
        if (isset($options[$option_data])) {
            return $options[$option_data];
        } else {
            $default = $default_options[$option_data]['default'];
            return $default;
        }
    }
}

/* * *************************************************************************************************** */
// WP_head options.
/* * *************************************************************************************************** */

add_action('wp_head', 'nimbus_options_to_head');

function nimbus_options_to_head() {

    global $NIMBUS_FONT_FACES, $NIMBUS_OPTIONS_ARR;
    
    $get_fonts = $NIMBUS_FONT_FACES;
    $options = $NIMBUS_OPTIONS_ARR;
    
    foreach ($options as $option) {
        if (($option['type'] == "typography") || ($option['type'] == "font")  || ($option['type'] == "face")) {
            $$option['id'] = nimbus_get_option($option['id']);
        }    
    }
    $font_list = array();
    foreach ($options as $option) {
        if (($option['type'] == "typography") || ($option['type'] == "font")  || ($option['type'] == "face")) {
            $nimbus_get_face = nimbus_get_option($option['id']);
            array_push($font_list, $nimbus_get_face['face']);
        }    
    }
    $filtered_font_list = array_unique($font_list);
    foreach ($filtered_font_list as $key => $font) {
        if(isset($get_fonts[$font])){
            echo $get_fonts[$font]['import'];
            echo "\n";
        }
    }
    ?>

        <!-- Style from <?php echo THEME_NAME; ?> Theme Options. --> <?php echo "\n"; ?> 
    <style type="text/css"><?php echo "\n"; ?> 
    
        /**  Body/General **/
        
        body { font:<?php echo $body_style['style']; ?> <?php echo $body_style['size']; ?>/<?php echo $body_style['line']; ?> <?php echo $get_fonts[$body_style['face']]['fam']; ?>;  color:<?php echo $body_style['color']; ?>;  text-transform:<?php echo $body_style['fonttrans']; ?>; } 
        #ribbon_wrap, #content_wrap { -webkit-box-shadow: 0px 0px 9px 1px <?php echo nimbus_get_option('ribbon_content_shadow_color') ?>; -moz-box-shadow: 0px 0px 9px 1px <?php echo nimbus_get_option('ribbon_content_shadow_color') ?>; box-shadow: 0px 0px 9px 1px <?php echo nimbus_get_option('ribbon_content_shadow_color') ?>; }
        
        /**  Links **/
        
        a { color:<?php echo nimbus_get_option('link_color'); ?>; }
        a:hover { color:<?php echo nimbus_get_option('link_hover_color'); ?>; }
        
        /**  Titles **/
        
        h1 { font:<?php echo $h1_style['style']; ?> <?php echo $h1_style['size']; ?>/<?php echo $h1_style['line']; ?> <?php echo $get_fonts[$h1_style['face']]['fam']; ?>; color:<?php echo $h1_style['color']; ?>;  text-transform:<?php echo $h1_style['fonttrans']; ?>; } 
        h2, div.editable h2 a, h3#reply-title { font:<?php echo $h2_style['style']; ?> <?php echo $h2_style['size']; ?>/<?php echo $h2_style['line']; ?> <?php echo $get_fonts[$h2_style['face']]['fam']; ?>; color:<?php echo $h2_style['color']; ?>; text-transform:<?php echo $h2_style['fonttrans']; ?>; }
        h3 { font:<?php echo $h3_style['style']; ?> <?php echo $h3_style['size']; ?>/<?php echo $h3_style['line']; ?> <?php echo $get_fonts[$h3_style['face']]['fam']; ?>; color:<?php echo $h3_style['color']; ?>;  text-transform:<?php echo $h3_style['fonttrans']; ?>; }
        h4 { font:<?php echo $h4_style['style']; ?> <?php echo $h4_style['size']; ?>/<?php echo $h4_style['line']; ?> <?php echo $get_fonts[$h4_style['face']]['fam']; ?>; color:<?php echo $h4_style['color']; ?>;  text-transform:<?php echo $h4_style['fonttrans']; ?>;}
        h5 { font:<?php echo $h5_style['style']; ?> <?php echo $h5_style['size']; ?>/<?php echo $h5_style['line']; ?> <?php echo $get_fonts[$h5_style['face']]['fam']; ?>; color:<?php echo $h5_style['color']; ?>;  text-transform:<?php echo $h5_style['fonttrans']; ?>;}
        h6 { font:<?php echo $h6_style['style']; ?> <?php echo $h6_style['size']; ?>/<?php echo $h6_style['line']; ?> <?php echo $get_fonts[$h6_style['face']]['fam']; ?>; color:<?php echo $h6_style['color']; ?>;  text-transform:<?php echo $h6_style['fonttrans']; ?>;}	
        div.sidebar_widget h3, #side_menu h2 a { font:<?php echo $sidebar_title_style['style']; ?> <?php echo $sidebar_title_style['size']; ?>/<?php echo $sidebar_title_style['line']; ?> <?php echo $get_fonts[$sidebar_title_style['face']]['fam']; ?>; color:<?php echo $sidebar_title_style['color']; ?>;  text-transform:<?php echo $sidebar_title_style['fonttrans']; ?>;}
        div.footer_widget h3 { font:<?php echo $footer_title_style['style']; ?> <?php echo $footer_title_style['size']; ?>/<?php echo $footer_title_style['line']; ?> <?php echo $get_fonts[$footer_title_style['face']]['fam']; ?>; color:<?php echo $footer_title_style['color']; ?>;  text-transform:<?php echo $footer_title_style['fonttrans']; ?>;}
        
        /**  header **/ 
        
        .text_logo, #footer_text_logo, .text_logo a, #footer_text_logo a { font:<?php echo $logo_style['style']; ?> <?php echo $logo_style['size']; ?>/<?php echo $logo_style['line']; ?> <?php echo $get_fonts[$logo_style['face']]['fam']; ?>; color:<?php echo $logo_style['color']; ?>;  text-transform:<?php echo $logo_style['fonttrans']; ?>;}
        #contact_line ul li, #contact_line ul li a, #contact_line ul li span { font:<?php echo $head_contact_style['style']; ?> <?php echo $head_contact_style['size']; ?>/<?php echo $head_contact_style['line']; ?> <?php echo $get_fonts[$head_contact_style['face']]['fam']; ?>; color:<?php echo $head_contact_style['color']; ?>;  text-transform:<?php echo $head_contact_style['fonttrans']; ?>;}
        #header, #header_frontpage { background:<?php echo nimbus_get_option('header_bg_color') ?>; }
        #ribbon_wrap { background:<?php echo nimbus_get_option('ribbon_bg_color') ?>; }
        
        /**  Menu **/
        
        div.menu ul ul { background:<?php echo nimbus_get_option('dd_bg_color') ?>; border:1px solid <?php echo nimbus_get_option('dd_border_color') ?>; }
        div.menu ul li a { font:<?php echo $main_menu_style['style']; ?> <?php echo $main_menu_style['size']; ?>/<?php echo $main_menu_style['line']; ?> <?php echo $get_fonts[$main_menu_style['face']]['fam']; ?>; color:<?php echo $main_menu_style['color']; ?>;  text-transform:<?php echo $main_menu_style['fonttrans']; ?>; }
        div.menu ul li li a {  font:<?php echo $sub_menu_style['style']; ?> <?php echo $sub_menu_style['size']; ?>/<?php echo $sub_menu_style['line']; ?> <?php echo $get_fonts[$sub_menu_style['face']]['fam']; ?>; color:<?php echo $sub_menu_style['color']; ?>;  text-transform:<?php echo $sub_menu_style['fonttrans']; ?>;  }
        
        /**  footer **/
        
        #footer p, #footer a, #footer span, #footer .textwidget { font:<?php echo $footer_text_style['style']; ?> <?php echo $footer_text_style['size']; ?>/<?php echo $footer_text_style['line']; ?> <?php echo $get_fonts[$footer_text_style['face']]['fam']; ?>; color:<?php echo $footer_text_style['color']; ?>;  text-transform:<?php echo $footer_text_style['fonttrans']; ?>;}
        #footer_wrap { background:<?php echo nimbus_get_option('nimbus_footer_bg_color') ?>; }
        p#copyright, p#copyright a, p#credit, p#credit a { font:<?php echo $copyright_style['style']; ?> <?php echo $copyright_style['size']; ?>/<?php echo $copyright_style['line']; ?> <?php echo $get_fonts[$copyright_style['face']]['fam']; ?>; color:<?php echo $copyright_style['color']; ?>;  text-transform:<?php echo $copyright_style['fonttrans']; ?>;}
        code, pre, var { font-family:<?php echo $get_fonts[$code_style['face']]['fam']; ?>; color:<?php echo $code_style['color']; ?>; }
        
        /**  frontpage **/
        
        #action_text_wrap { border-bottom:1px solid <?php echo nimbus_get_option('action_border_color_bottom'); ?>; background: <?php echo nimbus_get_option('action_bg_color_bottom'); ?>; background: -moz-linear-gradient(top, <?php echo nimbus_get_option('action_bg_color_top'); ?> 0%, <?php echo nimbus_get_option('action_bg_color_bottom'); ?> 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo nimbus_get_option('action_bg_color_top'); ?>), color-stop(100%,<?php echo nimbus_get_option('action_bg_color_bottom'); ?>)); background: -webkit-linear-gradient(top, <?php echo nimbus_get_option('action_bg_color_top'); ?> 0%,<?php echo nimbus_get_option('action_bg_color_bottom'); ?> 100%); background: -o-linear-gradient(top, <?php echo nimbus_get_option('action_bg_color_top'); ?> 0%,<?php echo nimbus_get_option('action_bg_color_bottom'); ?> 100%); background: -ms-linear-gradient(top, <?php echo nimbus_get_option('action_bg_color_top'); ?> 0%,<?php echo nimbus_get_option('action_bg_color_bottom'); ?> 100%); background: linear-gradient(top, <?php echo nimbus_get_option('action_bg_color_top'); ?> 0%,<?php echo nimbus_get_option('action_bg_color_bottom'); ?> 100%);  }
        #action_text p { font:<?php echo $action_style['style']; ?> <?php echo $action_style['size']; ?>/<?php echo $action_style['line']; ?> <?php echo $get_fonts[$action_style['face']]['fam']; ?>; color:<?php echo $action_style['color']; ?>;  text-transform:<?php echo $action_style['fonttrans']; ?>;}
        
        /**  Tables **/
        
        th, ul.css-tabs a, div.accordion h2, h2.hide_show_title span { font:<?php echo $th_style['style']; ?> <?php echo $th_style['size']; ?>/<?php echo $th_style['line']; ?> <?php echo $get_fonts[$th_style['face']]['fam']; ?>; color:<?php echo $th_style['color']; ?>;  text-transform:<?php echo $th_style['fonttrans']; ?>;}
        td { font:<?php echo $td_style['style']; ?> <?php echo $td_style['size']; ?>/<?php echo $td_style['line']; ?> <?php echo $get_fonts[$td_style['face']]['fam']; ?>; color:<?php echo $td_style['color']; ?>;  text-transform:<?php echo $td_style['fonttrans']; ?>;}
        caption { font:<?php echo $tc_style['style']; ?> <?php echo $tc_style['size']; ?>/<?php echo $tc_style['line']; ?> <?php echo $get_fonts[$tc_style['face']]['fam']; ?>; color:<?php echo $tc_style['color']; ?>;  text-transform:<?php echo $tc_style['fonttrans']; ?>;}
        
        /**  Banner **/
        
        div#small_slider_wrap, div#full_slider_wrap, div#frontpage_banner img.wp-post-image { border:1px solid <?php echo nimbus_get_option('banner_image_stroke_color') ?>; background:<?php echo nimbus_get_option('banner_image_border_color') ?>; -webkit-box-shadow: 0px 0px 8px 0px <?php echo nimbus_get_option('banner_image_shadow_color') ?>; -moz-box-shadow: 0px 0px 8px 0px <?php echo nimbus_get_option('banner_image_shadow_color') ?>; box-shadow: 0px 0px 8px 0px <?php echo nimbus_get_option('banner_image_shadow_color') ?>; }
        
        /**  Images **/
        
        .wp-post-image, img.avatar, div.featured_placeholder_wrap, .editable .gallery img { border:1px solid <?php echo nimbus_get_option('image_stroke_color') ?>; background:<?php echo nimbus_get_option('image_border_color') ?>; -webkit-box-shadow: 0px 0px 8px 0px <?php echo nimbus_get_option('image_shadow_color') ?>; -moz-box-shadow: 0px 0px 8px 0px <?php echo nimbus_get_option('image_shadow_color') ?>; box-shadow: 0px 0px 8px 0px <?php echo nimbus_get_option('image_shadow_color') ?>; }
        
        /**  Odds & Ends **/
        
        blockquote, div.quote p, div.quote a { font:<?php echo $blockquote_style['style']; ?> <?php echo $blockquote_style['size']; ?>/<?php echo $blockquote_style['line']; ?> <?php echo $get_fonts[$blockquote_style['face']]['fam']; ?>; color:<?php echo $blockquote_style['color']; ?>;  text-transform:<?php echo $blockquote_style['fonttrans']; ?>;  }
        .pullquote_left p, .pullquote_right p { font:<?php echo $pullquote_style['style']; ?> <?php echo $pullquote_style['size']; ?>/<?php echo $pullquote_style['line']; ?> <?php echo $get_fonts[$pullquote_style['face']]['fam']; ?>; color:<?php echo $pullquote_style['color']; ?>;  text-transform:<?php echo $pullquote_style['fonttrans']; ?>;  }
        
        <?php echo "\n"; ?> 
    </style>
    <?php
    echo "\n";
}


/* * *************************************************************************************************** */
// WP_head Textarea from Scripts Tab
/* * *************************************************************************************************** */

add_action('wp_head', 'nimbus_scripts_to_head');

function nimbus_scripts_to_head() {

    echo nimbus_get_option('scripts_head');
}

/* * *************************************************************************************************** */
// WP_footer Textarea from Scripts Tab
/* * *************************************************************************************************** */

add_action('wp_footer', 'nimbus_scripts_to_footer');

function nimbus_scripts_to_footer() {

    echo nimbus_get_option('scripts_foot');
}

/* * *************************************************************************************************** */

// Scripts Top Content
/* * *************************************************************************************************** */

function nimbus_scripts_content_top() {

    echo nimbus_get_option('scripts_top_content');
}

/* * *************************************************************************************************** */

// Scripts Bottom Content
/* * *************************************************************************************************** */

function nimbus_scripts_content_bottom() {

    echo nimbus_get_option('scripts_bottom_content');
}

