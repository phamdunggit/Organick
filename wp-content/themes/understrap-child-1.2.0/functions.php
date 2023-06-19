<?php

/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts()
{
	wp_dequeue_style('understrap-styles');
	wp_deregister_style('understrap-styles');

	wp_dequeue_script('understrap-scripts');
	wp_deregister_script('understrap-scripts');
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles()
{

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get('Version'));
	wp_enqueue_script('jquery');
	wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get('Version'), true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain()
{
	load_child_theme_textdomain('understrap-child', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'add_child_theme_textdomain');



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version()
{
	return 'bootstrap5';
}
add_filter('theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20);



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js()
{
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array('customize-preview'),
		'20130508',
		true
	);
}
add_action('customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js');

//add custom js file


//add custom css file
function load_custom_stylesheet()
{
	wp_register_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/theme.css', 'all');
	wp_enqueue_style('theme-style');
	wp_enqueue_style('owl-carousel-block', get_stylesheet_directory_uri() . '/assets/lib/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css');
	wp_enqueue_style('owl-carousel-block');
	wp_enqueue_style('owl-theme-carousel-block', get_stylesheet_directory_uri() . '/assets/lib/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css');
	wp_enqueue_style('owl-theme-carousel-block');
}
add_action('wp_enqueue_scripts', 'load_custom_stylesheet');
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'    => 'Theme Newsletter Settings',
		'menu_title'    => 'Newsletter',
		'redirect'    => false,
	));
	acf_add_options_page(array(
		'page_title'    => 'Theme Single Shop Settings',
		'menu_title'    => 'Single Shop ',
		'redirect'    => false,
	));
	acf_add_options_page(array(
		'page_title'    => 'Theme 404 Settings',
		'menu_title'    => '404 Page',
		'redirect'    => false,
	));
}
// Register block 
add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init()
{

	// Check function exists.
	if (function_exists('acf_register_block_type')) {

		// Register a testimonial block.
		acf_register_block_type(array(
			'name'              => 'banner_carousel',
			'title'             => __('Banner Carousel'),
			'description'       => __('A custom banner carousel block.'),
			'render_template'   => 'blocks/banner_carousel/banner_carousel.php',
			'category'          => 'widgets',
			'icon'   => 'images-alt2',
			'enqueue_assets' => function () {
				wp_enqueue_style('block-carousel', get_stylesheet_directory_uri() . '/blocks/banner_carousel/banner_carousel.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'offer_carousel',
			'title'             => __('Offer Carousel'),
			'description'       => __('A custom offer carousel block.'),
			'render_template'   => 'blocks/offer_carousel/offer_carousel.php',
			'category'          => 'widgets',
			'icon'   => 'tickets',
			'enqueue_assets' => function () {
				wp_enqueue_style('offer-carousel-block', get_stylesheet_directory_uri() . '/blocks/offer_carousel/offer_carousel.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_content',
			'title'             => __('Custom Content'),
			'description'       => __('A custom content block.'),
			'render_template'   => 'blocks/custom_content/custom_content.php',
			'category'          => 'widgets',
			'icon'   => 'align-left',
			'enqueue_assets' => function () {
				wp_enqueue_style('custom-content', get_stylesheet_directory_uri() . '/blocks/custom_content/custom_content.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_shop',
			'title'             => __('Custom Shop'),
			'description'       => __('A custom shop block.'),
			'render_template'   => 'blocks/shop/shop.php',
			'category'          => 'widgets',
			'icon'   => 'cart',
			'enqueue_assets' => function () {
				wp_enqueue_style('shop-css', get_stylesheet_directory_uri() . '/blocks/shop/shop.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_testimonial',
			'title'             => __('Custom Testimonial'),
			'description'       => __('A custom testimonial block.'),
			'render_template'   => 'blocks/testimonial/testimonial.php',
			'category'          => 'widgets',
			'icon'   => 'welcome-comments',
			'enqueue_assets' => function () {
				wp_enqueue_style('testimonial-css', get_stylesheet_directory_uri() . '/blocks/testimonial/testimonial.css', array(), rand(111, 9999), 'all');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_best_seller_product',
			'title'             => __('Custom Best Seller Product'),
			'description'       => __('A Best Seller Product.'),
			'render_template'   => 'blocks/best_seller/best_seller.php',
			'category'          => 'widgets',
			'icon'   => 'awards',
			'enqueue_assets' => function () {
				wp_enqueue_style('best_seller-css', get_stylesheet_directory_uri() . '/blocks/best_seller/best_seller.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_who_we_are_layout',
			'title'             => __('Custom Who We Are'),
			'description'       => __('A Who We Are Layout.'),
			'render_template'   => 'blocks/who_we_are/who_we_are.php',
			'category'          => 'widgets',
			'icon'   => 'admin-users',
			'enqueue_assets' => function () {

				wp_enqueue_style('who_we_are-css', get_stylesheet_directory_uri() . '/blocks/who_we_are/who_we_are.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_categories_layout',
			'title'             => __('Custom Categories'),
			'description'       => __('A Categories Layout.'),
			'render_template'   => 'blocks/categories/categories.php',
			'category'          => 'widgets',
			'icon'   => 'category',
			'enqueue_assets' => function () {
				wp_enqueue_style('categories-css', get_stylesheet_directory_uri() . '/blocks/categories/categories.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_categories2_layout',
			'title'             => __('Custom Categories 2'),
			'description'       => __('A Categories 2 Layout.'),
			'render_template'   => 'blocks/categories_2/categories_2.php',
			'category'          => 'widgets',
			'icon'   => 'category',
			'enqueue_assets' => function () {
				wp_enqueue_style('categories-2-css', get_stylesheet_directory_uri() . '/blocks/categories_2/categories_2.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_news_layout',
			'title'             => __('Custom News'),
			'description'       => __('A News Layout.'),
			'render_template'   => 'blocks/news/news.php',
			'category'          => 'widgets',
			'icon'   => 'media-document',
			'enqueue_assets' => function () {
				wp_enqueue_style('news-css', get_stylesheet_directory_uri() . '/blocks/news/news.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_footer_layout',
			'title'             => __('Custom Footer'),
			'description'       => __('A Footer Layout.'),
			'render_template'   => 'blocks/footer/footer.php',
			'category'          => 'layout',
			'icon'   => 'slides',
			'enqueue_assets' => function () {
				wp_enqueue_style('footer-css', get_stylesheet_directory_uri() . '/blocks/footer/footer.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_banner_layout',
			'title'             => __('Custom Banner'),
			'description'       => __('A banner Layout.'),
			'render_template'   => 'blocks/banner/banner.php',
			'category'          => 'widgets',
			'icon'   => 'embed-photo',
			'enqueue_assets' => function () {
				wp_enqueue_style('why_choose_us-css', get_stylesheet_directory_uri() . '/blocks/why_choose_us/why_choose_us.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_team_layout',
			'title'             => __('Custom Team'),
			'description'       => __('A Team Layout.'),
			'render_template'   => 'blocks/team/team.php',
			'category'          => 'widgets',
			'icon'   => 'admin-users',
			'enqueue_assets' => function () {
				wp_enqueue_style('team-css', get_stylesheet_directory_uri() . '/blocks/team/team.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_services_layout',
			'title'             => __('Custom Services'),
			'description'       => __('A Services Layout.'),
			'render_template'   => 'blocks/services/services.php',
			'category'          => 'widgets',
			'icon'   => 'yes',
			'enqueue_assets' => function () {
				wp_enqueue_style('services-css', get_stylesheet_directory_uri() . '/blocks/services/services.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_video_layout',
			'title'             => __('Custom Video'),
			'description'       => __('A Video Layout.'),
			'render_template'   => 'blocks/video/video.php',
			'category'          => 'widgets',
			'icon'   => 'format-video',
			'enqueue_assets' => function () {
				wp_enqueue_style('video-css', get_stylesheet_directory_uri() . '/blocks/video/video.css');
				wp_enqueue_script('video-js',  get_stylesheet_directory_uri() . '/blocks/video/video.js', array('jquery'), '', true);
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_point_layout',
			'title'             => __('Custom Point'),
			'description'       => __('A Point Layout.'),
			'render_template'   => 'blocks/point/point.php',
			'category'          => 'design',
			'icon'   => 'yes',
			'enqueue_assets' => function () {
				wp_enqueue_style('point-css', get_stylesheet_directory_uri() . '/blocks/point/point.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_location_layout',
			'title'             => __('Custom Location'),
			'description'       => __('A Location Layout.'),
			'render_template'   => 'blocks/location/location.php',
			'category'          => 'widgets',
			'icon'   => 'location',
			'enqueue_assets' => function () {
				wp_enqueue_style('location-css', get_stylesheet_directory_uri() . '/blocks/location/location.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_contact_layout',
			'title'             => __('Custom Contact'),
			'description'       => __('A Contact Layout.'),
			'render_template'   => 'blocks/contact/contact.php',
			'category'          => 'widgets',
			'icon'   => 'phone',
			'enqueue_assets' => function () {
				wp_enqueue_style('contact-css', get_stylesheet_directory_uri() . '/blocks/contact/contact.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_contact_form_layout',
			'title'             => __('Custom Contact Form'),
			'description'       => __('A Contact Form Layout.'),
			'render_template'   => 'blocks/contact_form/contact_form.php',
			'category'          => 'widgets',
			'icon'   => 'email',
			'enqueue_assets' => function () {
				wp_enqueue_style('contact_form-css', get_stylesheet_directory_uri() . '/blocks/contact_form/contact_form.css');
			},
		));
		acf_register_block_type(array(
			'name'              => 'custom_quote_layout',
			'title'             => __('Custom Quote'),
			'description'       => __('A Quote Layout.'),
			'render_template'   => 'blocks/quote/quote.php',
			'category'          => 'formatting',
			'icon'   => 'format-quote',
			'enqueue_assets' => function () {
				wp_enqueue_style('quote-css', get_stylesheet_directory_uri() . '/blocks/quote/quote.css');
			},
		));
	}
}
// Custom post type
add_action('init', 'custom_post_type_init');
function custom_post_type_init()
{
	$labels = array(
		'name'                  => _x('News', 'Post type general name', 'textdomain'),
		'singular_name'         => _x('News', 'Post type singular name', 'textdomain'),
		'menu_name'             => _x('News', 'Admin Menu text', 'textdomain'),
	);
	$args_news = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
		'menu_icon' => 'dashicons-media-document',
		'show_in_rest' => true,
	);
	register_post_type('news', $args_news);

	//register teams post type 
	$labels_team = array(
		'name'                  => _x('Team', 'Post type general name', 'textdomain'),
		'singular_name'         => _x('Team', 'Post type singular name', 'textdomain'),
		'menu_name'             => _x('Team', 'Admin Menu text', 'textdomain'),
	);
	$args_team = array(
		'labels'             => $labels_team,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title'),
		'menu_icon' => 'dashicons-admin-users',
		'show_in_rest' => true,
	);
	register_post_type('team', $args_team);
}
//register menu 
function register_menus()
{
	register_nav_menus(
		array(
			'top-menu' => 'Top Menu',
			'footer-menu' => 'Footer Menu',
		)
	);
}
add_action('init', 'register_menus');
if (!file_exists(get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php')) {
	// File does not exist... return an error.
	return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
	// File exists... require it.
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}


function custom_woocommerce_process_registration_errors($validation_errors, $username, $password, $email)
{

	if (strpos($_POST['password'], " ")) {
		$validation_errors->add('space_passwword_input', __('Incorrect password, please try again !', 'woocommerce'));
	}
	if (strcmp($_POST['password'], $_POST['password2'])) {
		$validation_errors->add('confirm-password', __('Passwords do not match.', 'woocommerce'));
	}
	if (!isset($_POST['email']) || $_POST['email'] == '') {
		$validation_errors->add('email', __('Please enter email address.', 'woocommerce'));
	}
	if (!isset($_POST['password']) || $_POST['password'] == '') {
		$validation_errors->add('password', __('Please enter passwors.', 'woocommerce'));
	}


	return $validation_errors;
}

add_action( 'woocommerce_authenticate', 'custom_login_error_message', 1 );
function custom_login_error_message( $user ) {
    if ( is_wp_error( $user ) && ! empty( $user->get_error_data() ) && strpos( $user->get_error_data(), '@' ) !== false ) {
        wc_add_notice( __( 'Email chưa đăng ký hoặc nhập sai. Vui lòng nhập lại!' ), 'error' );
    }
}


add_filter('woocommerce_process_registration_errors', 'custom_woocommerce_process_registration_errors', 10, 4);
function woocommerce_register_form_password_repeat()
{
?>
	<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide input-field">
		<label for="reg_password2"><?php _e('Confirm password', 'woocommerce'); ?> <span class="required">*</span></label>
		<input type="password" class="input-text input-trim" name="password2" id="reg_password2" value="" maxlength="30" />
	</div>
<?php
}
add_action('woocommerce_register_form', 'woocommerce_register_form_password_repeat');


add_shortcode('wc_reg_form', 'separate_registration_form');

function separate_registration_form()
{
	if (is_user_logged_in()) return '<p>You are already registered</p>';
	ob_start();
	do_action('woocommerce_before_customer_login_form');
	$html = wc_get_template_html('myaccount/form-login.php');
	$dom = new DOMDocument();
	$dom->encoding = 'utf-8';
	@$dom->loadHTML(utf8_decode($html));
	$xpath = new DOMXPath($dom);
	$form = $xpath->query('//form[contains(@class,"register")]');
	$form = $form->item(0);
	// echo '<div class="woocommerce">';
	echo '<div class="register-container">';
	echo $dom->saveXML($form);
	echo '</div>';
	// echo '</div>';
	return ob_get_clean();
}

add_shortcode('wc_login_form', 'separate_login_form');

function my_custom_login_redirect($redirect_to, $user)
{
	// Đặt lại URL đích của trang tùy chỉnh ở đây
	$redirect_to = home_url();

	return $redirect_to;
}
add_filter('woocommerce_login_redirect', 'my_custom_login_redirect', 10, 2);

function separate_login_form()
{
	if (is_user_logged_in()) return '<p>You are already logged in</p>';
	ob_start();
	do_action('woocommerce_before_customer_login_form');
	$html = wc_get_template_html('myaccount/form-login.php');
	$dom = new DOMDocument();
	$dom->encoding = 'utf-8';
	@$dom->loadHTML(utf8_decode($html));
	$xpath = new DOMXPath($dom);
	$form = $xpath->query('//form[contains(@class,"login")]');
	$form = $form->item(0);
	echo '<div class="login-container">';
	//    woocommerce_login_form( array( 'redirect' => wc_get_page_permalink( 'myaccount' ) ) );
	echo $dom->saveXML($form);
	echo '</div>';
	return ob_get_clean();
}
add_shortcode('wc_lost_passwword_form', 'separate_lost_passwword_form');

// function separate_lost_passwword_form()
// {
// 	if (is_user_logged_in()) return '<p>You are already logged in</p>';
// 	ob_start();
// 	do_action('woocommerce_before_lost_password_form');
// 	$html = wc_get_template_html('myaccount/form-lost-password.php');
// 	$dom = new DOMDocument();
// 	$dom->encoding = 'utf-8';
// 	$dom->loadHTML(utf8_decode($html));
// 	$xpath = new DOMXPath($dom);
// 	$form = $xpath->query('//form[contains(@class,"lost_reset_password")]');
// 	$form = $form->item(0);
// 	echo '<div class="lost-reset-password-container">';
// 	//    woocommerce_login_form( array( 'redirect' => wc_get_page_permalink( 'myaccount' ) ) );
// 	echo $dom->saveXML($form);
// 	echo '</div>';
// 	do_action( 'woocommerce_after_reset_password_form' );
// 	return ob_get_clean();
// }
function wdm_lostpassword_url()
{
	return site_url('/lost-password');
}
add_filter('lostpassword_url', 'wdm_lostpassword_url', 10, 0);

add_action('template_redirect', 'redirect_login_registration_if_logged_in');
function woocommerce_new_pass_redirect($user)
{
	wc_add_notice(__('Your password has been changed successfully! Please login to continue.', 'woocommerce'), 'success');
	wp_redirect(home_url() . "/login");
	exit;
}
add_action('woocommerce_customer_reset_password', 'woocommerce_new_pass_redirect');

function csx_process_query()
{
	if (isset($_GET['reset-link-sent']) && $_GET['reset-link-sent'] === "true") {
		setcookie('csx-reset-link-set', "true", time() + (600 * 1), "/"); //Allow to submit email for reset after 10 minutes only.
		unset($_SESSION["csx-show-reset-form"]);
	}

	if (
		isset($_GET['show-reset-form']) && $_GET['show-reset-form'] === "true" ||
		isset($_GET['key']) && isset($_GET['id'])
	) {
		$_SESSION["csx-show-reset-form"] = "true";
		setcookie('csx-reset-link-set', "", time() - 600, "/");
	}

	//Set session and cookie if key and id are existed
	if (isset($_GET['key']) && isset($_GET['id'])) {
		$_SESSION["csx-key"] = $_GET['key'];
		$_SESSION["csx-id"] = $_GET['id'];
		$value = sprintf("%s:%s", wp_unslash($_GET['id']), wp_unslash($_GET['key']));
		// var_dump($value);
		WC_Shortcode_My_Account::set_reset_password_cookie($value);
	}

	//Unset session and cookie after successfully changed the password.
	if (isset($_GET['new-password-created']) && $_GET['new-password-created'] === "true") {
		setcookie('wp-resetpass-' . COOKIEHASH, "", time() - 600);
		unset($_SESSION["csx-show-reset-form"]);
		unset($_SESSION["csx-reset-link-set"]);
		unset($_SESSION["csx-id"]);
		unset($_SESSION["csx-key"]);
	}
}
add_action('init', 'csx_process_query');


//Create shortcode for lost password form [lost_password_form]
function wc_custom_lost_password_form($atts)
{
	// var_dump($_COOKIE['wp-resetpass-' . COOKIEHASH]);
	// var_dump($_SESSION["csx-id"]);
	// var_dump($_COOKIE['wp-resetpass-' . COOKIEHASH]);
	if (!empty($_COOKIE["csx-reset-link-set"]) && isset($_COOKIE["csx-reset-link-set"]) && $_COOKIE["csx-reset-link-set"] === "true") { // WPCS: input var ok, CSRF ok.
		return wc_get_template('myaccount/lost-password-confirmation.php');
	} 
	elseif (!empty($_SESSION["csx-show-reset-form"]) && isset($_SESSION["csx-show-reset-form"]) && $_SESSION["csx-show-reset-form"] === "true") {
		$rp_id = $_SESSION["csx-id"];
		$rp_key = $_SESSION["csx-key"];

		// var_dump(strpos($_COOKIE['wp-resetpass-' . COOKIEHASH], ':'));
		// if (isset($_COOKIE['wp-resetpass-' . COOKIEHASH]) && 0 < strpos($_COOKIE['wp-resetpass-' . COOKIEHASH], ':')) { // @codingStandardsIgnoreLine
		// 	list($rp_id, $rp_key) = array_map('wc_clean', explode(':', wp_unslash($_COOKIE['wp-resetpass-' . COOKIEHASH]), 2)); // @codingStandardsIgnoreLine
			$userdata = get_userdata(absint($rp_id));
			// var_dump(array_map('wc_clean', explode(':', wp_unslash($_COOKIE['wp-resetpass-' . COOKIEHASH]), 2)));
			$rp_login = $userdata ? $userdata->user_login : '';
			$user = WC_Shortcode_My_Account::check_password_reset_key($rp_key, $rp_login);
			// var_dump($_COOKIE['wp-resetpass-' . COOKIEHASH]);
			// Reset key / login is correct, display reset password form with hidden key / login values.
			if (is_object($user)) {
				echo '<div class="woocomerce">';
				return wc_get_template(
					'myaccount/form-reset-password.php',
					array(
						'key' => $rp_key,
						'login' => $rp_login,
					)
				);
				echo '</div>';
			}
		// }
	}

	// Show lost password form by default.
	return wc_get_template(
		'myaccount/form-lost-password.php',
		array(
			'form' => 'lost_password',
		)

	);
}
add_shortcode('lost_password_form', 'wc_custom_lost_password_form');

//Handling query


//Redirect to custom lost password on request
// function csx_redirections() {
//     if ( isset( $_GET[ 'reset-link-sent' ] ) || isset( $_GET[ 'show-reset-form' ] ) ||
//         isset( $_GET[ 'key' ] ) && isset( $_GET[ 'id' ] ) ) {
//         wp_redirect( home_url() . '/lost-password' );
//         exit;
//     }
// }
// add_action( 'template_redirect', 'csx_redirections' );




function redirect_login_registration_if_logged_in()
{
	if (is_page() && is_user_logged_in() && (has_shortcode(get_the_content(), 'wc_login_form') || has_shortcode(get_the_content(), 'wc_reg_form') || has_shortcode(get_the_content(), 'lost_password_form'))) {
		wp_safe_redirect("/");
		exit;
	}
}

add_action('template_redirect', 'redirect_login_registration_if_not_logged_in');
function redirect_login_registration_if_not_logged_in()
{
	if (is_page() && !is_user_logged_in() && (has_shortcode(get_the_content(), 'woocommerce_my_account'))) {
		wp_safe_redirect("/login");
		exit;
	}
}

add_filter('query_vars', 'add_query_vars_filter');
function add_query_vars_filter($vars)
{
	$vars[] = "search"; // replace this with your query string parameter name(s)
	$vars[] = "posttype";
	$vars[] = "pg";
	return $vars;
}


// ajax autocomplete search 
function get_ajax_posts()
{
	// Query Arguments
	$search = isset($_GET['s']) ? $_GET['s']  : "";
	$final_arr = array();
	if (strlen($search) == 0) {
		echo json_encode($final_arr);
	} else {
		$params = array(
			'post_type'      => 'product',
			'limit' => 4,
			's' => $search,
			// 'orderby' => 'relevance',
			'order'          => 'desc',
			'meta_query' => array(
				array(
					'key' => '_product_name',
					'value' => $search,
					'compare' => 'LIKE'
				)
			)
			// 'paginate' => true,
			// 'page' => $paged
			// 'page'=> 2,
		);

		// The Query
		$products = wc_get_products($params); // changed to get_posts from wp_query, because `get_posts` returns an array

		foreach ($products as $item) {
			
			$temp_arr = array(
				'name' => $item->name,
				'slug' => get_post_permalink($item->id),
				'image_url' => get_the_post_thumbnail_url($item->id),
				'regular_price' => $item->regular_price,
				'sale_price' => $item->sale_price,
				'currency_symbol' => get_woocommerce_currency_symbol()
			);
			array_push($final_arr, $temp_arr);
		}
		header('Content-Type: application/json');
		echo json_encode($final_arr);
	}

	exit; // exit ajax call(or it will return useless information to the response)
}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');
//get link ajax= echo admin_url('admin-ajax.php?action=get_ajax_posts') 


add_action('template_redirect', 'correct_redirect');
function correct_redirect()
{
	/* we need only thank you page */
	if (is_wc_endpoint_url('order-received') && isset($_GET['key'])) {
		$order_id = wc_get_order_id_by_order_key($_GET['key']);
		$order = wc_get_order($order_id);
		$user_id = $order->get_user_id();
		$current_user_id = get_current_user_id();
		if ($current_user_id != $user_id) {
			wp_redirect('/');
			exit;
		}
	}
}
// add_filter( 'woocommerce_available_payment_gateways', 'payment_gateway_disable_method' );
// function payment_gateway_disable_method ($available_gateways){
// 	if(isset($_POST['payment_method']) && $_POST['payment_method']=="ppcp"){
// 		unset( $available_gateways['cod'] );
// 	} elseif (isset($_POST['payment_method']) && $_POST['payment_method']=="cod"){
// 		unset( $available_gateways['ppcp'] );
// 	}

// 	return $available_gateways;
// }

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
{
	$fields['billing']['billing_address_2'] = array(
		'label_class'  => '',
		'label' => 'Apartment, suite, unit, etc. (optional)'
	);
	return $fields;
}
function load_custom_js()
{
	wp_register_script('header-js', get_stylesheet_directory_uri() . '/assets/js/header.js', '', false, true);
	wp_enqueue_script('header-js');
	wp_register_script('search-form-js', get_stylesheet_directory_uri() . '/assets/js/search-form.js', '', false, true);
	wp_enqueue_script('search-form-js');
	wp_register_script('login-register-js', get_stylesheet_directory_uri() . '/assets/js/login-register.js', '', false, true);
	wp_enqueue_script('login-register-js');
	wp_register_script('single-product-js', get_stylesheet_directory_uri() . '/assets/js/single-product.js', '', false, true);
	wp_enqueue_script('single-product-js');
	wp_register_script('jquery-owl', get_stylesheet_directory_uri() . '/assets/lib/jquery-3.6.4.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-owl');
	wp_register_script('jquery-validate', get_stylesheet_directory_uri() . '/assets/lib/jquery.validate.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-validate');
	wp_enqueue_script('owl-js', get_stylesheet_directory_uri() . '/assets/lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js', array('jquery'), '', true);
	wp_enqueue_script('owl-js');
	wp_enqueue_script('blockUI', get_stylesheet_directory_uri() . '/assets/js/jquery.blockUI.js', '', false, true);
	wp_enqueue_script('blockUI');
	// wp_enqueue_script( 'wc-password-strength-meter' );
}
add_action('wp_enqueue_scripts', 'load_custom_js');


function remove_jquery_on_checkout_and_cart_page()
{
	if (is_page('cart') || is_page('checkout')) {
		wp_dequeue_script('jquery-owl');
	}
}
add_action('wp_enqueue_scripts', 'remove_jquery_on_checkout_and_cart_page', 9999);



function my_custom_session_cookie_expire()
{

	return 60 * 60 * 24 * 14; // 14 ngày tính bằng giây
}
add_filter('wc_session_cookie_expiration', 'my_custom_session_cookie_expire');

// add_filter( 'pre_user_login' , 'wpso_same_user_email' );

// function wpso_same_user_email( $user_login ) {

//     if( isset($_POST['billing_email'] ) ) {
//         $user_login = $_POST['billing_email'];
//     }
//     if( isset($_POST['email'] ) ) {
//         $user_login = $_POST['email'];
//     }
//     return $user_login;
// }
function __search_by_title_only( $search, $wp_query )
    {
        global $wpdb;
        if ( empty( $search ) )
            return $search; // skip processing - no search term in query
        $q = $wp_query->query_vars;
        $n = ! empty( $q['exact'] ) ? '' : '%';
        $search =
        $searchand = '';
        foreach ( (array) $q['search_terms'] as $term ) {
            $term = esc_sql( like_escape( $term ) );
            $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
            $searchand = ' AND ';
         }
         if ( ! empty( $search ) ) {
             $search = " AND ({$search}) ";
             if ( ! is_user_logged_in() )
                 $search .= " AND ($wpdb->posts.post_password = '') ";
              }
          return $search;
      }
    add_filter( 'posts_search', '__search_by_title_only', 500, 2 );

