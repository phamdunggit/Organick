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

// var_dump($banner_image_background);
?>

<div class="wrapper" id="page-wrapper">

    <?php
    // the_content();
    // global $product;
    // $post_id = $product->get_id();
    echo get_the_ID();
    $banner = get_field('banner');
    $product_origin=get_field('product_origin');
    $expiry_date=get_field('expiry_date');
    $sent_from=get_field('sent_from');
    $nutrition_facts=get_field('nutrition_facts');
    $product_info = new WC_product(get_the_ID());
    $product = $product_info->get_data();
    $related_products = wc_get_related_products(get_the_ID(), 4);
    echo "<pre>";
    // var_dump($related_products);
    var_dump($product);
    echo "</pre>";
    if (!$banner) :
    else :
    ?>
        <div class="banner" style="background-image:url(<?php echo $banner['url'] ?>);">
            <h1 class="banner-title"><?php echo $product['name'] ?></h1>
        </div>
    <?php endif; ?>
    <!-- Product section -->
    <div class="single-product-wrapper">
        <div class="row">
            <div class="col-6 product-image">

                <a class="product-category" href="<?php echo get_category_link($product['category_ids']['0']) ?>"><?php echo get_term($product['category_ids']['0'])->name ?></a>
                <img src="<?php echo get_the_post_thumbnail_url($product['id']) ?>" alt="" srcset="">
            </div>
            <div class="col-6 product-content">
                <h2 class="product-name"><?php echo $product['name'] ?></h2>
                <div class="short_description"><?php echo $product['short_description'] ?></div>
                <div class="price">
                    <span class="origin-price">$<?php echo round($product['regular_price'], 2) ?></span>
                    <span class="sale-price">$<?php echo round($product['sale_price'], 2) ?></span>
                </div>
                <form class="cart" action="<?php echo "/".$product['slug'] ?>" method="post" enctype="multipart/form-data">
                    <div class="quantity">
                        <label class="screen-reader-text" for="quantity_646dc5139e377">Zelco Suji Elaichi Rusk quantity</label>
                        <input type="number" id="quantity_646dc5139e377" class="input-text qty text form-control" name="quantity" value="1" title="Qty" size="4" min="1" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off">
                    </div>
                    <button type="submit" name="add-to-cart" value="187" class="btn btn-outline-primary">Add to cart</button>
                </form>
            </div>
            <div class="col-12">
                <div class="product-info-btn">
                    <button>Product Description</button>
                    <button>Additional Info</button>
                </div>
                <div class="product-description show">
                    <p><?php echo $product['description'] ?></p>
                </div>
                <div class="additional-info">
                    <p>Product Origin: <?php ?></p>
                </div>
            </div>
            <div class="related-products-wrapper">

            </div>
        </div>
    </div>
    <!-- End Product section -->
    <?php
    get_template_part('global-templates/newsletter');
    ?>

</div>

<?php
get_footer();
