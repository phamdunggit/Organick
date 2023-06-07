<?php
$heading = get_field('heading');
$sub_heading = get_field('sub-heading');
$image = get_field('image');
$services_column_1 = get_field('services_column_1');
$services_column_2 = get_field('services_column_2');
$explomore_link= get_field('explomore_link');
// echo '<pre>';
// var_dump($services_column_1);
// echo '</pre>';
?>
<div class="services-container" style="background-image: url(<?php echo $image['url'] ?>);">
    <div class="services-heading">
        <span class="sub-heading"><?php echo $sub_heading ?></span>
        <h2 class="heading"><?php echo $heading ?></h2>
    </div>
    <div class="row services-container-row">
        <div class="col-md-12 col-lg-4 services-column-1">
            <div class="services">
                <?php if (!$services_column_1) : else :
                    foreach ($services_column_1 as $item) {
                ?>
                        <div class="service">
                            <div class="icon">
                                <img src="<?php echo $item['icon']['url'] ?>" alt="">
                            </div>
                            <h2><?php echo $item['title'] ?></h2>
                            <p><?php echo $item['text'] ?></p>
                        </div>
                <?php }
                endif; ?>
            </div>
            <div class="icon"></div>
        </div>
        <div class="col-md-12 col-lg-4 service-image">
            <img src="<?php echo $image['url'] ?>" alt="">
        </div>
        <div class="col-md-12 col-lg-4 services-column-2">
            <div class="services">
                <?php if (!$services_column_2) : else :
                    foreach ($services_column_2 as $item) {
                ?>
                        <div class="service">
                            <div class="icon">
                                <img src="<?php echo $item['icon']['url'] ?>" alt="">
                            </div>
                            <h2><?php echo $item['title'] ?></h2>
                            <p><?php echo $item['text'] ?></p>
                        </div>
                <?php }
                endif; ?>
            </div>
        </div>
    </div>
    <div class="explore-more-container">
        <a href="<?php echo $explomore_link ?>" class="explore-more-btn">
            Explore More
            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="9.5" cy="9.5" r="9.5" fill="#335B6B" />
                <path d="M9.47641 6.12891L12.871 9.19342L9.47641 12.2579M12.3995 9.19342H5.51611" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            </svg>

        </a>
    </div>
</div>