<?php
$banner_carousel = get_field('banner_carousel');
if ($banner_carousel) : ?>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($banner_carousel as $key => $item) {
                if ($key == 0) :
            ?>
                    <div class="carousel-item active" data-bs-interval="2000">
                        <div class="carousel-banner-wrapper" style="background-image: url(<?php echo $item['content']['background_image']['url']; ?>);">
                            <div class="carousel-banner-content">
                                <span style="color:<?php echo $item['content']['color']['sub-title_color']; ?>"><?php echo $item['content']['sub-title']; ?></span>
                                <h1 class="heading" style="color:<?php echo $item['content']['color']['title_color']; ?>"><?php echo $item['content']['title']; ?></h1>
                                <a class="banner-btn" style="<?php if ($item['content']['color']['button_color']) : echo "color: #274c5b;background: #efd372;";
                                                                else : echo "color: #ffffff;background: #274c5b;";
                                                                endif; ?>" href="<?php echo $item['content']['button']['url'] ?>"><?php echo $item['content']['button']['title'] ?>
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                                        <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="carousel-item" data-bs-interval="2000">
                        <div class="carousel-banner-wrapper" style="background-image: url(<?php echo $item['content']['background_image']['url']; ?>);">
                            <div class="carousel-banner-content">
                                <span style="color:<?php echo $item['content']['color']['sub-title_color']; ?>"><?php echo $item['content']['sub-title']; ?></span>
                                <h2 class="heading" style="color:<?php echo $item['content']['color']['title_color']; ?>"><?php echo $item['content']['title']; ?></h2>
                                <a class="banner-btn" style="<?php if ($item['content']['color']['button_color'] == "1") : echo "color: #274c5b;background: #efd372;";
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