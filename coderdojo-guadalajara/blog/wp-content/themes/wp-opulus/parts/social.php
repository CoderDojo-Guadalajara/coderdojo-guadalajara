<ul id="social">
    <?php 
    if (nimbus_get_option('facebook_url') != "") { 
    ?>
        <li id="facebook_footer_button"><a target="_blank" href="<?php echo esc_url(nimbus_get_option('facebook_url')); ?>"></a></li>
    <?php 
    } 
    if (nimbus_get_option('linkedin_url') != "") { 
    ?>				
        <li id="linkedin_footer_button"><a target="_blank" href="<?php echo esc_url(nimbus_get_option('linkedin_url')); ?>"></a></li>
    <?php 
    } 
    if (nimbus_get_option('twitter_url') != "") { 
    ?>						
        <li id="twitter_footer_button"><a target="_blank" href="<?php echo esc_url(nimbus_get_option('twitter_url')); ?>"></a></li>
    <?php 
    } 
    if (nimbus_get_option('youtube_url') != "") { 
    ?>						
        <li id="youtube_footer_button"><a target="_blank" href="<?php echo esc_url(nimbus_get_option('youtube_url')); ?>"></a></li>
    <?php 
    } 
    if (nimbus_get_option('google_plus_url') != "") { 
    ?>						
        <li id="google_plus_footer_button"><a target="_blank" href="<?php echo esc_url(nimbus_get_option('google_plus_url')); ?>"></a></li>
    <?php 
    } 
    if (nimbus_get_option('nimbus_hide_rss_icon') == 0) {
        $nimbus_alt_rss_url = nimbus_get_option('nimbus_alt_rss_url');
        if (!empty($nimbus_alt_rss_url)) {
            echo"<li id='rss_footer_button'><a href='" . esc_url($nimbus_alt_rss_url) . "'></a></li>";
        } else {
        ?>
            <li id='rss_footer_button'><a target="_blank" href='<?php echo bloginfo('rss2_url'); ?>'></a></li>
        <?php
        }   
    }
    ?>	
</ul>