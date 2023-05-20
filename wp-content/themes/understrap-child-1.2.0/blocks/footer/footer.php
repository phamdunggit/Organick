<?php
$contact = get_field('contact');
$general_information = get_field('general_information');
$utility_pages = get_field('utility_pages');
// echo '<pre>';
// var_dump($utility_pages);
// echo '</pre>';
?>
<div class="footer-wrapper">
    <div class="row">
        <div class="col-md-4 first-col">
            <div class="contact">
                <h5>Contact Us</h5>
                <?php if (!$contact) : ?>
                <?php else : ?>
                    <ul class="contact-list">
                        <?php foreach ($contact as $item) { ?>
                            <li>
                                <p><?php echo $item['contact_type'] ?></p>
                                <span><?php echo $item['contact_text'] ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                <?php endif; ?>
            </div>

        </div>
        <div class="col-md-4 second-col">
            <div class="general_information">
                <div class="logo-container">
                    <a class="navbar-logo" href="/">
                        <img src="<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>" alt="" srcset="">
                    </a>
                    <a class="navbar-brand" href="/"><?php echo get_bloginfo('name') ?></a>
                </div>
                <div class="site-info">
                    <p>
                        <?php echo $general_information['text'] ?>
                    </p>
                </div>
                <?php
                if (!$general_information) :
                else : ?>
                    <div class="social-network-icon">
                        <?php foreach ($general_information['social_network_icon'] as $item) { ?>
                            <a href="<?php echo $item['url'] ?>"><i class="<?php echo $item['icon'] ?>" aria-hidden="true"></i></a>
                        <?php } ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
        <div class="col-md-4 third-col">

            <?php if (!$utility_pages) :
            else :
            ?>
                <div class="utility_pages">
                    <h5>Utility Pages</h5>
                    <ul class="page-list">
                        <?php foreach ($utility_pages as $item) { ?>
                            <li>
                                <a href="<?php echo $item['page']['url'] ?>"><?php echo $item['page']['title'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>