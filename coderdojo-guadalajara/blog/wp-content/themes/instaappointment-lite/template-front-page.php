<?php
/*
Template Name: Home : Front Page Template
*/
get_header(); 
?>
	<?php
	global $instaapp_shortname, $wp_query;
				
include("includes/front-featured-boxes-section.php"); // FEATURED BOXES SECTION
			
			
include("includes/front-parallax-section.php"); // STATISTICS PARALLAX SECTION
?>			
<!-- PAGE EDITER CONTENT -->
<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
		<div id="front-content-box" class="instaapp-section">
			<div class="container">
				 <div class="row-fluid"> 
						<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>