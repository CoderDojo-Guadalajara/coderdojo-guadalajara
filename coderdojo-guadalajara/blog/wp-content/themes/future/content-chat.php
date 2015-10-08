<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper entry-wrapper-chat' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">  
    
  <div class="entry-wrapper-inside">  

    <header class="entry-header entry-header-chat">       

      <div class="entry-meta entry-meta-chat entry-meta-top">
        <?php echo future_post_format() . future_post_date(); ?>
      </div>

      <h2 class="entry-title entry-title-chat" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( 'Permalink to %s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

    </header>

    <div class="entry-content entry-content-chat" itemprop="text">
      <?php the_content(); ?>
    </div>

    <footer class="entry-footer entry-footer-chat">

      <?php echo future_link_pages(); ?>

    </footer>
  
  </div>  
  
</article>