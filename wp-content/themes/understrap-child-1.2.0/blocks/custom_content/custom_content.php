<?php
$content = get_field('content');
$image = get_field('image');
?>
<div style="background-color: <?php echo $content['color']['background_color'] ?> ;" class="about-wrapper">

    <img class="about-image" src="<?php echo $image['image']['url'] ?> ." alt="" srcset="">



    <div style="background-color: <?php echo $content['color']['background_color'] ?> ;" class="content-about">
        <p style="color:<?php echo $content['color']['sub-heading_color'] ?>;" class="sub-heading"><?php echo $content['sub-heading'] ?> </p>
        <h2 style="color:<?php echo $content['color']['heading_color'] ?>;" class="about-heading"><?php echo $content['heading'] ?></h2>
        <p style="color:<?php echo $content['color']['text_color'] ?>;" class="about-text"> <?php echo $content['text'] ?></p>
        <?php foreach ($content['list'] as $item) { ?>
            <div class="list-about">
                <div style="background:<?php echo $content['color']['icon_background_color'] ?>;" class="list-icon">
                    <img src="<?php echo $item['icon']['url'] ?>" alt="">
                </div>
                <div class="list-content">
                    <h3 style="color:<?php echo $content['color']['heading_color'] ?>;" class="list-heading"><?php echo $item['heading'] ?></h3>
                    <p style="color:<?php echo $content['color']['text_color'] ?>;" class="list-text"><?php echo $item['text'] ?></p>
                </div>
            </div>
        <?php } ?>
        <a class="content-btn" style="<?php if ($content['color']['button_color'] == "1") : echo "color: #274c5b;background: #efd372;";
                                        else : echo "color: #ffffff;background: #274c5b;";
                                        endif; ?>" href="<?php echo $content['button']['url'] ?>"><?php echo $content['button']['title']  ?> <img src="<?php echo get_theme_file_uri() . '/assets/images/Aerrow.png' ?>" alt=""></a>
    </div>
</div>




</div>