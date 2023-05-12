<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$bootstrap_version = get_theme_mod('understrap_bootstrap_version', 'bootstrap4');
$navbar_type       = get_theme_mod('understrap_navbar_type', 'collapse');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Roboto:wght@400;700;900&family=Yellowtail&display=swap" rel="stylesheet" />
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
	<?php do_action('wp_body_open'); ?>
	<div class="site" id="page">

		<!-- ******************* The Navbar Area ******************* -->
		<?php $logo = get_field('logo', 'option'); ?>
		<header id="wrapper-navbar">
			<div class="logo">
				<a href="/"><img src="<?php echo $logo['url']; ?>" alt="" /><span><?php the_field('site_title', 'option'); ?></span></a>
				<i class="fa fa-bars" aria-hidden="true" id="menu"></i>
			</div>
			<?php
			// wp_nav_menu(array(
			// 	'theme_location'  => 'primary',
			// 	'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
			// 	'container'       => 'div',
			// 	'container_class' => 'collapse navbar-collapse',
			// 	'container_id'    => 'bs-example-navbar-collapse-1',
			// 	'menu_class'      => 'navbar-nav mr-auto',
			// 	'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			// 	'walker'          => new WP_Bootstrap_Navwalker(),
			// ));
			 ?>



			<div class="btn-group">
				<form class="search-form" action="">
					<input type="text" placeholder="Search..." />
					<button><img src="<?php echo get_theme_file_uri() . '/assets/images/search.png' ?>" alt="" /></button>
				</form>
				<div class="cart-login-wrapper">
					<?php
					global $woocommerce;
					$cart = $woocommerce->cart->get_cart();
					?>
					<div class="cart">
						<a href="<?php echo wc_get_cart_url() ?>"><button><img src="<?php echo get_theme_file_uri() . '/assets/images/cart-icon.png' ?>" alt="" /></button><span>Cart (<?php echo count($cart) ?>)</span></a>
					</div>
					<?php if (is_user_logged_in()) : ?>
						<div class="loged-in">
							<div class="dropdown-items">
								<a href="#"><img src="<?php echo get_avatar_url(get_current_user_id()); ?>" alt="" />
								</a>
								<div class="dropdown-link">
									<a href="/my-account/" class="menu-link">Dashboard</a>
									<a href="/my-account/orders/" class="menu-link">Orders</a>
									<a href="/my-account/edit-address/" class="menu-link">Addresses</a>
									<a href="/my-account/edit-account/" class="menu-link">Account details</a>
									<a href="<?php echo wp_logout_url(home_url()) ?>" class="menu-link">Logout</a>

								</div>
							</div>

						</div>
					<?php else : ?>
						<div class="login">
							<a href="/my-account"><span>Login</span></a>
						</div>
					<?php endif; ?>
				</div>

			</div>

		</header><!-- #wrapper-navbar -->