<?php
$ct7_short_code=get_field('ct7_short_code', 'option');
$bg_image = get_field('background_image', 'option');
$heading = get_field('heading', 'option');
?>
<div class="newsletter-wrapper" style="background-image:url(<?php echo $bg_image['url'] ?>);">
    <div class="newsletter-content">
        <h2><?php echo $heading ?></h2>
        <?php echo do_shortcode($ct7_short_code); ?>
    </div>
</div>