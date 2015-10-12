<div class="wrap future-settings">
  
  <?php 
  /** Get the parent theme data. */
  $future_theme_data = future_theme_data();
  screen_icon();
  ?>
  
  <h2><?php echo sprintf( __( '%1$s Theme Settings', 'future' ), $future_theme_data['Name'] ); ?></h2>    
  
  <?php settings_errors(); ?>
  
  <form action="options.php" method="post" id="future-form-wrapper">
    
    <div id="future-form-header" class="future-clearfix">
      <input type="submit" name="" id="" class="button button-primary" value="<?php _e( 'Save Changes', 'future' ); ?>">
    </div>
	
	<?php settings_fields( 'future_options_group' ); ?>
    
    <div id="future-sidebar">
      
      <ul id="future-group-menu">
        <li id="0_section_group_li" class="future-group-tab-link-li active"><a href="javascript:void(0);" id="0_section_group_li_a" class="future-group-tab-link-a" data-rel="0"><span><?php _e( 'Blog Settings', 'future' ); ?></span></a></li>
        <li id="1_section_group_li" class="future-group-tab-link-li"><a href="javascript:void(0);" id="1_section_group_li_a" class="future-group-tab-link-a" data-rel="1"><span><?php _e( 'Post Settings', 'future' ); ?></span></a></li>
        <li id="2_section_group_li" class="future-group-tab-link-li"><a href="javascript:void(0);" id="2_section_group_li_a" class="future-group-tab-link-a" data-rel="2"><span><?php _e( 'General Settings', 'future' ); ?></span></a></li>
      </ul>
    
    </div>
    
    <div id="future-main">
    
      <div id="0_section_group" class="future-group-tab">
        <?php do_settings_sections( 'future_section_blog_page' ); ?>
      </div>
      
      <div id="1_section_group" class="future-group-tab">
        <?php do_settings_sections( 'future_section_post_page' ); ?>
      </div>
      
      <div id="2_section_group" class="future-group-tab">
        <?php do_settings_sections( 'future_section_general_page' ); ?>
      </div>
      
    </div>
    
    <div class="clear"></div>
    
    <div id="future-form-footer" class="future-clearfix">
      <input type="submit" name="" id="" class="button button-primary" value="<?php _e( 'Save Changes', 'future' ); ?>">
    </div>
    
  </form>

</div>