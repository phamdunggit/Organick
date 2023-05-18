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
$banner_image_background = get_field('banner_image_background');
// var_dump($banner_image_background);
?>

<div class="wrapper" id="page-wrapper">
    <?php if (!$banner_image_background) :
    else :
    ?>
        <div class="banner" style="background-image:url(<?php echo $banner_image_background['url'] ?>);">
            <h1 class="banner-title"><?php echo get_the_title() ?></h1>
        </div>
    <?php endif; ?>
    <?php
    the_content();
    get_template_part('global-templates/newsletter');
    ?>

</div>

<?php
get_footer();
