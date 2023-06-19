<?php
global $paged;
$number = get_field('number');
$paged = (get_query_var('pg')) ? get_query_var('pg') : 1;
$order = "desc";
$metakey;
$orderby_query = (get_query_var('orderby')) ? get_query_var('orderby') : "total_sales";
$sort = get_field('sort_by');
$sort_by=($orderby_query=="product_date") ? "date" : "meta_value_num";
switch ($orderby_query) {
    case "total_sales":
        $metakey="total_sales";
        $order="desc";
        break;
    case "product_date":
        $metakey="";
        $order="desc";
        break;
    case "price_asc":
        $metakey="_price";
        $order="asc";
        break;
    case "price_desc":
        $metakey="_price";
        $order="desc";
        break;
}
// var_dump($orderby_query);

// var_dump($metakey);
// var_dump($order);
$params = array(
    'post_type'      => 'product',
    'limit' => $number,
    'meta_key' => $metakey,
    'orderby' => $sort_by,
    'order'          => $order,
    'paginate' => true,
    'page' => $paged
    // 'page'=> 2,
);
// var_dump( wc_get_products($params));
// $products= new WP_Query($params);
$products = wc_get_products($params);

$navigation = get_field('navigation');
$sub_heading = get_field('sub-heading');
$heading = get_field('heading');
// echo "<pre>";
// // var_dump($navigation);
// // var_dump($catalog_orderby_options);
// var_dump($products);
// // var_dump($products->products[0]->get_price());
// // var_dump(get_the_post_thumbnail_url( $products->posts['0']->ID, 'full' ));
// // var_dump( get_post_meta( $products->posts['0']->ID, '_price', true ));
// // var_dump($sort_by);
// echo "</pre>";

?>

<div class="shop-wrapper">
    
    <div class="shop-header">
        <?php if(!$sub_heading && !$heading): else: ?>
        <div class="shop-heading">
            <p class="shop-sub-heading"><?php echo $sub_heading ?></p>
            <h1 class="shop-heading"><?php echo $heading ?></h1>
        </div>
        <?php endif ?>
    </div>
    <?php if($sort==2): else : ?>
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
                <option value="price_desc" <?php if (get_query_var('orderby') == "price_desc") : echo "selected";
                                            else : endif; ?>>Price: high to low</option>
            </select>
            <input type="hidden" name="pg" value="1">
        </form>
    </div>
    <?php endif; ?>
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
                    <?php if(!get_field('net_weight',$item->id)): ?>
                    <h4 class="product-name"><a href="<?php echo get_post_permalink($item->id) ?>"><?php echo $data['name'] ?></a></h4>
                    <?php else: ?>
                    <h4 class="product-name"><a href="<?php echo get_post_permalink($item->id) ?>"><?php echo $data['name']." - ".get_field('net_weight',$item->id) ?></a></h4>
                    <?php endif; ?>
                    <div class="price">
                        <?php if(!$data['sale_price']): else: ?>
                        <span class="origin-price"><?php if(!$data['regular_price']): else: echo get_woocommerce_currency_symbol()." ".round($data['regular_price'], 2); endif ?></span>
                        <?php endif; ?>
                        <span class="sale-price"><?php if(!$data['sale_price']): echo get_woocommerce_currency_symbol()." ".round($data['regular_price'], 2); else: echo get_woocommerce_currency_symbol()." ". round($data['sale_price'], 2); endif;  ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
    if ($navigation == 1) :
    ?>
        <a class="load-more-btn" href="/shop">Load more
            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    <?php
    else : // need an unlikely integer
    ?>
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
    <?php
    endif;

    ?>
</div>