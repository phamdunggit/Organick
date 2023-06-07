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
$banner_image_background = get_field('category_details_banner', 'option');
// var_dump($banner_image_background);
$category = get_queried_object();

$orderby_query = (!get_query_var('orderby') || get_query_var('orderby') == "menu_order title") ? "total_sales" : get_query_var('orderby');
$order = "desc";
$metakey = "";
$paged = (get_query_var('pg')) ? get_query_var('pg') : 1;
$sort_by = ($orderby_query == "product_date") ? "date" : "meta_value_num";
switch ($orderby_query) {
    case "total_sales":
        $metakey = "total_sales";
        $order = "desc";
        break;
    case "product_date":
        $metakey = "";
        $order = "desc";
        break;
    case "price_asc":
        $metakey = "_price";
        $order = "asc";
        break;
    case "price-desc":
        $metakey = "_price";
        $order = "desc";
        break;
}
$params = array(
    'post_type' => 'product',
    'limit' => 4,
    'meta_key' => $metakey,
    'orderby' => $sort_by,
    'order'          => $order,
    'paginate' => true,
    'page' => $paged, // set to -1 to get all posts
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $category->slug // replace with the slug of your desired category
        )
    )
);
$products = wc_get_products($params);
// echo '<pre>';
// var_dump($category);
// echo '</pre>';

?>

<div class="wrapper" id="page-wrapper">
    <?php if (!$banner_image_background) :
    else :
    ?>
        <div class="banner" style="background-image:url(<?php echo $banner_image_background['url'] ?>);">
            <h2 class="banner-title">Category</h2>
        </div>
    <?php endif; ?>
    <div class="archive-product-wrapper">
        <div class="archive-product-header">
            <h1><?php echo $category->name ?></h1>
            <p><?php echo $category->description ?></p>
        </div>
        <div class="sort-container">
        <form class="woocommerce-ordering" method="get">
            <label for="orderby">Order by:</label>
            <select name="orderby" class="orderby custom-select form-select" aria-label="Shop order">
                <option value="total_sales" <?php if (get_query_var('orderby') == "total_sales" || !get_query_var('orderby')) : echo "selected";
                                            else : endif; ?>>Popularity</option>
                <option value="product_date" <?php if (get_query_var('orderby') == "product_date") : echo "selected";
                                                else : endif; ?>>Latest</option>
                <option value="price_asc" <?php if (get_query_var('orderby') == "price_asc") : echo "selected";
                                            else : endif; ?>>Price: low to high</option>
                <option value="price-desc" <?php if (get_query_var('orderby') == "price-desc") : echo "selected";
                                            else : endif; ?>>Price: high to low</option>
            </select>
            <input type="hidden" name="pg" value="1">
        </form>
    </div>
        <div class="product-wrapper">
            <?php
            //display products
            foreach ($products->products as $item) {
                $data = $item->get_data();
            ?>
                <div class="product">
                    <a class="product-category" href="<?php echo get_category_link($data['category_ids']['0']) ?>"><?php echo get_term($data['category_ids']['0'])->name ?></a>
                    <div class="product-image">
                        <a href="<?php echo get_post_permalink($item->id) ?>">
                            <img src="<?php echo get_the_post_thumbnail_url($item->id) ?>" alt="" srcset="">
                        </a>
                    </div>
                    <div class="product-info">
                        <h4 class="product-name"><a href="<?php echo get_post_permalink($item->id) ?>"><?php echo $data['name'] ?></a></h4>
                        <div class="price">
                            <span class="origin-price"><?php if (!$data['regular_price']) : else : echo get_woocommerce_currency_symbol() . " " . round($data['regular_price'], 2);
                                                        endif ?></span>
                            <span class="sale-price"><?php if (!$data['sale_price']) : echo get_woocommerce_currency_symbol() . " " . round($data['regular_price'], 2);
                                                        else : echo get_woocommerce_currency_symbol() . " " . round($data['sale_price'], 2);
                                                        endif;  ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="pagination">
            <?php
            $big = 999999999; 
            echo paginate_links(array(
                // 'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'        =>  '?pg=%#%',
                'current' => $paged,
                'total' => $products->max_num_pages,
                'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
            ));
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
    get_template_part('global-templates/newsletter');

    ?>
</div>

<?php
get_footer();
