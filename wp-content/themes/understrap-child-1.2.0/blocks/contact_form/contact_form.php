<?php
$short_code=get_field('short_code');
// echo $short_code;
?>
<div class="contact-form-container">
    <?php if(!$short_code): else: echo do_shortcode($short_code); endif; ?>
</div>