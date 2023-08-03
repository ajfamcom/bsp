<!-- custom-comment-form.php -->
<div id="respond" class="comment-respond">
    <h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( 'Leave a Comment', 'Leave a Comment to %s' ); ?></h3>
    <?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
        <p class="must-log-in"><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( get_permalink() ) ); ?></p>
    <?php else : ?>
        <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="commentform" class="comment-form">
            <?php if ( is_user_logged_in() ) : ?>
                <p class="logged-in-as"><?php printf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ); ?></p>
            <?php else : ?>
                <div class="mb-3"><label for="author" class="form-label"><?php _e( 'Name' ); ?></label> <span class="required">*</span>
                    <input type="text" name="author" id="author" value="<?php echo esc_attr( $comment_author ); ?>" class="form-control" <?php if ( $req ) echo 'aria-required="true"'; ?>>
                </div>
                <div class="mb-3"><label for="email" class="form-label"><?php _e( 'Email' ); ?></label> <span class="required">*</span>
                    <input type="email" name="email" id="email" value="<?php echo esc_attr( $comment_author_email ); ?>" class="form-control" <?php if ( $req ) echo 'aria-required="true"'; ?>>
                </div>
                <div class="mb-3"><label for="url" class="form-label"><?php _e( 'Website' ); ?></label>
                    <input type="url" name="url" id="url" value="<?php echo esc_attr( $comment_author_url ); ?>" class="form-control">
                </div>
            <?php endif; ?>
            <div class="mb-3"><label for="comment" class="form-label"><?php _e( 'Comment' ); ?></label>
                <textarea name="comment" id="comment" class="form-control" cols="45" rows="8" aria-required="true"></textarea>
            </div>
            <p class="form-submit">
                <input name="submit" type="submit" id="submit" class="btn btn-primary" value="<?php esc_attr_e( 'Post Comment' ); ?>">
                <?php comment_id_fields(); ?>
            </p>
            <?php do_action( 'comment_form', $post->ID ); ?>
        </form>
    <?php endif; ?>
</div>
