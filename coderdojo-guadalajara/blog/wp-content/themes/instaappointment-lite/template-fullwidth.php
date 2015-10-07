<?php
/*
Template Name: Page : No Sidebar Template
*/
?>

<?php get_header(); ?>
<?php global $instaapp_shortname; ?>
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
<!-- BreadCrumb Section // -->
<div class="bread-title-holder">
	<div class="container">
		<div class="row-fluid">
			<div class="container_inner clearfix">
				<h1 class="title"><?php the_title(); ?></h1>
				<?php 
				if ((class_exists('instaapp_breadcrumb_class'))) {$instaapp_breadcumb->custom_breadcrumb();}
				?>
			</div>
		</div>
	</div>
</div>	
<!-- \\ BreadCrumb Section -->

<div class="page-content fullwidth-temp">
	<div class="container post-wrap">
		<div class="row-fluid">
			<div id="content" class="span12">
				<div class="post" id="post-<?php the_ID(); ?>">
					<div class="skepost">
						<?php the_content(); ?>
						<?php wp_link_pages(__('<p><strong>Pages:</strong> ','instaapp'), '</p>', __('number','instaapp')); ?>
						<?php edit_post_link('Edit', '', ''); ?>	
					</div>
					<!-- skepost -->
				</div>
				<!-- post -->

				<?php endwhile; ?>
				<?php else :  ?>
					<div class="post">
						<h2><?php _e('Not Found','instaapp'); ?></h2>
					</div>
				<?php endif; ?>
			</div>
			<!-- content --> 
		</div>
	</div>
</div>
<?php get_footer(); ?>