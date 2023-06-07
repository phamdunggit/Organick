<?php
$heading = get_field('heading');
$sub_heading = get_field('sub-heading');
$cate_img_id;
$get_all_category = get_field('get_all_category');
$categories;
if ($get_all_category == 1) :
    $args = array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => true     // Set to false to get all categories
    );
    $categories = get_terms($args);
else :
    $categories = get_field('categories');
endif;

// var_dump(get_page_by_path( 'categories' ));
// foreach($categories as $cate){
//     var_dump($cate->term_id);
// }
// echo "<pre>";
// var_dump($categories);
// // // var_dump(get_the_category_by_ID($cate['0']->term_id));
// // var_dump(get_term_meta( $cate['0']->term_id, 'thumbnail_id', true ));
// // echo(wp_get_attachment_url(get_term_meta( $cate['0']->term_id, 'thumbnail_id', true )));
// echo "</pre>";
?>
<div class="categories-wrapper">
    <div class="cate-top">
        <span><?php echo $sub_heading ?></span>
        <h2><?php echo $heading ?></h2>
    </div>
    <div class="list-cate">
        <?php foreach ($categories as $cate) {
            $cate_img_id = get_term_meta($cate->term_id, 'thumbnail_id', true);
        ?>
            <div class="category">
                <div class="cate-img">
                    <a href="<?php echo get_category_link($cate->term_id); ?>" class="image-hover">
                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle cx="23" cy="23" r="23" fill="#7EB693"/>
<path d="M21 28L26.5 22.5L21 17" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                    </a>
                    <a href="<?php echo get_category_link($cate->term_id); ?>"><img src="<?php echo wp_get_attachment_image_url($cate_img_id, 'full') ?>" alt=""></a>
                </div>

                <a href="<?php echo get_category_link($cate->term_id); ?>" class="cate-name"><?php echo $cate->name ?></a>
            </div>
        <?php } ?>
    </div>
    <?php if ($get_all_category == 1) : else : ?>
        <a class="load-more-cate-btn" href="<?php echo get_permalink(get_page_by_path('categories')); ?> ">
            Load more
            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    <?php endif; ?>
</div>