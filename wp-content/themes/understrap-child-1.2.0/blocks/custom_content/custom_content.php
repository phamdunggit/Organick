<?php
$content = get_field('content');
$image = get_field('image');

?>
<div style="background-color: <?php echo $content['color']['background_color'] ?> ;" class="about-wrapper">
    <div class="row">
        <div class="col-md-12 col-lg-6 about-image">
            <img class="" src="<?php echo $image['image']['url'] ?> ." alt="" srcset="">
        </div>
        <div style="background-color: <?php echo $content['color']['background_color'] ?> ;" class="col-md-12 col-lg-6 content-about">
            <p style="color:<?php echo $content['color']['sub-heading_color'] ?>;" class="sub-heading"><?php echo $content['sub-heading'] ?> </p>
            <h2 style="color:<?php echo $content['color']['heading_color'] ?>;" class="about-heading"><?php echo $content['heading'] ?></h2>
            <div style="color:<?php echo $content['color']['text_color'] ?>;" class="about-text"> <?php echo $content['text'] ?></div>

            <div class="list-about" style="<?php if ($content['list_direction'] == 1) : echo "flex-direction: column;"; else : endif; ?>">
                <?php foreach ($content['list'] as $item) { ?>
                    <div class="list-about-item">
                        <div style="background:<?php echo $content['color']['icon_background_color'] ?>;" class="list-icon">
                            <img src="<?php echo $item['icon']['url'] ?>" alt="">
                        </div>
                        <div class="list-content">
                            <h3 style="color:<?php echo $content['color']['heading_color'] ?>;" class="list-heading"><?php echo $item['heading'] ?></h3>
                            <p style="color:<?php echo $content['color']['text_color'] ?>;" class="list-text"><?php echo $item['text'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a class="content-btn" style="<?php if ($content['color']['button_color'] == "1") : echo "color: #274c5b;background: #efd372;";
                                            else : echo "color: #ffffff;background: #274c5b;";
                                            endif; ?>" href="<?php echo $content['button']['url'] ?>"><?php echo $content['button']['title']  ?>
                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                    <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>

</div>




</div>