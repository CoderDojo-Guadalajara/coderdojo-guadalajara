<form class="searchform form-inline" role="form" method="get" action="<?php echo trailingslashit( esc_url( home_url() ) ); ?>">
  <div class="form-group">
    <label class="sr-only" for="s"><?php _e( 'Search for:', 'future' ); ?></label>
    <input type="text" class="form-control" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'future' ); ?>">
  </div>  
  <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Search', 'future' ); ?></button>
</form>