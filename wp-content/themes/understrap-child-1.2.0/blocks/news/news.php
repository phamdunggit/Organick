<?php
$heading = get_field('heading');
$sub_heading = get_field('sub_heading');
$num_of_news = get_field('number');
$pagination = get_field('pagination');
$paged = (get_query_var('pg')) ? get_query_var('pg') : 1;
$args = array(
    // 'numberposts' => 2,
    'post_type'   => 'news',
    'posts_per_page' => $num_of_news,
    'order'       => 'DESC',
    'orderby'     => 'date',
    'paginate' => true,
    'paged' => $paged
);
$news = new WP_Query($args);
$big = 999999999; // need an unlikely integer
// echo "<pre>";
// var_dump($news['0']);
// var_dump(get_post_permalink(280));
// var_dump(get_the_date('', 280));
// echo "</pre>";
// echo substr(get_the_date('', 280),4,2);
?>
<div class="news-wrapper">
    <div class="news-top">
        <div class="news-heading">
            <span><?php echo $heading ?></span>
            <h2><?php echo $sub_heading ?></h2>

        </div>
        <?php if ($pagination == 2) : ?>
            <a class="news-load-more-btn" href="/news">More News
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                    <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        <?php endif; ?>
    </div>
    <div class="list-news">
        <?php foreach ($news->posts as $item) { ?>
            <div class="news">
                    <div class="date">
                        <span class="day"><?php echo substr(get_the_date('', $item->ID), 4, 2) ?></span>
                        <span class="month"><?php echo substr(get_the_date('', $item->ID), 0, 3) ?></span>
                    </div>
                    <div class="news-img">
                        <img src="<?php echo get_the_post_thumbnail_url($item->ID) ?>" alt="">
                    </div>
                    <div class="news-info">
                        <div class="author-news">
                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.3161 1.45446C11.4741 0.516515 10.298 0 9 0C7.69504 0 6.51512 0.51339 5.67701 1.44553C4.82983 2.38793 4.41705 3.66873 4.51397 5.05176C4.70608 7.78031 6.71848 9.99994 9 9.99994C11.2815 9.99994 13.2905 7.78076 13.4856 5.05265C13.5838 3.68212 13.1684 2.404 12.3161 1.45446ZM16.6152 19.9999H1.38482C1.18547 20.0026 0.988051 19.9594 0.806921 19.8734C0.625791 19.7874 0.46551 19.6609 0.337738 19.503C0.0564959 19.1561 -0.0568664 18.6825 0.0270736 18.2035C0.392256 16.1133 1.53194 14.3575 3.32323 13.1249C4.91463 12.0307 6.93049 11.4285 9 11.4285C11.0695 11.4285 13.0854 12.0312 14.6768 13.1249C16.4681 14.3571 17.6077 16.1129 17.9729 18.203C18.0569 18.682 17.9435 19.1557 17.6623 19.5026C17.5345 19.6606 17.3743 19.7872 17.1931 19.8732C17.012 19.9592 16.8146 20.0025 16.6152 19.9999Z" fill="#EFD372" />
                            </svg>
                            <p class="author-name">By <?php echo get_the_author_meta('display_name', $item->post_author); ?></p>
                        </div>
                        <div class="news-short-content">
                        <a href="<?php echo get_post_permalink($item->ID) ?>">
                            <h3><?php echo $item->post_title; ?></h3>
                        </a>
                        <a href="<?php echo get_post_permalink($item->ID) ?>">
                            <p><?php echo $item->post_excerpt; ?></p>
                        </a>
                            <a href="<?php echo get_post_permalink($item->ID) ?>" class="news-read-more-btn">
                                Read More
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                                    <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
            </div>
        <?php } ?>
    </div>
    <?php if ($pagination == 1) : ?>
        <div class="pagination">
            <?php
            $big = 999999999;
            echo paginate_links(array(
                // 'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'format'        =>  '?pg=%#%',
                'current' => $paged,
                'total' => $news->max_num_pages,
                'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
            ));
            wp_reset_postdata();
            ?>
        </div>
    <?php
    else :
    endif;
    ?>
</div>