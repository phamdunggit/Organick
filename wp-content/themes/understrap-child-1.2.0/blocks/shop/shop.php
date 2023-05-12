<?php
global $paged;
$number = get_field('number');
$paged = (get_query_var('page')) ? get_query_var('page') : 1;
// var_dump($paged);
$params = array(
    'post_type'      => 'product',
    'limit' => $number,
    'orderby'        => 'meta_value_num',
    'meta_key'       => '_price',
    'order'          => 'asc',
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
                        <span class="origin-price">$<?php echo $data['regular_price'] ?></span>
                        <span class="sale-price">$<?php echo $data['sale_price'] ?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
    if ($navigation == 1) :
    ?>
        <a class="load-more-btn" href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Load more <img src="<?php echo get_theme_file_uri() . '/assets/images/Aerrow.png' ?>" alt=""></a>
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