<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class( 'media-center-xs' ); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<div class="site-wrapper">

<header class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

  <nav class="navbar navbar-static-top navbar-inverse" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
    <div class="container">
      
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-header-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php get_template_part( 'header', 'custom' ); ?>      
      </div>
      
      <?php future_primary_menu(); ?>
    
    </div>
  </nav>

</header>