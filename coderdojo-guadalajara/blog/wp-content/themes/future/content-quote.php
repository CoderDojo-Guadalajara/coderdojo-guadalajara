<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper entry-wrapper-quote' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">  
    
  <div class="entry-wrapper-inside">  

    <header class="entry-header entry-header-quote">       

      <div class="entry-meta entry-meta-quote entry-meta-top">
        <?php echo future_post_format() . future_post_date(); ?>
      </div>

      <h2 class="entry-title entry-title-quote" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

    </header>

    <div class="entry-content entry-content-quote" itemprop="text">
      <?php the_content(); ?>
    </div>

    <footer class="entry-footer entry-footer-quote">

      <?php echo future_link_pages(); ?>

    </footer>
  
  </div>  
  
</article>