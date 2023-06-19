<?php
$numofprod = get_field('number');
$heading = get_field('heading');
$sub_heading = get_field('sub_heading');
$args = array(
    'post_type' => 'product',
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'order'          => 'desc',
    'posts_per_page' => $numofprod,
);
$best_sell_prod = wc_get_products($args);
// echo "<pre>";
// var_dump($best_sell_prod);
// echo "</pre>";
?>
<div class="best-seller-wrapper">
    <div class="best-seller-top">
        <div class="best-seller-title">
            <span><?php echo $heading ?></span>
            <h2><?php echo $sub_heading ?></h2>
        </div>
        <a class="view-all-btn" href="/shop">View All Product <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            </svg></a>
    </div>
    <div class="product-wrapper">
        <?php
        //display products
        foreach ($best_sell_prod as $item) {
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
                        <span class="origin-price"><?php echo get_woocommerce_currency_symbol() ?><?php echo round($data['regular_price'], 2) ?></span>
                        <span class="sale-price"><?php echo get_woocommerce_currency_symbol() ?><?php echo round($data['sale_price'], 2) ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>