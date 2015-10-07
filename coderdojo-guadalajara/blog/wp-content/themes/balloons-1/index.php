<? include ("header.php"); ?>


			<?php while ( have_posts() ) : the_post() ?>	


				<div class="entry">
				

					
						<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
						
						<div class="meta"><p>	
							<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { 
    							the_time(__('m/d/y'));
    						} else { 
    							the_time(__('d.m.y'));
    						} ?> 
						</p></div>
						

					<?php the_content('(...)'); ?>
					

					<p class="meta">
					
							<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { 
    							comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)'));
    						} else { 
    							comments_popup_link(__('Kommentar (0)'), __('Kommentare (1)'), __('Kommentare (%)'));
    						} ?> 
					
					</p>			    		
			
				</div> <!-- end .entry -->
	
	
				<?php endwhile; ?>


<? include ("footer.php"); ?>