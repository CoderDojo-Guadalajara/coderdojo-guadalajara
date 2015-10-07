<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper entry-wrapper-page' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">  
    
  <div class="entry-wrapper-inside">  

    <header class="entry-header entry-header-page">

      <?php if ( future_post_edit_link() != '' ): ?>
      <div class="entry-meta entry-meta-page entry-meta-top">
      <?php echo future_post_edit_link(); ?>
      </div>
      <?php endif; ?>
      
      <h1 class="entry-title entry-title-page" itemprop="headline"><?php the_title(); ?></h1>

    </header>

    <div class="entry-content entry-content-page" itemprop="text">
      <?php the_content(); ?>
    </div>

    <footer class="entry-footer entry-footer-single">

      <?php echo future_link_pages(); ?>

    </footer>
  
  </div>  
  
</article>

<?php comments_template( '', true ); ?>