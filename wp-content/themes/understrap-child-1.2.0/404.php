<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');
$_404_background_image = get_field('404_background_image', 'option');
// var_dump($banner_image_background);
?>

<div class="wrapper" id="page-wrapper">
    <?php
    ?>
    <div class="_404-container" <?php if (!$_404_background_image) : else : ?> style="background-image:url(<?php echo $_404_background_image['url']  ?>);" <?php endif; ?>>
        <div class="_404-content">
            <div class="_404-image">
                <img src="<?php echo get_stylesheet_directory_uri() . "/assets/images/404.png" ?>" alt="">
            </div>
            <h1>Page not found</h1>
            <p>The page you are looking for doesn't exist or has been moved</p>
            <a href="/" class="back-to-home-btn">Go to Homepage
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                    <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>
    <?php
    get_template_part('global-templates/newsletter');

    ?>
</div>

<?php
get_footer();
