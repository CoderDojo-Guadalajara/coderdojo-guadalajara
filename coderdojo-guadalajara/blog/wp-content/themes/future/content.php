<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">  
    
  <div class="entry-wrapper-inside">  

    <?php future_featured_image(); ?>

    <header class="entry-header">       

      <div class="entry-meta entry-meta-top">
        <?php echo future_post_sticky() . future_post_date(); ?>
      </div>

      <h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

    </header>

    <div class="entry-content" itemprop="text">
      <?php future_post_style(); ?>
    </div>

    <footer class="entry-footer">

      <?php echo future_link_pages(); ?>

    </footer>
  
  </div>  
  
</article>