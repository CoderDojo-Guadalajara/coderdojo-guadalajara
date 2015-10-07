		<?php $balloons_option = balloons_get_global_options(); ?>


		<div class="entry comments">

				
			<?php if ( comments_open() ) : ?>

						
				<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
        			<h2>Write a comment</h2>
        		<?php } else { ?>
        			<h2>Einen Kommentar schreiben</h2> 
        		<?php } ?> 			
			

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">


				<?php if ( is_user_logged_in() ) : ?>

					<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
				
						<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> 
						<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>">
						<?php _e('Log out'); ?></a></p>
					
        			<?php } else { ?>
        		
						<p><?php printf(__('Eingeloggt als %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> 
						<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Logout') ?>">
						<?php _e('Logout'); ?></a></p>
					
        		<?php } ?> 
        		

				<?php else : ?>
				
					<p>Name *<br />
					<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" /></p>
				
					<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
				    	<p>E-mail *<br />
    			    <?php } else { ?>
				    	<p>eMail *<br />
    			    <?php } ?> 
					<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" /></p>
				
				
					<p>Website<br />
					<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" /></p>
				
				<?php endif; ?>


					<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
					    <p>Message *<br />
    				<?php } else { ?>
					    <p>Nachricht *<br />
    				<?php } ?> 
					<textarea name="comment"></textarea></p>

					<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
				    	<input name="submit" type="submit" value="<?php esc_attr_e('Submit'); ?>" class="submit" />
    			    <?php } else { ?>
				    	<input name="submit" type="submit" value="<?php esc_attr_e('Abschicken'); ?>" class="submit" />
    			    <?php } ?> 
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

					<?php do_action('comment_form', $post->ID); ?>

				</form>


			<?php else : // Comments are closed ?>
			
			
			<p><h2>
				<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) {
    			    _e('Comments are closed.'); 
    			} else { 	
    			    _e('Die Kommentarfunktion ist deaktiviert.');    						
    			} ?> 				
    		</h2></p>
			
			
			<?php endif; ?>


			<h2>
				<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { 
				    comments_number(__('0 Comments'), __('1 Comment'), __('% Comments'));    						
				} else { 	
				    comments_number(__('0 Kommentare'), __('1 Kommentar'), __('% Kommentare'));	    						
				} ?> 
    		</h2>	
			
			
			<?php if ( have_comments() ) : ?>


			<ul id="commentlist">

				<?php foreach ($comments as $comment) : ?>
	
					<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	
						<p><span class="author"><?php comment_author_link() ?></span></p>
						<p><?php comment_text() ?></p>
					
						<p>			
							<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
    						 	<?php the_time(__('m/d/y')); ?> &ndash; <?php comment_time(__('g:i a')); ?>
    					<?php } else {  ?>
    							<?php the_time(__('d.m.y')); ?> &ndash; <?php comment_time(__('G:i')); ?>
    						<?php } ?> 
						</p>

					</li>

				<?php endforeach; ?>

			</ul> <!-- end #commentlist -->
			

			<?php else : // If there are no comments yet ?>
	
				<p>
					<?php if ( ($balloons_option['balloons_select-language'] == 'English') OR ($balloons_option['balloons_select-language'] == '') ) { ?>
					    There are no comments yet.
    				<?php } else { ?>
					    Bisher gibt es noch Kommentare zu diesem Eintrag.
    				<?php } ?> 
				</p>
			

			<?php endif; ?>
	
		
		</div> <!-- end .entry -->