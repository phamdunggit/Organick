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
    // echo get_the_ID();
    // $banner = get_field('banner');
    $product_origin = get_field('product_origin');
    $expiry_date = get_field('expiry_date');
    $sent_from = get_field('sent_from');
    $nutrition_facts = get_field('nutrition_facts');
    $product_info = new WC_product(get_the_ID());
    $product = $product_info->get_data();
    $related_products = wc_get_related_products(get_the_ID(), 4);
    $single_shop_banner =get_field('single_shop_banner','option');
    // echo "<pre>";
    // var_dump($related_products);
    // var_dump($product);
    // var_dump($sent_from);
    // echo "</pre>";
    if (!$single_shop_banner) :
    else :
    ?>
        <div class="banner" style="background-image:url(<?php echo $single_shop_banner['url'] ?>);">
            <h1 class="banner-title"><?php //echo $product['name'] ?>Shop Single</h1>
        </div>
    <?php endif; ?>
    <!-- Product section -->
    <div class="single-product-wrapper">
        <div class="row">
            <div class="col-md-12 col-lg-5 single-product-image">
                <a class="single-product-category" href="<?php echo get_category_link($product['category_ids']['0']) ?>"><?php echo get_term($product['category_ids']['0'])->name ?></a>
                <img src="<?php echo get_the_post_thumbnail_url($product['id']) ?>" alt="" srcset="">
                <img id="img-zoom" src="<?php echo get_the_post_thumbnail_url($product['id']) ?>" alt="" srcset="">
            </div>
            <div class="col-md-12 col-lg-7 single-product-content">
                <h2 class="product-name"><?php echo $product['name'] ?></h2>
                <div class="single-product-price">
                    <span class="origin-price"><?php if(!$product['regular_price']): else: echo get_woocommerce_currency_symbol()." ".round($product['regular_price'], 2); endif ?></span>
                    <span class="sale-price"><?php if(!$product['sale_price']): echo get_woocommerce_currency_symbol()." ".round($product['regular_price'], 2); else: echo get_woocommerce_currency_symbol()." ".round($product['sale_price'], 2); endif ?></span>
                </div>
                <div class="short_description"><?php echo $product['short_description'] ?></div>
                <form class="add-to-cart-form" action="<?php echo "/" . $product['slug'] ?>" method="post" enctype="multipart/form-data">
                    <div class="quantity">
                        <label>Quantity :</label>
                        <input type="number" class="quantity-input" name="quantity" value="1" title="Qty" size="4" min="1" max="<?php echo $product['sku'] ?>" step="1" placeholder="" inputmode="numeric" autocomplete="off">
                    </div>
                    <button type="submit" name="add-to-cart" value="<?php echo $product['id'] ?>" class="add-to-cart-btn">
                    Add to cart 
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B"/>
<path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                </button>
                </form>
            </div>
            <div class="col-12">
                <div class="product-info-btn">
                    <button class="description-btn active">Product Description</button>
                    <button class="additional-btn">Additional Info</button>
                </div>
                <div class="product-description show">
                    <div><?php echo $product['description'] ?></div>
                </div>
                <div class="additional-info">
                    <div class="product-detail">
                        <h3><strong>Product Details</strong></h3>
                        <p><strong>Product Origin:</strong> <?php echo $product_origin ?></p>
                        <p><strong>Category:</strong> <a href="<?php echo get_category_link($product['category_ids']['0']) ?>"><?php echo get_term($product['category_ids']['0'])->name ?></a></p>
                        <p><strong>Weight:</strong> <?php echo $product['weight'] ?></p>
                        <p><strong>Expiry date</strong> : <?php echo $expiry_date ?></p>
                        <p><strong>Stock:</strong> <?php echo $product['sku'] ?></p>
                        <p><strong>Sent from:</strong> <?php echo $sent_from ?></p>
                    </div>
                    <div class="nutrition-facts">
                        <?php if(!$nutrition_facts): else : ?>
                        <h3><strong>Nutrition Facts Per 100g</strong></h3>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th class="col">Nutrition</th>
                                <th class="col">Value</th>
                            </tr>
                            <?php foreach ($nutrition_facts as $item) { ?>
                                <tr>
                                    <td><?php echo $item['nutrition'] ?></td>
                                    <td><?php echo $item['value'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col-12 related-products-wrapper">
                <div class="related-products-heading">
                    <h3>Related Products</h3>
                </div>
                <div class="product-container">
                    <div class="owl-carousel related-product-carousel owl-theme">
                        <?php if(!$related_products): else:
                         foreach ($related_products as $item) {
                            $related_product_info = new WC_product($item);
                            $related_product = $related_product_info->get_data();
                        ?>
                            <div class="product">
                                <a class="product-category" href="<?php echo get_category_link($related_product['category_ids']['0']) ?>"><?php echo get_term($related_product['category_ids']['0'])->name ?></a>
                                <div class="product-image">
                                    <a href="<?php echo get_post_permalink($item) ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url($item) ?>" alt="" srcset="">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <h4 class="product-name"><a href="<?php echo get_post_permalink($item) ?>"><?php echo $related_product['name'] ?></a></h4>
                                    <div class="price">
                                        <span class="origin-price">$<?php echo round($related_product['regular_price'], 2) ?></span>
                                        <span class="sale-price">$<?php echo round($related_product['sale_price'], 2) ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } endif ?>
                    </div>
                    <script>
                        jQuery(document).ready(function() {
                            $('.owl-carousel').owlCarousel({
                                autoplay: false,
                                autoplayTimeout: 2000,
                                autoplayHoverPause: true,
                                loop: true,
                                autoWidth: true,
                                center: true,
                                margin: 20,
                                nav: true,
                                dots: true,
                                responsive: {
                                    0: {
                                        items: 2
                                    },
                                    576: {
                                        items: 2
                                    },
                                    992: {
                                        items: 4
                                    }
                                },
                                // navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
                            })
                        })
                    </script>
                </div>
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
