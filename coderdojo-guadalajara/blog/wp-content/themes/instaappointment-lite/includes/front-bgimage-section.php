<div class="Skt-header-image">
<?php if(instaapp_get_option($instaapp_shortname.'_frontslider_stype')){ $front_bg_image = instaapp_get_option($instaapp_shortname.'_frontslider_stype'); } ?>
	<!-- header image -->
		<div class="instaapp-front-bgimg"><img alt="Background Image" class="ad-slider-image" src="<?php if(isset($front_bg_image)) { echo $front_bg_image; } ?>" ></div>
	<!-- end  header image  -->
</div>