<?php
$offer_carousel = get_field('offer_carousel')
?>
<div class="carousel-wrapper">
    <div class="owl-carousel offer-carousel owl-theme">
        <?php foreach ($offer_carousel as $item) { ?>
            <a href="<?php echo $item['content']['link']["url"] ?>">
                <div class="offer">
                    <img src="<?php echo $item['content']['background_image']["url"] ?>" alt="" srcset="">
                    <div class="offer-content">
                        <p style="color:<?php echo $item['content']['color']["sub-title_color"] ?>;"><?php echo $item['content']['sub-title'] ?></p>
                        <h2 style="color:<?php echo $item['content']['color']["title_color"] ?>;"><?php echo $item['content']['title'] ?></h2>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            loop: true,
            autoWidth: false,
            center: true,
            margin: 36,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    })
</script>