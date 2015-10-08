<?php
/**
 * The template for displaying posts in the Quote post format.
 */
?>

<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">

		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
	        <div class="featured-image-shadow-box quote_featured_img">		
	        	<?php 
						$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'instaapp_standard_img');
				?>
				<a href="<?php the_permalink(); ?>" class="image">
					<img src="<?php echo $thumbnail[0];?>" alt="<?php the_title(); ?>" class="featured-image alignnon"/>
				</a>
			</div>
		<?php } ?>

		<div class="quote_post clearfix">
		    <?php
				//quote datas
				$post_id  =  get_the_ID();
				$quote 	  = get_post_meta($post->ID, "_instaapp_postType_quote", true);
			?>
			<?php if(isset($quote) && $quote !="") { ?>
				<blockquote class="instaapp-quote clearfix">
					<div class="quite_icon_cl"><i class="fa fa-quote-left"></i></div>
					<div class="quote_text_cl"><?php echo $quote ;?></div>
				</blockquote>
			<?php } ?>
		</div>

		<div class="post_inner_wrap clearfix">

			<div class="skepost-meta clearfix">
			    <span class="date"><?php _e('<i class="fa fa-calendar"></i>','instaapp');?><?php the_time('j.M, Y') ?></span><span class="author-name"><?php _e('<i class="fa fa-user"></i>','instaapp');?><?php the_author_posts_link(); ?></span><span class="blog-post-like"><?php if(function_exists('like_counter_p')) { like_counter_p(); } ?></span><span class="comments"><?php _e('<i class="fa fa-comment"></i>','instaapp');?><?php comments_popup_link(__('0','instaapp'), __('1','instaapp'), __('%','instaapp')) ; ?></span>
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

</div>
<!-- post -->