<?php
$params = array(
    'post_type'      => 'product',
    'limit' => 4,
    's' => 0,
    'orderby' => 'relevance',
    'order'          => 'desc',
    // 'paginate' => true,
    // 'page' => $paged
    // 'page'=> 2,
);

// The Query
$products = wc_get_products($params); 
var_dump($products)
?>