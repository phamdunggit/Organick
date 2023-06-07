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
function load_custom_js()
{
	wp_register_script('header-js', get_stylesheet_directory_uri() . '/assets/js/header.js', '', false, true);
	wp_enqueue_script('header-js');
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
	// wp_enqueue_script( 'wc-password-strength-meter' );
}
add_action('wp_enqueue_scripts', 'load_custom_js');

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
		'page_title'    => 'Theme Category Details Settings',
		'menu_title'    => 'Category Details',
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
			'name'              => 'custom_why_choose_us_layout',
			'title'             => __('Custom Why Choose Us'),
			'description'       => __('A Why Choose Us Layout.'),
			'render_template'   => 'blocks/why_choose_us/why_choose_us.php',
			'category'          => 'widgets',
			'icon'   => 'saved',
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
				wp_enqueue_script( 'video-js',  get_stylesheet_directory_uri() . '/blocks/video/video.js', array('jquery'), '', true);
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
	}
}
// Custom post type
add_action('init', 'custom_post_type_init');
function custom_post_type_init()
{
	//register news post type 
	$labels_news = array(
		'name'                  => _x('News', 'Post type general name', 'textdomain'),
		'singular_name'         => _x('News', 'Post type singular name', 'textdomain'),
		'menu_name'             => _x('News', 'Admin Menu text', 'textdomain'),
	);
	$args_news = array(
		'labels'             => $labels_news,
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
	$dom->loadHTML(utf8_decode($html));
	$xpath = new DOMXPath($dom);
	$form = $xpath->query('//form[contains(@class,"register")]');
	$form = $form->item(0);
	// echo '<div class="woocommerce">';
	echo '<div class="register-container">';
	echo $dom->saveXML($form);
	echo '</div>';
	// echo '</div>';
	// wp_enqueue_script('wc-password-strength-meter');
	return ob_get_clean();
}

add_shortcode('wc_login_form', 'separate_login_form');

function separate_login_form()
{
	if (is_user_logged_in()) return '<p>You are already logged in</p>';
	ob_start();
	do_action('woocommerce_before_customer_login_form');
	$html = wc_get_template_html('myaccount/form-login.php');
	$dom = new DOMDocument();
	$dom->encoding = 'utf-8';
	$dom->loadHTML(utf8_decode($html));
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

//Create shortcode for lost password form [lost_password_form]
function wc_custom_lost_password_form($atts)
{
	if (!empty($_COOKIE["csx-reset-link-set"]) && isset($_COOKIE["csx-reset-link-set"]) && $_COOKIE["csx-reset-link-set"] === "true") { // WPCS: input var ok, CSRF ok.
		return wc_get_template('myaccount/lost-password-confirmation.php');
	} elseif (!empty($_SESSION["csx-show-reset-form"]) && isset($_SESSION["csx-show-reset-form"]) && $_SESSION["csx-show-reset-form"] === "true") {
		$rp_id = $_SESSION["csx-id"];
		$rp_key = $_SESSION["csx-key"];
		if (isset($_COOKIE['wp-resetpass-' . COOKIEHASH]) && 0 < strpos($_COOKIE['wp-resetpass-' . COOKIEHASH], ':')) { // @codingStandardsIgnoreLine
			list($rp_id, $rp_key) = array_map('wc_clean', explode(':', wp_unslash($_COOKIE['wp-resetpass-' . COOKIEHASH]), 2)); // @codingStandardsIgnoreLine
			$userdata = get_userdata(absint($rp_id));
			$rp_login = $userdata ? $userdata->user_login : '';
			$user = WC_Shortcode_My_Account::check_password_reset_key($rp_key, $rp_login);

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
		}
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
		wp_safe_redirect(wc_get_page_permalink('myaccount'));
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


// // ajax autocomplete search 
// function get_ajax_posts()
// {
// 	// Query Arguments
// 	$search = isset($_GET['s']) ? $_GET['s']  : "";
// 	$final_arr = array();
// 	if (empty($search)) {
// 		echo json_encode($final_arr);
// 	} else {
// 		$params = array(
// 			'post_type'      => 'product',
// 			'limit' => 4,
// 			's' => $search,
// 			'orderby' => 'relevance',
// 			'order'          => 'desc',
// 			// 'paginate' => true,
// 			// 'page' => $paged
// 			// 'page'=> 2,
// 		);

// 		// The Query
// 		$products = wc_get_products($params); // changed to get_posts from wp_query, because `get_posts` returns an array

// 		foreach ($products as $item) {
// 			$temp_arr = array(
// 				'name' => $item->name,
// 				'slug' => get_post_permalink($item->id),
// 				'image_url' => get_the_post_thumbnail_url($item->id),
// 				'regular_price' => $item->regular_price,
// 				'sale_price' => $item->sale_price,
// 			);
// 			array_push($final_arr, $temp_arr);
// 		}
// 		echo json_encode($final_arr);
// 	}

// 	exit; // exit ajax call(or it will return useless information to the response)
// }	

// // Fire AJAX action for both logged in and non-logged in users
// add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
// add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');
