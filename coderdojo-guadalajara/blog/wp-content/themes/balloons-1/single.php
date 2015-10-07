<? include ("header.php"); ?>

			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			

				<div class="entry">
										
						<h2><?php the_title() ?></h2>
						
						<div class="meta">
							<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { 
    							the_time(__('m/d/y'));
    						} else { 
    							the_time(__('d.m.y'));
    						} ?> 
    						<br />
    						<?php the_category(' / '); ?>	
						
						</div> 
						
						<p><?php the_content('(...)'); ?></p>

				</div> <!-- end .entry -->
				
			
				<?php comments_template(); ?>
			
			
			<?php endwhile; else: ?><?php endif; ?>


<? include ("footer.php"); ?>