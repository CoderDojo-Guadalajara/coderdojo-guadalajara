<div id="comments" class="comments-area">
  
  <?php if ( post_password_required() ) : ?>
  <div class="no-password"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'future' ); ?></div>
  </div>
  <?php
  /**
    * Stop the rest of comments.php from being processed,
    * but don't kill the script entirely -- we still have
    * to fully load the template.
    */
	return;
	endif;
  ?>

  <?php if ( have_comments() ) : ?>
  
  <h3 class="comments-title">
    <?php
      printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'future' ),
        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
    ?>
  </h3>

  <ol class="comment-list">
    <?php wp_list_comments( apply_filters ( 'future_list_comments', array( 'callback' => 'future_comment' ) ) ); ?>
  </ol>

  <?php
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
  ?>
  
  <?php
  ob_start();
  previous_comments_link( __( '&larr; Older', 'future' ) );
  $previous_comments_link = ob_get_clean();
  
  ob_start();
  next_comments_link( __( 'Newer &rarr;', 'future' ) );
  $next_comments_link = ob_get_clean();
  
  $previous_comments_link = ( empty( $previous_comments_link ) )? '&nbsp;' : $previous_comments_link;	
  $next_comments_link = ( empty( $next_comments_link ) )? '&nbsp;' : $next_comments_link;	
  ?>
  
  <ul class="pager pagination-wrapper pagination-wrapper-comments">
    <li class="previous">
      <?php echo $previous_comments_link; ?>
    </li>
    <li class="next">
      <?php echo $next_comments_link; ?>
    </li>
  </ul>
  
  <?php endif; ?>

  <?php
  /**
   * If there are no comments and comments are closed, let's leave a little note, shall we?
	 * But we don't want the note on pages or post types that do not support comments.
	 */
  elseif ( ! comments_open() && !is_page() 
    && get_post_type() != 'future_portfolio' 
    && post_type_supports( get_post_type(), 'comments' ) ) :
  ?>
  <div class="no-comments"><?php _e( 'Comments are closed.', 'future' ); ?></div>
  <?php endif; ?>

  <?php
  /** Comment Form Args */
  $comments_args = array (

    'title_reply'       => __( 'Leave a Reply', 'future' ),
    'title_reply_to'    => __( 'Leave a Reply to %s', 'future' ),
    'cancel_reply_link' => __( 'Cancel Reply', 'future' ),
    'label_submit'      => __( 'Post Comment', 'future' ),

    'comment_field' => '
      <div class="form-group comment-form-comment">
        <label for="comment">'. __( 'Comment', 'future' ) .'</label>
        <textarea class="form-control" id="comment" name="comment" rows="8" aria-required="true"></textarea>
      </div>
    ',

  );
  /** Comment Form */
  comment_form( $comments_args );
  ?>

</div>