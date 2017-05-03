<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Rhythm
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


<!-- Comments -->
<div class="mb-80 mb-xs-40" id="comments">

	<h4 class="blog-page-title font-alt"><?php _e('Comments', 'rhythm'); ?><small class="number">(<?php echo get_comments_number(); ?>)</small></h4>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'rhythm' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'rhythm' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'rhythm' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
	<?php endif; // check for comment navigation ?>
	
	<ul class="media-list text comment-list clearlist">
		<?php
			wp_list_comments( array(
				'callback' => 'rhythm_comment', 
				'end-callback' => 'rhythm_close_comment',
				'style'      => 'ul',
				'short_ping' => true,
			) );
		?>
	</ul>
</div>
<!-- End Comments -->

<!-- Add Comment -->
<div class="mb-80 mb-xs-40">

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$args = array(
		'id_form' => 'commentform',
		'id_submit' => 'comment_submit',
		'title_reply' => __( 'Leave a Comment' ,'rhythm'),
		'title_reply_to' =>  __( 'Leave a Comment to %s'  ,'rhythm'),
		'cancel_reply_link' => __( 'Cancel Comment'  ,'rhythm'),
		'label_submit' => __( 'Submit Comment'  ,'rhythm'),
		'comment_field' => '
			<!-- Comment -->
			<div class="mb-30 mb-md-10">
				<textarea name="comment" id="text" ' . $aria_req . ' class="input-md form-control" rows="6" placeholder="'.esc_attr(__( 'Comment', 'rhythm' )).( $req ? ' *' : '' ).'" maxlength="400"></textarea>
			</div>',
		'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'rhythm' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  ,'rhythm'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '<div class="clearfix"></div>',
		'class_submit' => 'btn btn-mod btn-medium',
		'fields' => apply_filters( 'comment_form_default_fields',
			array(
				'author' => '
					<div class="row mb-20 mb-md-10">
						<div class="col-md-6 mb-md-10">
							<!-- Name -->
							<input type="text" name="author" id="name" ' . $aria_req . ' class="input-md form-control" placeholder="' . esc_attr(__( 'Name', 'rhythm' )) . ( $req ? ' *' : '' ) . '" maxlength="100">
						</div>',
					
				'email' => '
						<div class="col-md-6">
							<!-- Email -->
							<input type="email" name="email" id="email" class="input-md form-control" placeholder="' . esc_attr(__( 'Email', 'rhythm' )) . ( $req ? ' *' : '' ) . '" maxlength="100">
						</div>
					</div>',
				
				'url' => '
					<div class="mb-20 mb-md-10">
						<!-- Website -->
						<input type="text" name="url" id="website" class="input-md form-control" placeholder="'.esc_attr(__('Website', 'rhythm')).'" maxlength="100">
					</div>
				'
			)
		)
	);
	comment_form($args);
	?>
	<!-- End Form -->

</div>
<!-- End Add Comment -->