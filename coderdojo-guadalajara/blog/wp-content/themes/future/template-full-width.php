<?php 
/*
Template Name: Full Width Template
*/

/** Header */
get_header();
?>

<?php get_template_part( 'loop-meta' ); ?>

<div class="content-sidebar-wrapper template-full-width-wrapper">
  <div class="container">
    <div class="row">
  
      <div class="col-lg-12">
        <main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">   
      
          <?php if ( have_posts() ) : ?>
        
            <?php while ( have_posts() ) : the_post(); ?>
          
              <?php get_template_part( 'content', 'page' ); ?>
          
            <?php endwhile; ?>
        
          <?php else : ?>
                    
            <?php get_template_part( 'loop-error' ); ?>
        
          <?php endif; ?>
      
        </main>
      </div>    

    </div>
  </div>
</div>
  
<?php get_footer(); ?>