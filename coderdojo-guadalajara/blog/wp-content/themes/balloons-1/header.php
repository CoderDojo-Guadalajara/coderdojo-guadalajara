<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>
	
	<?php $balloons_option = balloons_get_global_options(); ?>
	
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   
		
	<title><?php global $page, $paged;
		wp_title( '/', true, 'right' );
		bloginfo( 'name' ); ?>
	</title>    
    
    
  	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" charset="utf-8" />


	<? include ("color-switcher.php"); ?>
   
   
	<?php
    	if ( ($balloons_option['balloons_site-title_line2'] == '') && ($balloons_option['balloons_site-title_line1'] != '') ) { // single-line title ?> 
    		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/1-line.css" media="screen" charset="utf-8" /> 
    		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/1-line_mobile.css" media="screen" charset="utf-8" /> 

    	<?php } 
    	
    	else if ( ($balloons_option['balloons_site-title_line1'] == '') && ($balloons_option['balloons_site-title_line2'] == '') ) { // "empty title" › "This is a WordPress theme" ?>
    	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/2-lines.css" media="screen" charset="utf-8" /> 
    	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/2-lines_mobile.css" media="screen" charset="utf-8" /> 
    	<?php } 
    	  
    	 else if ( ($balloons_option['balloons_site-title_line1'] == '&nbsp;') && ($balloons_option['balloons_site-title_line2'] == '&nbsp;') ) { // non-breaking spaces › empty title ?>
    	 	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/0-lines.css" media="screen" charset="utf-8" /> 
   			<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/0-lines_mobile.css" media="screen" charset="utf-8" /> 
   			
    	<?php } else { // double-line title ?>
    	  	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/2-lines.css" media="screen" charset="utf-8" />
    		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/title/2-lines_mobile.css" media="screen" charset="utf-8" />  
		<?php } ?>


		<script src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.37797.js"></script> 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> 
		<script>!window.jQuery && document.write('<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.6.1.min.js"><\/script>')</script>
		<script src="<?php bloginfo('template_url'); ?>/js/parallax.js"></script>
		

    	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/img/favicon.png" />


	<?php wp_head(); ?>

	
</head>


<body>

			
	<div id="wrapper">
	
	
		<div id="container">
			
			
			<div id="header">
		
		
				<div class="content">

					<div id="navigation">
						<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'title_li' => '') ); ?>
					</div> <!-- end #navigation -->

		
   					<h1>
   						<?php
   							if ($balloons_option['balloons_site-title_line1'] == '' && $balloons_option['balloons_site-title_line2'] == '') { ?>
   							This is a<br />
   							WordPress theme
   						<?php } else {
   							echo $balloons_option['balloons_site-title_line1']; ?><br />
    						<?php echo $balloons_option['balloons_site-title_line2']; 		
   		 				} ?>
    				</h1>


				</div> <!-- end .content -->


			</div> <!-- end #header -->