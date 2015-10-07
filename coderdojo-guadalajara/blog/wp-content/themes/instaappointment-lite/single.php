<?php 
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<?php global $instaapp_shortname; ?>
<div class="main-wrapper-item">
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
	
<div class="container post-wrap">
	<div class="row-fluid">
		<div id="container" class="span8">
			<div id="content">  
					<div class="post" id="post-<?php the_ID(); ?>">
					  <div class="single_post_wrap">
						<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
							<div class="featured-image-shadow-box quote_featured_img">
								<?php the_post_thumbnail('instaapp_standard_img'); ?>
							</div>
						<?php } ?>

						<div class="post_inner_wrap clearfix">

							<div class="skepost-meta clearfix">
							    <span class="date"><?php _e('<i class="fa fa-calendar"></i>','instaapp');?><?php the_time('j.M, Y') ?></span>
							    <span class="author-name"><?php _e('<i class="fa fa-user"></i>','instaapp');?><?php the_author_posts_link(); ?></span>
							    <span class="comments"><?php _e('<i class="fa fa-comment"></i>','instaapp');?><?php comments_popup_link(__('0','instaapp'), __('1','instaapp'), __('%','instaapp')) ; ?></span>
								<?php the_tags('<span class="tags"><i class="fa fa-tag"></i>',', ','</span>'); ?>
								<?php if (has_category()) { ?><span class="category"><?php _e('<i class="fa fa-list-ul"></i> ','instaapp');?><?php the_category(','); ?></span><?php } ?>								
					        </div>
							<!-- skepost-meta -->
							
							<h1 class="post-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</h1>
							<!-- post title -->

							 <div class="skepost">
								<?php the_excerpt(); ?>
					        </div>
					        <!-- skepost -->
				        </div>

				      </div><!-- single-post-wrap -->

						<div class="navigation"> 
							<?php previous_post_link( __('<span class="nav-previous"><i class="fa fa-angle-left"></i> %link</span>','instaapp')); ?>
							<?php next_post_link( __('<span class="nav-next">%link <i class="fa fa-angle-right"></i></span>','instaapp')); ?> 
						</div>

						<div class="clearfix"></div>
						<div class="comments-template">
							<?php comments_template( '', true ); ?>
						</div>
					</div>
				<!-- post -->
				<?php endwhile; ?>
				<?php else :  ?>

				<div class="post">
					<h2><?php _e('Not Found','instaapp'); ?></h2>
				</div>
				<?php endif; ?>
			</div><!-- content --> 
		</div><!-- container --> 

		<!-- Sidebar -->
		<div id="sidebar" class="span4">
			<?php get_sidebar(); ?>
		</div>
		<!-- Sidebar --> 

	</div>
 </div>
</div>
<?php get_footer(); ?>