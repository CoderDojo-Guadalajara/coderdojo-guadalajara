<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper entry-wrapper-attachment' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">  
    
  <div class="entry-wrapper-inside">  

    <header class="entry-header entry-header-attachment">

      <div class="entry-meta entry-meta-attachment entry-meta-top">
        <?php echo future_post_format() . future_post_date() . future_post_author() . future_post_comments() . future_post_edit_link(); ?>
      </div>

      <h1 class="entry-title entry-title-attachment" itemprop="headline"><?php the_title(); ?></h1>

    </header>

    <div class="entry-content entry-content-attachment" itemprop="text">
      <p><a href="<?php echo wp_get_attachment_url( $post->ID ); ?>" rel="prettyPhoto"><?php echo wp_get_attachment_image( $post->ID, 'large', false, array( 'class' => 'attachment-large img-responsive' )  ); ?></a></p>
      <?php the_excerpt(); ?>
    </div>

    <footer class="entry-footer entry-footer-attachment">

      <?php future_loop_nav_singular(); ?>

    </footer>
  
  </div>  
  
</article>

<?php future_loop_nav_singular_attachment(); ?>

<?php comments_template( '', true ); ?>