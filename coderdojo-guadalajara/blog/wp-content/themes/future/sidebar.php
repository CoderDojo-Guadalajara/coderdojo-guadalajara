<?php
if( future_cs_layout( array( 'cs_layout_bone' => 'cs_layout', 'echo' => false ) ) == 'content' ) {
	return;
}
?>
<div class="<?php future_cs_layout( array( 'cs_layout_bone' => 'sidebar_column_class' ) ); ?>">
  <aside class="sidebar sidebar-primary widget-area" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">  
	<?php 
	if ( ! dynamic_sidebar( 'future-primary-sidebar' ) ) :
	$future_theme_data = future_theme_data();
	?>
	<section class="widget widget_search">
		<div class="widget-inside">
			<?php get_search_form(); ?>
		</div>
	</section>
	<section class="widget widget_recent_entries">
		<div class="widget-inside">
			<h3 class="widget-title"><?php _e( 'Recent Posts', 'future' ); ?></h3>
			<ul><?php wp_get_archives('type=postbypost&limit=5'); ?></ul>
		</div>
	</section>
	<section class="widget widget_archive">
		<div class="widget-inside">
			<h3 class="widget-title"><?php _e( 'Archives', 'future' ); ?></h3>
			<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>
		</div>
	</section>
	<section class="widget widget_text widget-last">
		<div class="widget-inside">
			<h3 class="widget-title"><?php _e( 'About Future', 'contango' ); ?></h3>
			<div class="textwidget"><?php printf( __( '%s', 'contango' ), $future_theme_data['Description'] ); ?></div>
		</div>
	</section>
	<?php endif; ?>
  </aside>
</div>