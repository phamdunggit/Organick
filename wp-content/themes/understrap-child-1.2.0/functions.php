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
	wp_register_script('customjs', get_stylesheet_directory_uri() . '/js/custom-js.js', '', false, true);
	wp_enqueue_script('customjs');
	wp_register_script('jquery-owl', get_stylesheet_directory_uri() . '/blocks/offer_carousel/jquery-3.6.4.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-owl');
}
add_action('wp_enqueue_scripts', 'load_custom_js');

//add custom css file
function load_custom_stylesheet()
{
	wp_register_style('custom-style', get_stylesheet_directory_uri() . '/css/custom-style.css', 'all');
	wp_enqueue_style('custom-style');
	wp_register_style('newsletter-style', get_stylesheet_directory_uri() . '/css/newsletter.css', 'all');
	wp_enqueue_style('newsletter-style');
}
add_action('wp_enqueue_scripts', 'load_custom_stylesheet');
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title'    => 'Theme General Settings',
		'menu_title'    => 'Theme Settings',
		'menu_slug'     => 'theme-general-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Header Settings',
		'menu_title'    => 'Header',
		'parent_slug'   => 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Footer Settings',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Theme Newsletter Settings',
		'menu_title'    => 'Newsletter',
		'parent_slug'   => 'theme-general-settings',
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
				wp_enqueue_style('block-carousel', get_stylesheet_directory_uri() . '/blocks/css/banner_carousel.css');
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
				wp_enqueue_style('offer-carousel-block', get_stylesheet_directory_uri() . '/blocks/css/offer_carousel.css');
				wp_enqueue_style('owl-carousel-block', get_stylesheet_directory_uri() . '/blocks/offer_carousel/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css');
				wp_enqueue_style('owl-theme-carousel-block', get_stylesheet_directory_uri() . '/blocks/offer_carousel/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css');
				wp_enqueue_script('owl-js', get_stylesheet_directory_uri() . '/blocks/offer_carousel/OwlCarousel2-2.3.4/dist/owl.carousel.min.js', array('jquery'), '', true);
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
				wp_enqueue_style('custom-content', get_stylesheet_directory_uri() . '/blocks/css/custom_content.css');
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
				wp_enqueue_style('shop-css', get_stylesheet_directory_uri() . '/blocks/css/shop.css');
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
				wp_enqueue_style('testimonial-css', get_stylesheet_directory_uri() . '/blocks/css/testimonial.css', array(), rand(111, 9999), 'all');
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
				wp_enqueue_style('best_seller-css', get_stylesheet_directory_uri() . '/blocks/css/best_seller.css');
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
				wp_enqueue_style('who_we_are-css', get_stylesheet_directory_uri() . '/blocks/css/who_we_are.css');
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
				wp_enqueue_style('categories-css', get_stylesheet_directory_uri() . '/blocks/css/categories.css');
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
				wp_enqueue_style('news-css', get_stylesheet_directory_uri() . '/blocks/css/news.css');
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
				wp_enqueue_style('footer-css', get_stylesheet_directory_uri() . '/blocks/css/footer.css');
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
				wp_enqueue_style('why_choose_us-css', get_stylesheet_directory_uri() . '/blocks/css/why_choose_us.css');
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
				wp_enqueue_style('team-css', get_stylesheet_directory_uri() . '/blocks/css/team.css');
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
		'rewrite'            => array('slug' => 'news'),
		'capability_type'    => 'post',
		'has_archive'        => true,
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
		'rewrite'            => array('slug' => 'team'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title'),
		'menu_icon' => 'dashicons-admin-users',
		'show_in_rest' => true,
	);
	register_post_type('team', $args_team);
}
//register menu 
function register_menus() { 
    register_nav_menus(
        array(
            'top-menu' => 'Top Menu',
            'footer-menu' => 'Footer Menu',
        )
    ); 
}
add_action( 'init', 'register_menus' );
if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
    // File does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    // File exists... require it.
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}

