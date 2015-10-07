<? include ("header.php"); ?>
				
						
			<div class="entry archives">			
						
				<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
					<h2>Archives</h2>
				<?php } else { ?>
					<h2>Archiv</h2>
				<?php } ?>
				
				
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					
					<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>	
							
					<?php the_excerpt(); ?>
		
				<?php endwhile; ?>
			
			</div> <!-- end .entry -->
		

<? include ("footer.php"); ?>