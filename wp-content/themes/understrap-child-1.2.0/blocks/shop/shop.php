<?php
global $paged;
$number = get_field('number');
$paged = (get_query_var('page')) ? get_query_var('page') : 1;
// var_dump($paged);
$params = array(
    'post_type'      => 'product',
    'limit' => $number,
    'orderby'        => 'meta_value_num',
    'meta_key' => 'total_sales',
    'order'          => 'desc',
    'paginate' => true,
    'page' => $paged
    // 'page'=> 2,
);
// var_dump( wc_get_products($params));
// $products= new WP_Query($params);
$products = wc_get_products($params);

$navigation = get_field('navigation');
// echo "<pre>";
// var_dump($navigation);
// var_dump($catalog_orderby_options);
// var_dump($products);
// var_dump($products->products[0]->get_price());
// var_dump(get_the_post_thumbnail_url( $products->posts['0']->ID, 'full' ));
// var_dump( get_post_meta( $products->posts['0']->ID, '_price', true ));
// echo "</pre>";

?>
<div class="shop-wrapper">
    <p class="shop-sub-heading">Categories</p>
    <h1 class="shop-heading">Our Products</h1>
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
                        <span class="origin-price">$<?php echo round($data['regular_price'], 2) ?></span>
                        <span class="sale-price">$<?php echo round($data['sale_price'], 2) ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
    if ($navigation == 1) :
    ?>
        <a class="load-more-btn" href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Load more
            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    <?php
    else :
        $big = 999999999; // need an unlikely integer
    ?>
        <div class="pagination">


            <?php
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'format' => '?paged=%#%',
                'current' => $paged,
                'total' => $products->max_num_pages,
            ));
            wp_reset_postdata();
            ?>

        </div>
    <?php
    endif;

    ?>
</div>