<?php
$banner_carousel = get_field('banner_carousel');
if ($banner_carousel) : ?>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($banner_carousel as $key => $item) {
                if ($key == 0) :
            ?>
                    <div class="carousel-item active">
                        <img src="<?php echo $item['content']['background_image']['url']; ?>" class="d-block w-100" alt="">
                        <div class="carousel-caption d-md-block">
                            <p style="color:<?php echo $item['content']['color']['sub-title_color']; ?>"><?php echo $item['content']['sub-title']; ?></p>
                            <h2 style="color:<?php echo $item['content']['color']['title_color']; ?>"><?php echo $item['content']['title']; ?></h2>
                            <a style="<?php if ($item['content']['color']['button_color']) : echo "color: #274c5b;background: #efd372;";
                                        else : echo "color: #ffffff;background: #274c5b;";
                                        endif; ?>" href="<?php echo $item['content']['button']['url'] ?>"><?php echo $item['content']['button']['title'] ?> <img src="<?php echo get_theme_file_uri() . '/assets/images/Aerrow.png' ?>" alt=""></a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="carousel-item">
                        <img src="<?php echo $item['content']['background_image']['url']; ?>" class="d-block w-100" alt="">
                        <div class="carousel-caption d-md-block">

                            <p style="color:<?php echo $item['content']['color']['sub-title_color']; ?>"><?php echo $item['content']['sub-title']; ?></p>
                            <h2 style="color:<?php echo $item['content']['color']['title_color']; ?>"><?php echo $item['content']['title']; ?></h2>
                            <a style="<?php if ($item['content']['color']['button_color'] == "1") : echo "color: #274c5b;background: #efd372;";
                                        else : echo "color: #ffffff;background: #274c5b;";
                                        endif; ?>" href="<?php echo $item['content']['button']['url'] ?>">
                                <?php echo $item['content']['button']['title'] ?>
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                                    <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
            <?php endif;
            } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php
else :
endif;
?>