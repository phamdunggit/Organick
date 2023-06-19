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
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>

<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

	<div class="u-columns col2-set" id="customer_login">

		<div class="u-column1 col-1">

		<?php endif; ?>

		<h1><?php esc_html_e('Login', 'woocommerce'); ?></h1>

		<form class="woocommerce-form woocommerce-form-login login-form login" id="login" method="post">
			<h1>Login</h1>
			<?php do_action('woocommerce_login_form_start'); ?>

			<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-field">
				<label for="username"><?php esc_html_e('Email', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" maxlength="50" class="woocommerce-Input woocommerce-Input--text input-text input-trim" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																															?>
			</div>
			<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-field">
				<label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
				<div class="password-input-wrapper">
				<input class="woocommerce-Input woocommerce-Input--text input-text input-trim" type="password" maxlength="30" name="password" id="password" autocomplete="current-password" />
				<span id="show-hide-password">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"/></svg>
				</span>
				</div>
				
			</div>
			
			<?php do_action('woocommerce_login_form'); ?>

			<div class="form-row remember-me-and-forgot-container">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme remember">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
				</label>
				<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
				<div class="woocommerce-LostPassword lost_password">
					<a href="/lost-password"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
				</div>
			</div>
			<div class="form-row login-btn-container">
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit login-btn<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
			</div>
			<div class="alternative-register">
				<p>New to Organick? <a href="/register">Register Now</a></p>
			</div>
			<?php do_action('woocommerce_login_form_end'); ?>

		</form>

		<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

		</div>

		<div class="u-column2 col-2">




			<form method="post" class="woocommerce-form woocommerce-form-register register-form register" id="register" <?php do_action('woocommerce_register_form_tag'); ?>>
				<h1>Register</h1>
				<?php do_action('woocommerce_register_form_start'); ?>

				<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

					<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-field">
						<label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-trim" name="username" maxlength="30" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																			?>
					</div>

				<?php endif; ?>

				<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-field">
					<label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text input-trim" name="email" id="reg_email" maxlength="256" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																														?>
				</div>

				<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

					<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-field">
						<label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text input-trim" maxlength="30" name="password" id="reg_password" autocomplete="new-password" />
					</div>
				<?php else : ?>

					<p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

				<?php endif; ?>

				<?php do_action('woocommerce_register_form'); ?>

				<div class="woocommerce-form-row form-row register-btn-container">
					<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button register-btn<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
				</div>
				<div class="alternative-login">
					<p>Have an account? <a href="/login">Login Now</a></p>
				</div>
				<?php do_action('woocommerce_register_form_end'); ?>

			</form>

		</div>

	</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>



