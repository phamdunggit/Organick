<?php
$heading = get_field('heading');
$text = get_field('text');
$image = get_field('image');
$mail_address = get_field('mail_address');
$phone_number = get_field('phone_number');
$icon=get_field('icon');
$social_link = get_field('social_link');
?>
<div class="contact-container">
    <div class="row">
        <div class="col-md-12 col-lg-6 contact-image">
            <img src="<?php echo $image['url'] ?>" alt="">
        </div>
        <div class="col-md-12 col-lg-6 contact-content">
            <h2 class="heading"><?php echo $heading ?> </h2>
            <p class="text"><?php echo $text ?></p>
            <div class="list-contact">
                <div class="contact-wrapper">
                    <div class="contact-icon">
                        <img src="<?php echo $icon['mail_icon']['url'] ?>" alt="">
                    </div>
                    <div class="contact-info">
                        <h6 class="contact-method">Message</h6>
                        <a href="mailto:<?php echo $mail_address ?>" target="_blank" class="contact_detail"><?php echo $mail_address ?></a>
                    </div>
                </div>
                <div class="contact-wrapper">
                    <div class="contact-icon">
                        <img src="<?php echo $icon['phone_icon']['url'] ?>" alt="">
                    </div>
                    <div class="contact-info">
                        <h6 class="contact-method">Contact Us</h6>
                        <a href="tel:<?php echo $phone_number ?>" class="contact_detail"><?php echo $phone_number ?></a>
                    </div>
                </div>
            </div>
            <div class="socital-contact">
                <?php if(!$social_link): else : foreach($social_link as $item){ ?>
                <a href="<?php echo $item['link'] ?>" target="_blank"><i class="<?php echo $item['icon'] ?>" aria-hidden="true"></i></a>
                <?php } endif; ?>
            </div>
        </div>
    </div>
</div>