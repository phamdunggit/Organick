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
$search = get_query_var('search');
$posttype = get_query_var('posttype');
// var_dump($search);
// var_dump($posttype);
$order = "desc";
$sort_by;
$orderby_query = (get_query_var('orderby')) ? get_query_var('orderby') : "relevance";
// $sort_by = ($orderby_query == "product_date") ? "date" : "relevance";
$paged = (get_query_var('pg')) ? get_query_var('pg') : 1;
switch ($orderby_query) {
    case "relevance":
        $sort_by = "relevance";
        $metakey = "";
        $order = "desc";
        break;
    case "total_sales":
        $sort_by = "meta_value_num";
        $metakey = "total_sales";
        $order = "desc";
        break;
    case "product_date":
        $sort_by = "date";
        $metakey = "";
        $order = "desc";
        break;
    case "price_asc":
        $sort_by = "meta_value_num";
        $metakey = "_price";
        $order = "asc";
        break;
    case "price-desc":
        $sort_by = "meta_value_num";
        $metakey = "_price";
        $order = "desc";
        break;
}
// var_dump($sort_by);
// var_dump($metakey);
// var_dump($order);
// var_dump($paged);
$params = array(
    'post_type'      => $posttype,
    'limit' => 12,
    's' => $search,
    'meta_key' => $metakey,
    'orderby' => $sort_by,
    'order'          => $order,
    'paginate' => true,
    'page' => $paged
    // 'page'=> 2,
);
$products = wc_get_products($params);

?>

<div class="wrapper" id="page-wrapper">
    <?php if (!$banner_image_background) :
    else :
    ?>
        <div class="banner" style="background-image:url(<?php echo $banner_image_background['url'] ?>);">
            <h1 class="banner-title"><?php echo get_the_title() ?></h1>
        </div>
    <?php endif; ?>
    <div class="search-container">
        <?php if(preg_match('/^\s+$/', $search)!=0|| strlen($search)==0 || count($products->products)==0): ?>
            <div class="search-heading">
            <h1>No result for: “<?php echo $search ?>”</h1>
        </div>

       <?php else: ?>
        <div class="search-heading">
            <h1>Search results for: “<?php echo $search ?>”</h1>
        </div>
        <div class="sort-container">
            <form class="woocommerce-ordering" method="get">
                <input type="hidden" name="search" value="<?php echo $search ?>">
                <input type="hidden" name="posttype" value="<?php echo $posttype ?>">
                <label for="orderby">Order by:</label>
                <select name="orderby" class="orderby custom-select form-select" aria-label="Shop order">
                    <option value="relevance" <?php if (get_query_var('orderby') == "relevance" || !get_query_var('orderby')) : echo "selected";
                                                else : endif; ?>>Relevance</option>
                    <option value="total_sales" <?php if (get_query_var('orderby') == "total_sales") : echo "selected";
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
                        <?php if (!get_field('net_weight', $item->id)) : ?>
                            <h4 class="product-name"><a href="<?php echo get_post_permalink($item->id) ?>"><?php echo $data['name'] ?></a></h4>
                        <?php else : ?>
                            <h4 class="product-name"><a href="<?php echo get_post_permalink($item->id) ?>"><?php echo $data['name'] . " - " . get_field('net_weight', $item->id) ?></a></h4>
                        <?php endif; ?>
                        <div class="price">
                            <?php if (!$data['sale_price']) : else : ?>
                                <span class="origin-price"><?php if (!$data['regular_price']) : else : echo get_woocommerce_currency_symbol() . " " . round($data['regular_price'], 2);
                                                            endif ?></span>
                            <?php endif; ?>
                            <span class="sale-price"><?php if (!$data['sale_price']) : echo get_woocommerce_currency_symbol() . " " . round($data['regular_price'], 2);
                                                        else : echo get_woocommerce_currency_symbol() . " " . round($data['sale_price'], 2);
                                                        endif;  ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        $big = 999999999;  // need an unlikely integer
        ?>
        <div class="pagination">
            <?php
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
        <?php endif; ?>
    </div>
</div>

<?php
get_template_part('global-templates/newsletter');
?>

</div>

<?php
get_footer();
