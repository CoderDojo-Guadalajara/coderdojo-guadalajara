<?php
/**
* The Header for our theme.
*/
?><!DOCTYPE html>
<?php global $instaapp_shortname, $instaapp_themename; ?>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<!--[if IE 9]>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<![endif]-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?> >
	<div id="wrapper" class="skepage">
		<div id="header_wrap">
			<div id="header-top" class="clearfix">
			<div class="container">      
				<div class="row-fluid"> 

					<!-- Head Topbar Left Section Starts -->
					<div class="span7">
						<!-- Top Contact Info Section Starts -->
						<?php $_head_callus = instaapp_get_option($instaapp_shortname.'_head_callus');
							if(isset($_head_callus) && $_head_callus !=""){ ?>
							<div class="topbar_info">
								<i class="fa fa-phone"></i><span class="head-phone"><?php _e('Call Us:','instaapp'); ?><a href="tel:<?php echo instaapp_get_option($instaapp_shortname.'_head_callus','instaapp'); ?>"><?php echo $_head_callus; ?></a></span>
							</div>
						<?php } ?>

						<!-- Top Contact Info Section Ends -->	
					</div>
					<!-- Head Topbar Left Section Ends -->
					
					<!-- Head Topbar Right Section Starts -->
					<div class="span5">

						<!-- Social Links Section -->
						<div class="social_icon">
							<ul class="clearfix">
								<?php if(instaapp_get_option($instaapp_shortname.'_linkedin_link')){ ?><li class="linkedin-icon"><a target="_blank" href="<?php echo esc_url(instaapp_get_option($instaapp_shortname.'_linkedin_link','instaapp')); ?>"><span class="fa fa-linkedin" title="Linkedin"></span></a></li><?php } ?>
								<?php if(instaapp_get_option($instaapp_shortname.'_tumblr_link')){ ?><li class="tumblr-icon"><a target="_blank" href="<?php echo esc_url(instaapp_get_option($instaapp_shortname.'_tumblr_link','instaapp')); ?>"><span class="fa fa-tumblr" title="Tumblr"></span></a></li><?php } ?>
								<?php if(instaapp_get_option($instaapp_shortname.'_twitter_link')){?><li class="tw-icon"><a target="_blank" href="<?php echo esc_url(instaapp_get_option($instaapp_shortname.'_twitter_link','instaapp')); ?>"><span class="fa fa-twitter" title="Twitter"></span></a></li><?php } ?>
								<?php if(instaapp_get_option($instaapp_shortname.'_fbook_link')){?><li class="fb-icon"><a target="_blank" href="<?php echo esc_url(instaapp_get_option($instaapp_shortname.'_fbook_link','instaapp')); ?>"><span class="fa fa-facebook" title="Facebook"></span></a></li><?php } ?>
								<?php if(instaapp_get_option($instaapp_shortname.'_gplus_link')){ ?><li class="gplus-icon"><a target="_blank" href="<?php echo esc_url(instaapp_get_option($instaapp_shortname.'_gplus_link','instaapp')); ?>"><span class="fa fa-google-plus" title="Google Plus"></span></a></li><?php } ?>
							</ul>
						</div>
						<!-- Social Links Section -->
					</div>
					<!-- Head Topbar Right Section Ends -->

				</div>
			</div>
		</div>
	

		<div id="header" class="skehead-headernav clearfix">
			<div class="glow">
				<div id="skehead">
					<div class="container">      
						<div class="row-fluid">      
							<!-- #logo -->
							<div id="logo" class="span4">
								<?php if(instaapp_get_option($instaapp_shortname."_logo_img")){ ?>
									<div class="logo_inner">
										<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" style="display: table;line-height: 0;" ><img class="logo" src="<?php echo instaapp_get_option($instaapp_shortname."_logo_img"); ?>" alt="<?php echo instaapp_get_option($instaapp_shortname."_logo_alt"); ?>" /></a>
									</div>
								<?php } else{ ?>
								<!-- #description -->
									<div id="site-title" class="logo_desp logo_inner">
										<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name') ?>" ><?php bloginfo('name'); ?></a>
										<div id="site-description"><?php bloginfo( 'description' ); ?></div>
									</div>
								<!-- #description -->
								<?php } ?>
							</div>
							<!-- #logo -->
							
							<!-- .top-nav-menu --> 
							<div class="top-nav-menu span8">							
								<div class="top-nav-menu">
									<?php 
										if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'Header' ) ) {
											wp_nav_menu(array( 'container_class' => 'instaapp-menu', 'container_id' => 'skenav', 'menu_id' => 'menu-main','menu' => 'Primary Menu','theme_location' => 'Header' )); 
										} else {
									?>
									<div class="instaapp-menu" id="skenav">
										<ul id="menu-main" class="menu">
											<?php wp_list_pages('title_li=&depth=0'); ?>
										</ul>
									</div>
									<?php } ?>
								</div>

							</div>
							<!-- .top-nav-menu --> 
						</div>
					</div>
				</div>
				<!-- #skehead -->
			</div>
			<!-- glow --> 
		</div>
		<div class="header-clone"></div>

	</div>
<!-- #header -->

<div class="head-slide-wrap clearfix">
<!-- header image section -->
  <?php $classes = get_body_class(); ?>
  <?php if(in_array('front-page',$classes)){ include("includes/front-bgimage-section.php"); }
?>
</div>
<div id="main" class="clearfix">