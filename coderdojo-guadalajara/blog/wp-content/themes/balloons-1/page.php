<? include ("header.php"); ?>


		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
			<div class="entry">
	
				<div class="entry-header">
					<h2><?php the_title(); ?></h2>	
				</div>	
			
				<?php the_content(); ?>

			</div> <!-- end .entry -->
			
		<?php endwhile; ?>


<? include ("footer.php"); ?>