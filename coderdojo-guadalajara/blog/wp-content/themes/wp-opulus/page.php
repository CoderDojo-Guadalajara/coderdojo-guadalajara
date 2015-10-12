<?php
$top_scripts = nimbus_get_option('top_scripts_multi');
$bottom_scripts = nimbus_get_option('bottom_scripts_multi');
get_header();
?>

<div id="content_wrap">
    <div class="row">
        <div id="content" class="span12 center none">
            <div class="row">
                <div id="page_content_editable"  class="editable span8">
                    <?php 
                    if (have_posts()) { 
                        while (have_posts()) { 
                            the_post(); 
                            if (get_post_meta($post->ID, 'include_image_on_page', true) == "true") { 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('nimbus-post', array('class' => 'page_image'));
                                }
                            } 
                            if ($top_scripts['page'] = 1) {
                                nimbus_scripts_content_top();
                            }
                            the_content(); 
                            wp_link_pages(); 
                            if ($bottom_scripts['page'] = 1) {
                                nimbus_scripts_content_bottom();
                            }
                            comments_template(); 
                        }
                    } else {
                        get_template_part( 'parts/error', 'no_results'); 
                    } 
                    ?>
                </div>
                <?php 
                get_sidebar(); 
                ?>
            </div>
            <div class="clear"></div>			
        </div>
    </div>
</div>

<?php get_footer(); ?>