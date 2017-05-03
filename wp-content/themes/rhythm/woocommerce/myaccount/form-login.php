<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<!-- Nav Tabs -->
<div class="align-center mb-40 mb-xxs-30">
	<ul class="nav nav-tabs tpl-minimal-tabs">

		<li class="active">
			<a href="#mini-one" data-toggle="tab"><?php _e('Login', 'rhythm'); ?></a>
		</li>
		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
			<li>
				<a href="#mini-two" data-toggle="tab"><?php _e('Registration', 'rhythm'); ?></a>
			</li>
		<?php endif; ?>
	</ul>
</div>
<!-- End Nav Tabs -->


<!-- Tab panes -->
<div class="tab-content tpl-minimal-tabs-cont section-text">

	<div class="tab-pane fade in active" id="mini-one">

		<!-- Login Form -->                            
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				
				<form method="post" class="form contact-form login-form" id="contact_form" autocomplete="off">

					<?php do_action( 'woocommerce_login_form_start' ); ?>
					
					<div class="clearfix">

						<!-- Username -->
						<div class="form-group">	
							<input type="text" class="input-text input-md round form-control" placeholder="<?php esc_attr_e( 'Username or email address', 'woocommerce' ); ?>" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" pattern=".{3,100}" required/>
						</div>

						<!-- Password -->
						<div class="form-group">
							<input class="input-text input-md round form-control" type="password" placeholder="<?php esc_attr_e( 'Password', 'woocommerce' ); ?>" name="password" id="password" class="input-md round form-control" pattern=".{5,100}" required />
						</div>

					</div>
					
					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="clearfix">

						<div class="cf-left-col">

							<!-- Inform Tip -->                                        
							<div class="form-tip pt-20">
								<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
							</div>

						</div>

						<div class="cf-right-col">
							
							<?php wp_nonce_field( 'woocommerce-login' ); ?>
							
							<!-- Send Button -->
							<div class="align-right pt-10">
								<input type="submit" class="submit_btn btn btn-mod btn-medium btn-round" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
							</div>
							
							<label for="rememberme" class="align-right pt-10 inline form-tip">
								<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
							</label>
							
						</div>

					</div>
					
					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>
				
			</div>
		</div>
		<!-- End Login Form -->

	</div>

	<div class="tab-pane fade" id="mini-two">

		<!-- Registry Form -->                            
		<div class="row">
			<div class="col-md-4 col-md-offset-4">

				<form method="post" class="form contact-form" id="contact_form" autocomplete="off">
					<div class="clearfix">
						
						<?php do_action( 'woocommerce_register_form_start' ); ?>
					
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
						
							<!-- Username -->
							<div class="form-group">
								<input type="text" name="username" id="username" class="input-text input-md round form-control" <?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?> placeholder="><?php esc_attr_e( 'Username', 'woocommerce' ); ?> *" pattern=".{3,100}" required>
							</div>

						<?php endif; ?>
						
						<!-- Email -->
						<div class="form-group">
							<input type="text" name="email" id="email" class="input-md round form-control" placeholder="<?php esc_attr_e( 'Email address', 'woocommerce' ); ?> *" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" pattern=".{3,100}" required>
						</div>
						
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<!-- Password -->
							<div class="form-group">
								<input type="password" name="password" id="password" class="input-md round form-control" placeholder="<?php _e( 'Password', 'woocommerce' ); ?> *" pattern=".{5,100}" required>
							</div>

						<?php endif; ?>
							
						<!-- Spam Trap -->
						<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

						<?php do_action( 'woocommerce_register_form' ); ?>
						<?php do_action( 'register_form' ); ?>

					</div>
					
					<!-- Send Button -->
					<div class="pt-10">
						<?php wp_nonce_field( 'woocommerce-register' ); ?>
						<input type="submit" class="submit_btn btn btn-mod btn-medium btn-round btn-full" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
						
					</div>
					
					<?php do_action( 'woocommerce_register_form_end' ); ?>
					
				</form>

			</div>
		</div>
		<!-- End Registry Form -->		
	</div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
