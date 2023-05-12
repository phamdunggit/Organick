<?php
$bg_image = get_field('background_image', 'option');
$heading = get_field('heading', 'option');
?>
<div class="newsletter-wrapper">
    <img src="<?php echo $bg_image['url'] ?>" alt="" class="newsletter-bg">
    <div class="newsletter-content">
        <h2><?php echo $heading ?></h2>
        <?php echo do_shortcode('[contact-form-7 id="6" title="Newsletter"]'); ?>
    </div>
</div>