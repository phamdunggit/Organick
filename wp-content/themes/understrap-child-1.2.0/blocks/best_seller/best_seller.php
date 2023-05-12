<?php
$args = array(
    'post_type' => 'product',
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'posts_per_page' => 4,
);
$best_sell_prod = wc_get_products($args);
// echo "<pre>";
// var_dump($best_sell_prod);
// echo "</pre>";
?>
<div class="best-seller-wrapper">
    <div class="best-seller-top">
        <div class="best-seller-title">
            <h2>Offer</h2>
            <p>We Offer Organic For You</p>
        </div>
        <a class="view-all-btn" href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">View All Product <img src="<?php echo get_theme_file_uri() . '/assets/images/Aerrow.png' ?>" alt=""></a>
    </div>
    <div class="product-wrapper" >
<?php
//display products
foreach ($best_sell_prod as $item) {
    $data = $item->get_data();
?>
    <div class="product">
        <a class="product-category" href="<?php echo get_category_link($data['category_ids']['0']) ?>"><?php echo get_term($data['category_ids']['0'])->name ?></a>
        <div class="product-image">
            <img src="<?php echo get_the_post_thumbnail_url($item->id) ?>" alt="" srcset="">

        </div>
        <div class="product-info">
            <h4 class="product-name"><a href="<?php echo get_post_permalink($item->id) ?>"><?php echo $data['name'] ?></a></h4>
            <div class="price">
                <span class="origin-price">$<?php echo $data['regular_price'] ?></span>
                <span class="sale-price">$<?php echo $data['sale_price'] ?></span>
            </div>
        </div>
    </div>
<?php } ?>
</div>
</div>