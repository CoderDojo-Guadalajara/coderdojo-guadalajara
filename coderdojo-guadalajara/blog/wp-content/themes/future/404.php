<?php get_header(); ?>

<?php get_template_part( 'loop-meta' ); ?>

<div class="<?php future_cs_layout( array( 'cs_layout_bone' => 'content_sidebar_wrapper_class' ) ); ?>">
  <div class="container">
    <div class="row">
  
      <div class="<?php future_cs_layout( array( 'cs_layout_bone' => 'content_column_class' ) ); ?>">
        <main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">   
      
          <article id="post-0" class="post-0 post type-post error404 not-found entry-wrapper" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
      
              <div class="entry-wrapper-inside">

                <div class="entry-content" itemprop="text">
            
                  <p><?php printf( __( "Just kidding! You tried going to %s, which doesn't exist, so that means I probably broke something.", 'future' ), '<code>' . esc_url( home_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?></p>
                  
                  <p><?php _e( "The following is a list of the latest posts from the blog. Maybe it will help you find what you're looking for.", 'future' ); ?></p>
            
                  <ul>
                    <?php wp_get_archives( array( 'limit' => 20, 'type' => 'postbypost' ) ); ?>
                  </ul>                   
            
                </div>

              </div>
          
          </article>
      
        </main>
      </div>
    
      <?php get_sidebar(); ?>

    </div>
  </div>
</div>
  
<?php get_footer(); ?>