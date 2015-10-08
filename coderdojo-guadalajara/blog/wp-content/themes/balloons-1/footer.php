				<div id="footer-entry">
				
					<?php if(function_exists('wp_paginate')) { 
					    wp_paginate(); 
					} else { ?>
					
					<div class="navigation standard"> 
						<?php previous_posts_link('&#8249; ', '0');
					    next_posts_link('&#8250; ', '0'); ?>
					</div> <!-- end .navigation -->
					
					<?php } ?>
					
					<div id="credits">
					
				<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
					Balloons theme by<br />
					<a href="http://moargh.de">Moargh.de</a>
				<?php } else {  ?>
					Balloons Template von<br />
					<a href="http://moargh.de">Moargh.de</a>
				<?php } ?>
				
					</div> <!-- end #credits -->
					
			</div> <!-- end .pagination-entry -->


		</div> <!-- end container -->



		<div id="footer">
		
			<div id="footer-inner">
				
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : ?><?php endif; ?>

			
			</div></div> <!-- end #footer -->	


		<div id="parallax-01">
		    <img id="balloons-01" src="<?php bloginfo('template_url'); ?>/img/balloons-01.png" width="135" height="848" alt="" />
		</div>

		<div id="parallax-02">
		    <img id="balloons-02" src="<?php bloginfo('template_url'); ?>/img/balloons-02.png" width="136" height="848" alt="" />
		</div>

		<div id="parallax-03">
		    <img id="balloons-03" src="<?php bloginfo('template_url'); ?>/img/balloons-03.png" width="63" height="922" alt="" />
		</div>
		
		<div id="parallax-04">
		    <img id="balloons-04" src="<?php bloginfo('template_url'); ?>/img/balloons-04.png" width="73" height="828" alt="" />
		</div>

		<div id="parallax-05">
		    <img id="balloons-05" src="<?php bloginfo('template_url'); ?>/img/balloons-05.png" width="171" height="899" alt="" />
		</div>

		<div id="parallax-06">
		    <img id="balloons-06" src="<?php bloginfo('template_url'); ?>/img/balloons-06.png" width="216" height="928" alt="" />
		</div>

		<div id="parallax-07">
		    <img id="balloons-07" src="<?php bloginfo('template_url'); ?>/img/balloons-07.png" width="65" height="735" alt="" />
		</div>		


	</div> <!-- end #wrapper -->
	
	
</body>


</html>