<?php global $instaapp_front_bg_image,$instaapp_shortname, $instaapp_themename, $post, $instaapp_headercolorpicker,$instaapp_mobi_menu_width, $instaapp_persistent_on_off, $instaapp_primary_color_scheme, $instaapp_breadcrumb_on_off; ?>
<?php 
	$instaapp_primary_color_scheme ="";

function instaapp_Hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
} 

	if ( is_page_template( 'template-front-page.php' ) ) {
		$_home_fullparallax_image = get_post_meta( $post->ID,'_home_fullparallax_image',true );
		$_home_testimonial_image = get_post_meta( $post->ID,'_home_testimonial_image',true );
	}
	
	if(instaapp_get_option($instaapp_shortname.'_frontslider_stype')){ $instaapp_front_bg_image = instaapp_get_option($instaapp_shortname.'_frontslider_stype'); } 
	if(instaapp_get_option($instaapp_shortname.'_primary_color_scheme')){ $instaapp_primary_color_scheme = instaapp_get_option($instaapp_shortname.'_primary_color_scheme'); }
	if(instaapp_get_option($instaapp_shortname.'_persistent_on_off')){ $instaapp_persistent_on_off = instaapp_get_option($instaapp_shortname.'_persistent_on_off');}
	if(instaapp_get_option($instaapp_shortname.'_bread_background')){ $_bread_background = instaapp_get_option($instaapp_shortname.'_bread_background'); } 
	if(instaapp_get_option($instaapp_shortname.'_fullparallax_image')){ $fullparallax_image = instaapp_get_option($instaapp_shortname.'_fullparallax_image'); } 
	if(instaapp_get_option($instaapp_shortname.'_moblie_menu')){ $instaapp_mobi_menu_width = instaapp_get_option($instaapp_shortname.'_moblie_menu'); } 
	if(is_page_template('template-contact-page.php') || is_page() || is_search() || is_home() || is_404() || is_front_page() || is_page_template('template-blog-full-width.php') || is_page_template('template-blog-left-sidebar-page.php') || is_page_template('template-blog-right-sidebar-page.php') || is_page_template('template-masonry.php') || is_archive()) {
		$_bread_background  = instaapp_bg_style(instaapp_get_option($instaapp_shortname.'_bread_background'));
	}

	if(is_page() || is_singular()) {
		$_bread_background  = instaapp_bg_style(instaapp_get_option($instaapp_shortname.'_bread_background'));
	}

	$hrgb = instaapp_Hex2RGB($instaapp_primary_color_scheme);
	$hR = $hrgb['red'];
	$hG = $hrgb['green'];
	$hB = $hrgb['blue'];
	$hrgbcolor = "rgba(". $hR .",". $hG .",". $hB .",.7)";

?>
<style type="text/css">

	/***************** THEME *****************/

	/*************** TOP HEADER **************/
	.social_icon li a:hover,.topbar_info:hover i,
	#footer .third_wrapper a:hover,
	.instaapp-footer-container ul li:hover:before,
	.instaapp-footer-container ul li:hover > a{}

	.map_overlay_text .fa,
	.service-icon i,.bread-title-holder a,.twitter_box a,#wp-calendar a:hover,
	ul.protfolio_details li .fa,#wrapper .hsearch .hsearch-close:hover,.flex-caption .slider-title
	 {
	 	
	 }

	 #logo #site-title a .firstlogoWord, #team-division-box .team-box-mid:hover .teamsocial a,
	 .video-container .play_btn:hover {color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;}

	.post h3,
	.contact-post h3,.contact-add strong,
	h3#reply-title,#comments,.comment-author cite { 
		color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;
	}
	.call_to_action .button-link.medium-button,
	#latest-project-section .port-readmore a.button-link,#sidebar .social li a:hover,
	.navigation .alignleft a,.navigation .alignright a {
		background-color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?> !important;
	}

	.call_to_action .button-link.medium-button:hover,
	#latest-project-section .port-readmore a.button-link:hover,.navigation .alignleft a:hover,.navigation .alignright a:hover {
		
	}

	a.large-button:hover, a.small-button:hover, a.medium-button:hover { 
	   
	}

	#header.skehead-headernav.skehead-headernav-shrink #skenav li > a:hover,
	#header.skehead-headernav.skehead-headernav-shrink #skenav li.current-menu-item.page_item.current_page_item > a{
    	background-color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;
	}

	.navigation .nav-previous:hover,
	.navigation .nav-next:hover,
	ul.protfolio_details li .fa,
	#content .contact-left form input[type="submit"],
	.contact-post .contact-add .fa, #contact-gmap-toggle, .error-txt-first img,
	blockquote,.instaapp-quote,
	#wp-calendar tbody a,.widget_tag_cloud a:hover,.widget_product_tag_cloud a:hover,#respond input[type="submit"],.comments-template .reply a,
	#instaapp-paginate a,.sktmenu-toggle, #header-top,#skenav ul ul li:hover,
	.instaapp-iconbox h4:after,.instaapp-section h2.section_heading:after,
	.bread-title-holder h1.title:after,.postformat-gallerydirection-nav li a:hover,a#backtop,
	ul.skeside li h3:after {
		background-color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;
	}
	#instaapp-paginate a {border: 1px solid <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;}
	
	#header-top .social_icon a {color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; }

	.filter a:hover,.filter li a.selected {color:<?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; border-bottom: 1px solid <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; }
	#container-isotop .project_box:hover .portfolio_overlay {background-color: rgba(0, 0, 0, 0.8); }
	.port_single_link a {background-color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;}
	.port_single_link a:hover, .leftsquare:after, .rightsquare:before{}

	.instaapp_price_table .price_table_inner ul li.table_title, .instaapp_price_table .price_table_inner ul li.prices,.continue a{background: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; }
	.sticky-post {border-color:<?php if(isset($bdrrgbcolor)){ echo $bdrrgbcolor; } ?>}
	.instaapp_price_table .price_table_inner .price_button a { border-color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; background-color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; }
	.social li a:hover{}
	.social li a:hover:before{color:#fff; }
	.flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover,.slider-link a:hover,#respond input[type="submit"]:hover,.instaapp-ctabox div.instaapp-ctabox-button a:hover,#portfolio-division-box a.readmore:hover,.project-item .icon-image,.project-item:hover,.continue a:hover,#instaapp-paginate .instaapp-current,.comments-template .reply a:hover,#content .contact-left form input[type="submit"]:hover,.service-icon:hover,.instaapp-parallax-button:hover,.instaapp_price_table .price_table_inner .price_button a:hover,#content .instaapp-service-page div.one_third:hover .service-icon,#content div.one_half .instaapp-service-page:hover .service-icon  {}
	.instaapp-ctabox div.instaapp-ctabox-button a,#portfolio-division-box .readmore,.slider-link a,.instaapp_tab_v ul.instaapp_tabs li.active,.instaapp_tab_h ul.instaapp_tabs li.active,.service-icon,.instaapp-parallax-button,#instaapp-paginate a:hover,#instaapp-paginate .instaapp-current,.instaapp-iconbox .iconbox-content h4 hr {} 	
	.clients-items li a:hover{}
	a,.instaapp_widget ul ul li:hover:before,.instaapp_widget ul ul li:hover a,.title a ,.skepost-meta a:hover,.post-tags a:hover,.entry-title a:hover,.readmore a:hover,#Site-map .sitemap-rows ul li a:hover ,.childpages li a,#Site-map .sitemap-rows .title,.instaapp_widget a,.instaapp_widget a:hover,#Site-map .sitemap-rows ul li:hover,.instaapp-title,span.team_name,.reply a, a.comment-edit-link,#full-subscription-box .sub-txt .first-word{color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;text-decoration: none;}
	.single #content .title,#content .post-heading,.childpages li ,.fullwidth-heading,#respond .required{} 

	*::-moz-selection{background: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;color:#fff;}
	::selection {background: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>;color:#fff;}
	#full-twitter-box,.progress_bar {}
	.instaapp-front-subs-widget input[type="submit"]{}
	
	#skenav ul ul.sub-menu li.current_page_item,
	#skenav ul ul.sub-menu li.current-menu-item,
	#skenav ul ul.sub-menu li.current-menu-parent,
	#header-top .dropdown-menu.langs li:hover a { background: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; }

	#skenav ul ul.sub-menu li.current_page_item > a,
	#skenav ul ul.sub-menu li.current-menu-ancestor > a,
	#skenav ul ul.sub-menu li.current-menu-item > a,
	#skenav ul ul.sub-menu li.current-menu-parent > a,
	#skenav ul ul.sub-menu li:hover > a, #header-top .dropdown-menu.langs li:hover a { color: #262626;}
	.instaapp-footer-container ul li {}
	.col-one .box .title, .col-two .box .title, .col-three .box .title, .col-four .box .title { }
	.instaapp-counter-h i, .error-txt {  color: <?php if(isset($instaapp_primary_color_scheme)){ echo $instaapp_primary_color_scheme; } ?>; }

	<?php $classes = get_body_class(); ?>
	<?php 
	if(!in_array('front-page',$classes)) 
	{
		if(isset($_bread_background) && $_bread_background !='') {	?>
				#header_wrap {<?php echo $_bread_background; ?>; padding-bottom: 15px;}
		<?php  }
		else{ ?>
				#header_wrap {background: none no-repeat scroll 0 0 rgba(0, 0, 0, 0.6); }
		<?php
			}
	}		
		else{ ?>
				#header_wrap {background: none no-repeat scroll 0 0 rgba(0, 0, 0, 0.6); }
		<?php
			}
	?>
		
	#full-division-box { background-image: url("<?php if(isset($fullparallax_image)){ echo $fullparallax_image; } ?>"); }
	
	
	.footer-seperator{background-color: rgba(0,0,0,.2);}
	#footer div.follow-icons li:hover a{}
	#footer div.follow-icons .social li:hover a:before{color: #747474 !important; }
	.instaapp-title.instaapp-footer-title { }


	.instaapp-iconbox.iconbox-top:hover .iconboxhover { }
	section > h1 { }
	#content .featured-image-shadow-box .fa {  }
	
		
	/********************** MAIN NAVIGATION PERSISTENT **********************/
	<?php if($instaapp_persistent_on_off === 'off') { ?>#header.skehead-headernav.skehead-headernav-shrink {position: relative;} .header-clone {display:none;} <?php } ?>
	<?php if($instaapp_breadcrumb_on_off === 'off') { ?>.bread-title-holder .cont_nav {display:none;} <?php } ?>

	@media only screen and (max-width : <?php if(isset($instaapp_mobi_menu_width)){ echo $instaapp_mobi_menu_width; } ?>px) {
		#menu-main {
			display:none;
		}

		#header .container {
			width:97%;
		}
	}
</style>

<script type="text/javascript">
jQuery(document).ready(function(){
'use strict';
	jQuery('#menu-main').sktmobilemenu({'fwidth':'<?php if(isset($instaapp_mobi_menu_width)){ echo $instaapp_mobi_menu_width; } ?>'});
});
</script> 