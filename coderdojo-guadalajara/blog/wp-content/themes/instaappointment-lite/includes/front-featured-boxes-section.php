<?php global $instaapp_shortname; ?>
<?php 
	$_featured_heading 		= instaapp_get_option($instaapp_shortname.'_featured_heading');
	
	$_featured_title1 		= instaapp_get_option($instaapp_shortname.'_fb1_first_part_heading');
	$_featured_link1        = instaapp_get_option($instaapp_shortname.'_fb1_first_part_link');
	$_featured_iconclass1        = instaapp_get_option($instaapp_shortname.'_fb1_first_icon_class');
	$_featured_content1 	= instaapp_get_option($instaapp_shortname.'_fb1_first_part_content');
	
	
	$_featured_title2 		= instaapp_get_option($instaapp_shortname.'_fb2_second_part_heading');
	$_featured_link2        = instaapp_get_option($instaapp_shortname.'_fb2_second_part_link');
	$_featured_iconclass2        = instaapp_get_option($instaapp_shortname.'_fb2_second_icon_class');
	$_featured_content2 	= instaapp_get_option($instaapp_shortname.'_fb2_second_part_content');
	

	$_featured_title3 		= instaapp_get_option($instaapp_shortname.'_fb3_third_part_heading');
	$_featured_link3        = instaapp_get_option($instaapp_shortname.'_fb3_second_part_link');
	$_featured_iconclass3        = instaapp_get_option($instaapp_shortname.'_fb3_third_icon_class');
	$_featured_content3 	= instaapp_get_option($instaapp_shortname.'_fb3_third_part_content');
	
 
 ?>
<div id="featured-box" class="instaapp-section">

	<!-- container -->
	<div class="container">
		<?php if (isset($_featured_heading) && $_featured_heading !='') { ?><h2 class="section_heading"><?php echo $_featured_heading; ?></h2><?php } ?>

		<!-- row-fluid -->
		<div class="mid-box-mid row-fluid">

		<?php if($_featured_title1 || $_featured_iconclass1 || $_featured_content1) { ?>
			<!-- Featured Box 1 -->
			<div class="mid-box span4 fade_in_hide element_fade_in">
				<div class="instaapp-iconbox iconbox-top">		
					<div class="iconbox-icon instaapp-animated small-to-large instaapp-viewport">
						<div class="featured_inner">
							<div class="featured_icon">
								<?php if($_featured_iconclass1) { ?>	
									<i class="fa <?php if ( isset($_featured_iconclass1) && $_featured_iconclass1 !='') { echo $_featured_iconclass1;  } ?>"></i>
								<?php } ?>
							</div>
							<?php if($_featured_title1) { ?><h4><?php echo $_featured_title1; ?></h4><?php } ?>
						</div>
					</div>
					<div class="iconbox-content">		
						<a href="<?php if($_featured_link1) { echo esc_url($_featured_link1); } ?>" title="<?php if($_featured_title1) { echo $_featured_title1; } ?>"><?php if($_featured_content1) { echo instaapp_slider_limit_words($_featured_content1, '40'); } ?></a>
					</div>			
				</div>
			</div>
			<?php } ?>

			<?php if($_featured_title2 || $_featured_iconclass2 || $_featured_content2) { ?>
			<!-- Featured Box 2 -->
			<div class="mid-box span4 fade_in_hide element_fade_in">
				<div class="instaapp-iconbox iconbox-top">		
					<div class="iconbox-icon instaapp-animated small-to-large instaapp-viewport">
						<div class="featured_inner">
							<div class="featured_icon">
								<?php if($_featured_iconclass2) { ?>	
									<i class="fa <?php if ( isset($_featured_iconclass2) && $_featured_iconclass2 !='' ) { echo $_featured_iconclass2;  } ?>"></i>
								<?php } ?>
							</div>
							<?php if($_featured_title2) { ?><h4><?php echo $_featured_title2; ?></h4><?php } ?>
						</div>
					</div>		
					<div class="iconbox-content">		
						<a href="<?php if($_featured_link2) { echo esc_url($_featured_link2); } ?>" title="<?php if($_featured_title2) { echo $_featured_title2; } ?>"><?php if($_featured_content2) { echo instaapp_slider_limit_words($_featured_content2, '40'); } ?></a>
					</div>			
				</div>
			</div>
			<?php } ?>
			
			<?php if($_featured_title3 || $_featured_iconclass3 || $_featured_content3) { ?>
			<!-- Featured Box 3 -->
			<div class="mid-box span4 fade_in_hide element_fade_in">
				<div class="instaapp-iconbox iconbox-top">
					<div class="iconbox-icon instaapp-animated small-to-large instaapp-viewport">
						<div class="featured_inner">
							<div class="featured_icon">
								<?php if($_featured_iconclass3) { ?>	
									<i class="fa <?php if ( isset($_featured_iconclass3) && $_featured_iconclass3 !='' ) { echo $_featured_iconclass3;  } ?>"></i>
								<?php } ?>
							</div>
							<?php if($_featured_title3) { ?><h4><?php echo $_featured_title3; ?></h4><?php } ?>
						</div>
					</div>		
					<div class="iconbox-content">		
						<a href="<?php if($_featured_link3) { echo esc_url($_featured_link3); } ?>" title="<?php if($_featured_title3) { echo $_featured_title3; } ?>"><?php if($_featured_content3) { echo instaapp_slider_limit_words($_featured_content3, '40'); } ?></a>
					</div>				
				</div>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
		</div>
		<!-- row-fluid -->
		
	</div>
	<!-- container -->
</div>