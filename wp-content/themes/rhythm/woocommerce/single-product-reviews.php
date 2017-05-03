<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>

<!-- Reviews List -->
<div class="mb-60 mb-xs-30">
	<ul class="media-list text comment-list clearlist">
		<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
	</ul>
</div>
<!-- End Reviews List -->

<!-- Add Review -->
<div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : __( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'id_form'				=> 'comment-form',
						'id_submit'				=> 'review-submit',
						'class_submit'		   => 'btn btn-mod btn-medium btn-round',
						'fields'               => array(
							'author' => '
								<div class="row mb-20 mb-md-10">
									<div class="col-md-6 mb-md-10">
										<input id="author" class="input-md form-control" name="author" placeholder="'.esc_attr__( 'Name', 'woocommerce' ).'*" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" data-error="'.esc_attr__('This Field is required','rhythm').'" required> <div class="help-block with-errors"></div>
									</div>',
							'email'  => '
									<div class="col-md-6">
										<input id="email" name="email" class="input-md form-control" placeholder="'.esc_attr__( 'Email', 'woocommerce' ).' *" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required> <div class="help-block with-errors"></div>
									</div>
								</div>',
						),
						'label_submit'  => __( 'Send Review', 'rhythm' ),
						'logged_in_as'  => '',
						'comment_field' => '',
						'format'		=> 'xhtml'
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '
							<div class="mb-20 mb-md-10">
								<!-- Rating -->
								<select class="input-md round form-control" name="rating" required>
									<option value="">' . __( 'Your Rating', 'woocommerce' ) .'</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select> <div class="help-block with-errors"></div>
							</div>';
					}

					$comment_form['comment_field'] .= '
						<!-- Comment -->
						<div class="mb-30 mb-md-10">
							<textarea name="comment" id="comment" class="input-md form-control" rows="6" placeholder="' . esc_attr__( 'Comment', 'rhythm' ) . '" maxlength="400" required></textarea> <div class="help-block with-errors"></div>
						</div>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					
					wp_enqueue_script( 'form-validator' );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>
</div>
<!-- End Add Review -->
