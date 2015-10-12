<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-wrapper entry-wrapper-single' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">  
    
  <div class="entry-wrapper-inside">  

	  <header class="entry-header entry-header-single">

      <div class="entry-meta entry-meta-single entry-meta-top">
        <?php echo future_post_format() . future_post_date() . future_post_author() . future_post_comments() . future_post_edit_link(); ?>
      </div>

      <h1 class="entry-title entry-title-single" itemprop="headline"><?php the_title(); ?></h1>

    </header>

    <div class="<?php future_entry_content_single_post_class(); ?>" itemprop="text">
      <?php the_content(); ?>
    </div>

    <footer class="entry-footer entry-footer-single">

      <?php echo future_link_pages(); ?>

      <div class="entry-meta entry-meta-single entry-meta-bottom">
	    <?php echo future_post_category() . future_post_tags(); ?>
      </div>

    </footer>
  
  </div>  
  
</article>

<?php future_author(); ?> 

<?php comments_template( '', true ); ?>